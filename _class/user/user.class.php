<?php

require_once __DIR__ . '/../model.class.php';

class User extends Model
{
    private $pdo;
    private $table = 'user';  // Nome da tabela
    private $nameField = 'email';  // Nome do campo para verificar duplicidade
    private $nameSlug = 'name';   // Nome do campo para gerar o slug

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        parent::__construct($pdo, $this->table);
    }

    public function insertUser(array $data, $file = null)
    {
        // Verifica se o nome já existe
        if (isset($data[$this->nameField]) && $this->nameExists($data[$this->nameField])) {
            throw new Exception("O nome '{$data[$this->nameField]}' já existe.");
        }

        // Adiciona o slug 
        if (isset($data[$this->nameSlug])) {
            $data['slug'] = $this->generateUniqueSlug($data[$this->nameSlug]);
        }

        // Upload da imagem
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $imageName = $this->uploadImage($file);
            $data['image'] = $imageName;
        }

        // Chama o método insert da classe pai
        parent::insert($data);
    }

    private function nameExists($name)
    {
        try {
            $sql = "SELECT COUNT(*) FROM $this->table WHERE $this->nameField = :name";
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':name', $name);
            $sth->execute();
            return $sth->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return false;
    }

    private function generateSlug($name)
    {
        // Função para gerar slug a partir do nome
        return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    }

    private function generateUniqueSlug($name)
    {
        $baseSlug = $this->generateSlug($name);
        $slug = $baseSlug;
        $suffix = 1;

        while ($this->slugExists($slug)) {
            $slug = $baseSlug . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }

    private function slugExists($slug)
    {
        try {
            $sql = "SELECT COUNT(*) FROM $this->table WHERE slug = :slug";
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':slug', $slug);
            $sth->execute();
            return $sth->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return false;
    }

    private function uploadImage($file)
    {
        // Captura o nome do arquivo
        $fileContent = file_get_contents($file['tmp_name']);
        if ($fileContent === false) {
            throw new Exception("Não foi possível ler o conteúdo do arquivo.");
        }
        // Gera Hash
        $fileHash = hash('sha256', $fileContent);
        // Extensão do arquivo
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        // Crie um novo nome de arquivo baseado no hash e na extensão
        $fileName = $fileHash . '.' . $fileExtension;
        $uploadDir = '../../uploads/';  // Diretório onde as imagens serão salvas
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return $fileName;
        } else {
            throw new Exception("Erro ao fazer upload da imagem.");
        }
    }
}
