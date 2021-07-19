<?php
require_once('../../verificarSessaoUser.php');
require_once('../../dependencias.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Admin</title>
    <style>
        h1,
        h5 {
            text-align: center;
        }

        .container {
            margin-top: 2rem;
        }

        .espaco {
            margin-top: 2rem;
            width: 100%;
        }

        .sair {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="row align-items-md-stretch" style="width: 100%;  margin:0;">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h1 class="display-4">Bem-Vindo(a) <?= $_SESSION['nome']; ?></h1>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title">Alterar Cadastro</h5>
                    <a href="./listarUser.php" class="btn btn-warning" style="width: 100%;">Alterar</a>
                </div>
            </div>
        </div>
        <div class="row espaco">
            <div class="col sair">
                <a class="btn btn-outline-danger" href="../../logout.php">Sair</a>
            </div>
        </div>
    </div>
</body>

</html>