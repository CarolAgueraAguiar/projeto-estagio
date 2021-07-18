<?php
require_once('../../dependencias.php');
function formataData($data)
{
    return substr($data, 8, 2) . "/" .
        substr($data, 5, 2) . "/" .
        substr($data, 0, 4);
}
$conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
$where = "";
if (!empty($_POST['nomePesquisar'])) {
    $where = " where nome like '%" . $_POST['nomePesquisar'] . "%'";
}
$sqlPesquisar = "select * from pessoa" . $where;
$usuarios = mysqli_query($conexao, $sqlPesquisar);
mysqli_close($conexao);
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
        <div class="col-sm-3">
            <a class="btn btn-success" style="float: right;" href="/views/adm/cadastroAdm.php">CADASTRAR USUÁRIO</a>
        </div>
    </div>
    <div style="margin-top: 3rem;">
        <h2>Listar Administradores</h2>
        <div class="table-responsive">
            <table class="table table-success">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Email</th>
                        <th scope="col">CPF</th>
                        <th scope="col">RG</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Complemento</th>
                        <th scope="col">CEP</th>
                        <th scope="col">Número</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Editar/Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
                    while ($data = mysqli_fetch_array($usuarios)) {
                        if ($data['status'] == 1) {
                            $statuscliente = 'Ativo';
                        } else {
                            $statuscliente = 'Inativo';
                        } ?>
                        <tr>
                            <th scope="row">
                                <?= $data['id']  ?>
                            </th>
                            <td><?= $statuscliente  ?></td>
                            <td><?= $data['nome']  ?></td>
                            <td><?= formataData($data['dataNascimento']) ?></td>
                            <td><?= $data['email']  ?></td>
                            <td><?= $data['cpf']  ?></td>
                            <td><?= $data['rg']  ?></td>
                            <td><?= $data['sexo']  ?></td>
                            <td><?= $data['telefone']  ?></td>
                            <td><?= $data['celular']  ?></td>
                            <td><?= $data['endereco']  ?></td>
                            <td><?= $data['bairro'] ?></td>
                            <td><?= $data['complemento']  ?></td>
                            <td><?= $data['cep']  ?></td>
                            <td><?= $data['numero']  ?></td>
                            <td><?= $data['cidade']  ?></td>
                            <td><?= $data['estado']  ?></td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $data['id'] ?>">
                                <img src="../img/edit.png" alt="" width="20rem" height="20rem">
                            </button>

                            <div class="modal fade" id="exampleModal1 <?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alterar Usuário</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" action="/usuario/atualizar" method="POST">
                                                <input type="hidden" name="id" id="id " value="<?= $data['id'] ?>">
                                                <div class="col-md-12">
                                                    <label class="form-label">Nome Completo</label>
                                                    <input type="text" name="nome" class="form-control" value="<?= $data['nome'] ?>" id="nome">
                                                </div>                                      
                                                <div class="col-md-6">
                                                    <label class="form-label">E-mail</label>
                                                    <input name="email" type="text" id="email" value="<?= $data['email'] ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Senha</label>
                                                    <input name="senha" type="date" id="senha" value="<?= $data['senha'] ?>" class="form-control" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Atualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2<%= cliente.id %>">
                                <img src="../img/excluir.png" alt="" width="20rem" height="20rem">
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal2<%= cliente.id %>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Excluir</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que quer excluir ?
                                        </div>
                                        <form action="/usuario/excluir" method="post">
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" id="id " value="<%= cliente.id %>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Excluir</button>
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