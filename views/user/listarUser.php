<?php
require_once('../../verificarSessaoUser.php');

$conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
$sqlPesquisar = "select * from pessoa where id =" . $_SESSION['id'];
$usuarios = mysqli_query($conexao, $sqlPesquisar);
mysqli_close($conexao);

if (isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dataNascimento = $_POST['dataNascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $sexo = $_POST['sexo'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
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
    session_unset();
    session_destroy();
    header('location: ../../../index.php');
    exit();
}
require_once('../../dependencias.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <style>
        main {
            align-items: center;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .container {
            border-radius: 2%;
        }
    </style>
</head>

<body style="background-color: #5cb85c;">
    <main>
        <?php
        $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');
        while ($data = mysqli_fetch_array($usuarios)) {
        ?>
            <div class="container" style="background-color: burlywood;">
                <h1 style="text-align: center;">Cadastro de Usuário</h1>
                <form class="row g-3" method="POST">
                    <input type="hidden" name="idAtualizar" value="<?= $data['id'] ?>">
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $data['email'] ?> " id=" inputEmail">
                    </div>
                    <div class="col-md-6">
                        <label for="inputsenha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" value="" id=" inputsenha">
                    </div>
                    <div class="col-8">
                        <label for="inputNome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="inputNome" value="<?= $data['nome'] ?>" placeholder=" Nome Completo">
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
                    <div class="col-md-4">
                        <label for="inputSexo" class="form-label">Sexo</label>
                        <select name="sexo" id="inputSexo" class="form-control ls-select" required>
                            <option value="" disabled="disabled" selected>Escolher...</option>
                            
                            <?php if ($data['sexo'] == 1) { ?>
                                <option selected value="1">Feminino</option>
                                <option value="2">Masculino</option>
                            <?php } else { ?>
                                <option value="1">Feminino</option>
                                <option selected value="2">Masculino</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="inputEndereco" class="form-label">Endereco</label>
                        <input type="text" name="endereco" class="form-control" id="inputEndereco" value="<?= $data['endereco'] ?>" placeholder="Rua dos Bobos">
                    </div>
                    <div class="col-2">
                        <label for="inputNumero" class="form-label">Número</label>
                        <input type="text" name="numero" class="form-control" id="inputNumero" value="<?= $data['numero'] ?>" placeholder="Número">
                    </div>
                    <div class="col-md-4">
                        <label for="inputBairro" class="form-label">Bairro</label>
                        <input type="text" name="bairro" class="form-control" value="<?= $data['bairro'] ?>" id="inputBairro">
                    </div>
                    <div class="col-md-6">
                        <label for="inputComplemento" class="form-label">Complemento</label>
                        <input type="text" name="complemento" class="form-control" value="<?= $data['complemento'] ?>" id="inputComplemento">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCidade" class="form-label">Cidade</label>
                        <input type="text" name="cidade" class="form-control" value="<?= $data['cidade'] ?>" id="inputCidade">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEstado" class="form-label">Estado</label>
                        <input type="text" name="estado" class="form-control" value="<?= $data['estado'] ?>" id="inputEstado">
                    </div>
                    <div class="col-md-3">
                        <label for="inputCEP" class="form-label">CEP</label>
                        <input type="text" name="cep" class="form-control" value="<?= $data['cep'] ?>" id="inputCEP">
                    </div>
                    <div class="col-md-3">
                        <label for="inputTelefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="<?= $data['telefone'] ?>" id="inputTelefone">
                    </div>
                    <div class="col-md-3">
                        <label for="inputCelular" class="form-label">Celular</label>
                        <input type="text" name="celular" class="form-control" value="<?= $data['celular'] ?>" id="inputCelular">
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-12">
                        <button type="submit" name="atualizar" class="btn btn-success" style=" width: 100%;">Atualizar</button>
                    </div>
                </form>
            </div>
        <?php
        }
        mysqli_close($conexao);
        ?>
    </main>
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