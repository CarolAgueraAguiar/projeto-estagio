<?php
require_once('../../verificarSessaoAdmin.php');


$conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
$where = "";
if (!empty($_POST['nomePesquisar'])) {
    $where = " where nome like '%" . $_POST['nomePesquisar'] . "%'";
}
$sqlPesquisar = "select * from administrador" . $where;
$usuarios = mysqli_query($conexao, $sqlPesquisar);
mysqli_close($conexao);


if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
    $sql = "delete from administrador where id = " . $_POST['id'];
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Refresh: 0");
}
if (isset($_POST['atualizar'])) {
    $idAtualizar = $_POST['idAtualizar'];
    $nomeAtualizar = $_POST['nomeAtualizar'];
    $emailAtualizar = $_POST['emailAtualizar'];
    $senhaAtualizar = $_POST['senhaAtualizar'];
    $senhaCriptografada = password_hash($senhaAtualizar, PASSWORD_DEFAULT);
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');

    $sql = "update administrador
    set nome     = '{$nomeAtualizar}',
        email    = '{$emailAtualizar}',
        senha    = '{$senhaCriptografada}'
    where id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);

    mysqli_close($conexao);
}
require_once('../../dependencias.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Listar Adm</title>
    <style>
        .form-login {
            margin-top: 5rem;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
        }

        @media screen and (max-width: 992px) {
            .col-sm-3 {
                display: block !important;
            }

            .titulo {
                text-align: center;
            }

            .btn.btn-success {
                margin-top: 1rem;
                width: 100%;
            }
            .buton{
                width: 100%;
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body style="background-color: #F2F2F2;" class="form-login container">
    <div class="row">
        <div class="col-sm-4 " style="display: flex; float: left;">
            <h2 class="titulo">Buscar Administrador</h2>
        </div>
        <div class="col-sm-5">
            <form action="/views/adm/listarAdm.php" method="post">
                <div class="input-group ">
                    <input type="text" class="form-control" placeholder="Pesquisar por Nome" name="nomePesquisar">
                    <button class="btn btn-primary" type="submit" name="pesquisar">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success" style="float: right;" href="/views/adm/cadastroAdm.php">CADASTRAR</a>
        </div>
        <div class="col-sm-1">
            <a class="btn btn-outline-primary buton" style="float: right;" href="IndexAdm.php">INÍCIO</a>
        </div>
    </div>
    <div style="margin-top: 3rem;">
        <h2>Listar Administradores</h2>
        <div class="table-responsive">
            <table class="table table-success">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Editar/Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
                    while ($data = mysqli_fetch_array($usuarios)) { ?>
                        <tr>
                            <th scope="row">
                                <?= $data['id']  ?>
                            </th>
                            <td><?= $data['nome']  ?></td>
                            <td><?= $data['email']  ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $data['id'] ?>">
                                    <img src="../../img/edit.png" alt="" width="20rem" height="20rem">
                                </button>

                                <div class="modal fade" id="exampleModal1<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Alterar Administrador</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3" action="/usuario/atualizar" method="POST">
                                                    <input type="hidden" name="idAtualizar" id="id " value="<?= $data['id'] ?>">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Nome Completo</label>
                                                        <input type="text" name="nomeAtualizar" class="form-control" value="<?= $data['nome'] ?>" id="nome">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">E-mail</label>
                                                        <input name="emailAtualizar" type="text" id="email" value="<?= $data['email'] ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Senha</label>
                                                        <input name="senhaAtualizar" type="password" id="senha" value="" class="form-control" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary buton" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" name="atualizar" class="btn btn-success">Atualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $data['id']?>">
                                    <img src="../../img/excluir.png" alt="" width="20rem" height="20rem">
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal2<?= $data['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Excluir</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que quer excluir ?
                                            </div>
                                            <form method="post">
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" id="id " value="<?= $data['id']?>">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    mysqli_close($conexao);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>