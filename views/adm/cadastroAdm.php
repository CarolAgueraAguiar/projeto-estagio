<?php
if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');

    $sql = "INSERT INTO administrador (nome,email,senha) VALUES ('{$nome}','{$email}','{$senhaCriptografada}')";
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    header("Refresh: 0; url = IndexAdm.php");
}
require_once('../../dependencias.php');
require_once('../../verificarSessao.php');
?>
<!DOCTYPE html>
<html lang="pr-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Administrador</title>
    <style>
        h2 {
            text-align: center;
        }

        .botao {
            display: flex;
        }
    </style>
</head>

<body style="background-color: grey;">
    <div style="height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col card">
                    <div class="card-body">
                        <form method="POST">
                            <h2>Cadastro de Administrador</h2>
                            <div class="mb-3">
                                <label for="InputNome" class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" id="InputNome" aria-describedby="nome">
                            </div>
                            <div class="mb-3">
                                <label for="InputEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="email">
                            </div>
                            <div class="mb-3">
                                <label for="InputPassword" class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" id="InputPassword">
                            </div>
                            <div class="botao">
                                <a type="button" class="btn btn-warning" style="width: 40%; margin-right: 2rem;" href="/views/adm/listarAdm.php"><b> Ir para Gestão de Administradores</b></a>
                                <a type="button" class="btn btn-primary" style="width: 20%; margin-right: 2rem;" href="IndexAdm.php"><b> INÍCIO</b></a>
                                <button type="submit" name="salvar" class="btn btn-success " style="width: 40%;">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>