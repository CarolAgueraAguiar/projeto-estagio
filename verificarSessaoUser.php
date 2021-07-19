<?php
session_start();
if (isset($_SESSION['tipo'])) {
    if ($_SESSION['tipo'] != 'user') {
        $mensagem = "Sessão Expirada. Faça login novamente! ";
        header("location: /index.php?mensagem={$mensagem}");
        die();
    }
} else {
    $mensagem = "Sessão Expirada. Faça login novamente! ";
    header("location: /index.php?mensagem={$mensagem}");
    die();
}
