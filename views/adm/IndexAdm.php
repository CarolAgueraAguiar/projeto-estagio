<?php
require_once('../../verificarSessao.php');
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
        h1, h5{
            text-align: center;
        }
        .container{
            margin-top: 2rem;
        }
        .row2{
            display: grid; 
            grid-template-columns: auto auto; 
            margin-top: 2rem;
        }
        .left{
            margin-left: 2rem;
        }
        .espaco{
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="row align-items-md-stretch" style="width: 100%;">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h1 class="display-4"">Bem-Vindo(a) <?= $_SESSION['nome']; ?></h1>
            </div>
        </div>
    </header>
    <main class="container" >
        <div class="row2" >
            <div class="card col" >
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Administrador</h5>
                    <a href="cadastroAdm.php" class="btn btn-success" style="width: 100%;">Cadastrar</a>
                </div>
            </div>
            <div class="card col left" >
                <div class="card-body">
                    <h5 class="card-title" ">Listar Administradores</h5>
                    <a href="/views/adm/listarAdm.php" class="btn btn-warning" style="width: 100%;">Visualizar</a>
                </div>
            </div>
        </div>
        <div class="row espaco">
            <div class="card col" >
                <div class="card-body">
                    <h5 class="card-title" ">Listar Usuário</h5>
                    <a href="#" class="btn btn-outline-danger" style="width: 100%;">Visualizar</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>