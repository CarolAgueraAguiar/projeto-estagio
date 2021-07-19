<?php

if (isset($_POST['email'])  && isset($_POST['senha'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $conexao = mysqli_connect('mysql-container', 'root', 'ecode', 'projectecode');

    $sql = "select * from pessoa where email ='{$email}'";
    $resultado = mysqli_query($conexao,$sql);
    $totalDeRegistros = mysqli_num_rows($resultado);
    $usuario = mysqli_fetch_array($resultado);

    if (($totalDeRegistros == 1) && (password_verify($senha, $usuario['senha']))) {        
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id']= $usuario['id'];
            $_SESSION['nome']  = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['tipo'] = 'user';

            header('location: ./indexUser.php');
            die();
        
    }else{
        $mensagem = "Usuário/Senha inválidos de usuário";
        header("location: ../../index.php?mensagem2={$mensagem}");
        die();
    }
}

