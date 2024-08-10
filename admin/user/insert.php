<?php
include_once '../../conn/config.php';
include_once '../../conn/conect.php';
include_once '../../_class/model.class.php';
include_once '../../_class/user/user.class.php';
include_once '../inc/validate-session.php';

$model = 'user'; // Variável $model contém o nome do model
$dir = 'user'; // Variável $dir contém o nome do diretório para redirecionamento

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$Data = [
    'name' => $data['name'],
    'email' => $data['email'],
    'level' => $data['level'],
    'pass' => MD5($data['pass'])
];
//Classe específica User que 'extend' Model - Contém validações específicas
$user = new User($pdo);
$user->insertUser($Data, $_FILES['image']);
header("Location: " . $base . "/admin/" . $dir);

//Classe Model Padrão (insert, delete, update, selectAll, selectOne, count)
// $userModel = new Model($pdo, $model);
// $userModel->insert($Data);

/*
//Modo de Insert Direto
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
try {
    $sth = $pdo->prepare('insert into users (usr_name, usr_email, usr_pass) 
    values (:usr_email, :usr_name, :usr_pass)');
    $sth->bindValue('usr_email', $data['usr_name']);
    $sth->bindValue('usr_name', $data['usr_email']);
    $sth->bindValue('usr_pass', MD5($data['usr_pass']));
    $sth->execute();
    header("Location: ".$base."/admin/user");
} catch (PDOException $e) {
    echo $e->getMessage();
}
*/