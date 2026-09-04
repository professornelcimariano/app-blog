<?php
require_once 'setup/connect.php'; 
$raiz = dirname(__DIR__, 1); // __DIR__ é uma forma de obter o diretório atual do arquivo, e dirname(__DIR__, 1) sobe um níveis para chegar à raiz do projeto
include_once $raiz . '/setup/connect.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta Tags SEO -->
    <title>DevBlog | Tecnologia & Engenharia de Software</title>
    <meta name="description" content="Artigos, tutoriais e soluções práticas sobre desenvolvimento de sistemas e programação.">
    <meta name="robots" content="index, follow">
    <meta name="author" content="DevBlog">

    <!-- Bootstrap 5 & Ícones Nativos -->
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body class="text-dark d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>index.php">App Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASE_URL ?>index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>blogs.php">Blogs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>