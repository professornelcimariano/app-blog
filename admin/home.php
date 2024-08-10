<?php
include '../conn/config.php';
include '../conn/conect.php';
include '../_class/model.class.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ' . $base);
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <?php
    include 'inc/menu.php';
    ?>
    <div class="container">
        <!-- Seção de boas-vindas -->
        <div class="welcome-section">
            <h3>
                <?php
                echo " Bem-vindo, " . $_SESSION['email'];
                ?>
            </h3>
            <p>Dashboard</p>
        </div>

        <div class="row">
            <!-- Cards -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= $base ?>/admin/user/">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <i class="bi bi-person card-icon"></i>
                            <h5 class="card-title">Usuários</h5>
                            <p class="card-text">Total de usuários registrados</p>
                            <hr>
                            <h2 class="display-5">
                                <?php
                                $userModel = new Model($pdo, 'user');
                                $totalUsers = $userModel->count();
                                echo $totalUsers;
                                ?>
                            </h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <i class="bi bi-cart-check card-icon"></i>
                        <h5 class="card-title">Vendas</h5>
                        <p class="card-text">Total de vendas realizadas</p>
                        <hr>
                        <h2 class="display-5">R$ 2,350</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <i class="bi bi-exclamation-triangle card-icon"></i>
                        <h5 class="card-title">Erros</h5>
                        <p class="card-text">Total de erros encontrados</p>
                        <hr>
                        <h2 class="display-5">3</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <i class="bi bi-bell card-icon"></i>
                        <h5 class="card-title">Notificações</h5>
                        <p class="card-text">Total de notificações pendentes</p>
                        <hr>
                        <h2 class="display-5">5</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <i class="bi bi-calendar3 card-icon"></i>
                        <h5 class="card-title">Eventos</h5>
                        <p class="card-text">Próximos eventos agendados</p>
                        <hr>
                        <h2 class="display-5">8</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <i class="bi bi-gear card-icon"></i>
                        <h5 class="card-title">Configurações</h5>
                        <p class="card-text">Configurações do sistema</p>
                        <hr>
                        <h2 class="display-5">12</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <i class="bi bi-pie-chart card-icon"></i>
                        <h5 class="card-title">Estatísticas</h5>
                        <p class="card-text">Estatísticas de desempenho</p>
                        <hr>
                        <h2 class="display-5">75%</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>