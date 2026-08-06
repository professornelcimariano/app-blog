<?php 
require_once '_conn/connect.php'; 

// Buscar todos os posts ativos
try {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE status = 1 ORDER BY id DESC");
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $blogs = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Blog - Página Inicial</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <?php include '_inc/_header.php'; ?>

    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary border w-100">
            <div class="col-12 px-0">
                <h1 class="display-4 fw-bold">O Futuro do Desenvolvimento Web com Bootstrap</h1>
                <p class="lead my-3">Confira as melhores práticas para criar interfaces modernas, responsivas e de alta performance utilizando os recursos nativos do framework.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <h3 class="pb-2 mb-4 border-bottom">
                    Últimas Publicações
                </h3>

                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                        <article class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title h4 fw-bold"><?= htmlspecialchars($blog['title']) ?></h2>
                                
                                <?php if (!empty($blog['subtitle'])): ?>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($blog['subtitle']) ?></h6>
                                <?php endif; ?>

                                <p class="card-text">
                                    <?= htmlspecialchars(mb_strimwidth($blog['description'], 0, 200, '...')) ?>
                                </p>
                                
                                <a href="blog.php?blog=<?= $blog['slug'] ?>" class="btn btn-outline-primary btn-sm">Ler artigo completo</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Nenhuma publicação encontrada.</p>
                <?php endif; ?>

            </div>
        </div>

    </main>

    <?php include '_inc/_footer.php'; ?>

    <script src="public/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>