<?php
require_once('./dependencias.php');
if (isset($_POST['entrar'])) {
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$entrar = $_POST['entrar'];

	if ($email == "" && $senha == "") {
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-code</title>
    <style>
        .card-title {
            background-color: rgb(20, 141, 197);
            text-align: center;
        }

        .second-card {
            margin-left: 2rem;
        }

        @media only screen and (max-width: 576px) {
            .container {
                width: 90%;
            }

            .row {
                display: block;
            }

            .second-card {
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body style="background-color: #182f63">
    <div style="height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col card">
                    <div class="card-body">
                        <div class="card-title"><strong>Administrador</strong></div>
                        <form name="form" id="frmLogin" method="POST" action="/views/adm/autenticacaoAdm.php">
                            <label>Email</label>
                            <input type="email" class="form-control input-sm" name="email" id="email">
                            <label>Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control input-sm">
                            <center style="margin-top: 10px;">
                                <button class="btn btn-primary btn-sm" type="submit" id="entrar"
                                    name="entrar">Entrar</button>
                            </center>
                        </form>
                    </div>
                </div>
                <div class="col card second-card">
                    <div class=" card-body">
                        <div class="card-title"><strong>Usuário</strong></div>
                        <form name="form" id="frmLogin" method="POST" action="/views/user/autenticacaoUser.php">
                            <label>Email</label>
                            <input type="email" class="form-control input-sm" name="email" id="email">
                            <label>Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control input-sm">
                            <center style="margin-top: 10px;">
                                <button class="btn btn-primary btn-sm" type="submit" id="entrar"
                                    name="entrar">Entrar</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>