<?php
// Avalie melhorias nesse código


class Model
{
    private $pdo;
    private $table;

    public function __construct($pdo, $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function insert(array $data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
    
            $sth = $this->pdo->prepare($sql);
    
            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }
    
            $sth->execute();
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }

    public function selectAll()
    {
        try {
            $sql = "SELECT * FROM $this->table order by id DESC ";
            $sth = $this->pdo->query($sql);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
        return [];
    }

    public function selectOne($id)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
        return null;
    }

    public function update($id, array $data)
    {
        try {
            $updates = [];
            foreach ($data as $key => $value) {
                $updates[] = "$key = :$key";
            }
            $setClause = implode(', ', $updates);
            $sql = "UPDATE $this->table SET $setClause WHERE id = :id";
    
            $sth = $this->pdo->prepare($sql);
    
            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
    
            return $sth->execute();
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }

    public function count()
    {
        try {
            $sql = "SELECT COUNT(*) AS total FROM $this->table";
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return (int) $result['total'];
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
        return 0;
    }

    //crie uma função genérica seguindo a codificação acima para buscar dados de uma tabela com base em um campo específico
    public function searchByField($field, $value)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE $field = :$field";
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(":$field", $value);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
        return [];
    }
}

/*
    $userModel = new Model($pdo, 'users');

    $userData = [
        'usr_email' => 'davi@davi.com',
        'usr_name' => 'davi',
        'usr_pass' => 'Senac#123'
    ];
    $userModel->insert($userData);

    $userModel->delete(1);

    $users = $userModel->selectAll();
    print_r($users);

    //Dados em Tabela
    // Cria uma instância da classe Model para a tabela 'users'
    try {        
        $userModel = new Model($pdo, 'users');
    
        // Obtém todos os usuários
        $users = $userModel->selectAll();
    
        if (!empty($users)) {
            echo '<table class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            
            // Exibe cabeçalhos da tabela
            echo '<th>ID</th>';
            echo '<th>Email</th>';
            echo '<th>Nome</th>';
            echo '<th>Senha</th>';
            
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            // Exibe dados dos usuários
            foreach ($users as $user) {
                echo '<tr>';
                echo "<td>{$user['id']}</td>";
                echo "<td>{$user['usr_email']}</td>";
                echo "<td>{$user['usr_name']}</td>";
                echo "<td>{$user['usr_pass']}</td>";
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Nenhum dado encontrado.</p>';
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $user = $userModel->selectOne(1);
    print_r($user);

    $updateData = [
        'usr_email' => 'newemail@davi.com',
        'usr_name' => 'newname'
    ];
    $userModel->update(1, $updateData);
*/
