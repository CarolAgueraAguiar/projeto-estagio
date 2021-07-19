<?php
require_once('../../verificarSessaoAdmin.php');
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
if (isset($_POST['excluir'])) {
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
    $sql = "delete from pessoa where id = " . $_POST['id'];
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Refresh: 0");
}
if (isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataNascimento = $_POST['dataNascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $sexo = $_POST['sexo'];
    $endereco = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['uf'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    if (isset($_POST['status'])) {
        $statusAtualizar = 1;
    } else {
        $statusAtualizar = 0;
    }
    $idAtualizar = $_POST['idAtualizar'];

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');

    $sql = "UPDATE pessoa
      SET nome     = '{$nome}',
          email    = '{$email}',
          senha    = '{$senhaCriptografada}',
          dataNascimento    = '{$dataNascimento}',
          cpf    = '{$cpf}',
          rg    = '{$rg}',
          sexo    = '{$sexo}',
          endereco    = '{$endereco}',
          numero    = '{$numero}',
          bairro    = '{$bairro}',
          complemento    = '{$complemento}',
          cidade    = '{$cidade}',
          estado    = '{$estado}',
          cep    = '{$cep}',
          telefone    = '{$telefone}',
          celular    = '{$celular}',
          status    = '{$statusAtualizar}'
      WHERE id       = {$idAtualizar}";

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Refresh: 0; url = listarUsers.php");
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

            .buton {
                width: 100%;
                margin-top: 1rem;
            }
        }
    </style>
    <script>
        function limpa_formulário_cep() {
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {

                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);
            } else {

                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            var cep = valor.replace(/\D/g, '');


            if (cep != "") {


                var validacep = /^[0-9]{8}$/;


                if (validacep.test(cep)) {


                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";


                    var script = document.createElement('script');

                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';


                    document.body.appendChild(script);

                } else {

                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } else {

                limpa_formulário_cep();
            }
        };
    </script>
</head>

<body style="background-color: #F2F2F2;" class="form-login container">
    <div class="row">
        <div class="col-sm-4 " style="display: flex; float: left;">
            <h2 class="titulo">Buscar Usuário</h2>
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
            <a class="btn btn-success" style="float: right;" href="../../views/user/cadastroUser.php">CADASTRAR USUÁRIO</a>
        </div>
        <div class="col-sm-1">
            <a class="btn btn-outline-primary buton" style="float: right;" href="IndexAdm.php">INÍCIO</a>
        </div>
    </div>
    <div style="margin-top: 3rem;">
        <h2>Listar Usuários</h2>
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
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $data['id'] ?>">
                                    <img src="../../img/edit.png" alt="" width="20rem" height="20rem">
                                </button>

                                <div class="modal fade" id="exampleModal1<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Alterar Usuário</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3" action="listarUsers.php" method="POST">
                                                    <input type="hidden" name="idAtualizar" id="id " value="<?= $data['id'] ?>">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Nome Completo</label>
                                                        <input type="text" name="nome" class="form-control" value="<?= $data['nome'] ?>" id="nome">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">E-mail</label>
                                                        <input name="email" type="text" id="email" value="<?= $data['email'] ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputsenha" class="form-label">Senha</label>
                                                        <input type="password" name="senha" class="form-control" value="" id=" inputsenha">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputDataNascimento" class="form-label">Data de Nascimento</label>
                                                        <input type="date" name="dataNascimento" class="form-control" value="<?= $data['dataNascimento'] ?>" id=" inputDataNascimento">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputCPF" class="form-label">CPF</label>
                                                        <input type="text" name="cpf" class="form-control" value="<?= $data['cpf'] ?> " id=" inputCPF">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputRG" class="form-label">RG</label>
                                                        <input type="text" name="rg" class="form-control" value="<?= $data['rg'] ?>" id=" inputRG">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputSexo" class="form-label">Sexo</label>
                                                        <select name="sexo" id="inputSexo" class="form-control ls-select" required>
                                                            <option value="" disabled="disabled" selected>Escolher...</option>

                                                            <?php if ($data['sexo'] == 1) { ?>
                                                                <option selected value="1">Masculino</option>
                                                                <option value="2">Feminino</option>
                                                            <?php } else { ?>
                                                                <option value="1">Masculino</option>
                                                                <option selected value="2">Feminino</option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">CEP</label>
                                                        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" placeholder="digite seu CEP"  onblur="pesquisacep(this.value);" class="form-control">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label for="inputEndereco" class="form-label">Endereco</label>
                                                        <input name="rua" type="text" id="rua" size="60" value="<?= $data['endereco'] ?>" class="form-control" placeholder="Rua dos Bobos">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputNumero" class="form-label">Número</label>
                                                        <input type="text" name="numero" class="form-control" value="<?= $data['numero'] ?>" id="inputNumero" placeholder="Número">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputBairro" class="form-label">Bairro</label>
                                                        <input name="bairro" type="text" id="bairro" value="<?= $data['bairro'] ?>" size="40" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputComplemento" class="form-label">Complemento</label>
                                                        <input type="text" name="complemento" class="form-control" value="<?= $data['complemento'] ?>" id="inputComplemento">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputCidade" class="form-label">Cidade</label>
                                                        <input type="text" name="cidade" class="form-control" value="<?= $data['cidade'] ?>" id="cidade">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEstado" class="form-label">Estado</label>
                                                        <input type="text" name="uf" class="form-control" size="2" value="<?= $data['estado'] ?>" id="uf">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="inputTelefone" class="form-label">Telefone</label>
                                                        <input type="text" name="telefone" class="form-control" value="<?= $data['telefone'] ?>" id="inputTelefone">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputCelular" class="form-label">Celular</label>
                                                        <input type="text" name="celular" class="form-control" value="<?= $data['celular'] ?>" id="inputCelular">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php if ($data['status'] == 1) { ?>
                                                            <div class="form-group"><label class="control-label">Status</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text" style="padding: 1rem;">
                                                                            <input type="checkbox" name="status" value="1" onclick="teste(this, <?= $data['id'] ?>);" checked>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-control"><strong class="text-success" id="labelstatus<?= $data['id'] ?>">Ativo</strong></div>
                                                                </div>
                                                            </div>
                                                        <?php   } else {  ?>
                                                            <div class="form-group"><label class="control-label">Status</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text" style="padding: 0.6rem;">
                                                                            <input type="checkbox" name="status" value="0" onclick="teste(this, <?= $data['id'] ?>);">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-control"><strong class="text-danger" id="labelstatus<?= $data['id'] ?>">Inativo</strong></div>
                                                                </div>
                                                            </div>
                                                        <?php  } ?>
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

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $data['id'] ?>">
                                    <img src="../../img/excluir.png" alt="" width="20rem" height="20rem">
                                </button>
                                <div class="modal fade" id="exampleModal2<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Excluir</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que quer excluir ?
                                            </div>
                                            <form action="listarUsers.php" method="post">
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" id="id " value="<?= $data['id'] ?>">
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
    <script>
        function teste(tag, id) {
            let labelAtivo = document.getElementById('labelstatus' + id);
            if (tag.value == '1') {
                tag.value = 0;
                labelAtivo.className = "text-danger";
                labelAtivo.innerHTML = "Inativo";

            } else {
                tag.value = 1;
                labelAtivo.className = "text-success";
                labelAtivo.innerHTML = "Ativo";
            }
            console.log(tag.value);
        }
    </script>
</body>

</html>