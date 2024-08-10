<?php



include_once '../inc/header.php';
?>
</head>

<body>
    <?php
    $model = 'user';
    $dir = 'user';
    $namePage = 'Cadastro de Usuários';
    include '../inc/menu.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="fs-2"><i class="bi bi-bar-chart-fill"></i> <?= $namePage ?></h2>
                <hr>
                <form action="insert.php" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                    <div class="form-group">
                        <label class="form-label"> Nome</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label class="form-label"> E-mail</label>
                        <input class="form-control" type="text" name="email">
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Senha</label>
                        <input class="form-control" type="text" name="pass">
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Foto </label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label"> Nível de Usuário </label>
                        <select class="form-control" name="level">
                            <?php
                            try {
                                $fk = 'level';
                                $fk = new Model($pdo, $fk);
                                $data = $fk->selectAll();
                                foreach ($data as $registers) :
                                    extract($registers);
                            ?>
                                    <option value="<?= $id ?>"><?= $name ?></option>
                            <?php
                                endforeach;
                            } catch (PDOException $e) {
                                echo 'error ' . $e->getMessage();
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success m-2">Cadastrar</button>
                        <button type="reset" class="btn btn-secondary m-2">Limpar</button>
                    </div>
                </form>
            </div>
            <hr>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col" class="d-none d-md-table-cell">E-mail</th>
                        <th scope="col" class="d-none d-md-table-cell">Pass</th>
                        <th scope="col">Edição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $model = new Model($pdo, $model);
                        $data = $model->selectAll();
                        foreach ($data as $registers) :
                            extract($registers);
                    ?>
                            <tr>
                                <th scope="row"><?= $id ?></th>
                                <td><?= $name ?></td>
                                <td class="d-none d-md-table-cell"><?= $email ?></td>
                                <td class="d-none d-md-table-cell"><?= $pass ?></td>
                                <td>
                                    <!-- <a href="<?= $base; ?>/admin/<?= $dir ?>/delete.php?id=<?= $id; ?>"> <i class="bi bi-trash" style="color: red;"></i> </a>  -->
                                    <button class="btn btn-danger m-2 btn-delete" data-id="<?= $id; ?>">Excluir</button>
                                    <a class="btn btn-primary m-2" href="<?= $base; ?>/admin/<?= $dir ?>/form-update.php?id=<?= $id; ?>"> Editar </a>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    } catch (PDOException $e) {
                        echo 'error ' . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = this.getAttribute('data-id');
                var base = '<?= $base; ?>'; // URL base do PHP
                var dir = '<?= $dir; ?>';

                Swal.fire({
                    title: 'Exclusão de Registro!',
                    text: "Confirma Exclusão deste ítem?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redireciona para a URL de exclusão
                        window.location.href = base + '/admin/' + dir + '/delete.php?id=' + itemId;
                    }
                });
            });
        });
    });
</script>
<?php
include '../inc/footer.php';
?>