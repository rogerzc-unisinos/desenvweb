<?php
if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') === false) {
    include('loginVerification.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/crud/assets/css/bootstrap.min.css">
    <title>M6 | Tarefa - Projeto de Banco - Fase 3</title>
</head>

<body>

    <?php
    if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') === false) {
        include 'user.php';
    }
    ?>

    <header>
        <div class="text-center">
            <div style="width:100%;">
                <h1><span>M6 | Tarefa - Projeto de Banco - Fase 3</span></h1>
                <h3><span>Roger Zabka da Costa</span></h3>
                <h3><span>Daniel Gonçalves Thewes</span></h3>
            </div>
        </div>
    </header>