<?php

function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

?>

<?php
session_start();
include 'class/dbConnection.php';
$pdo = DbConnection::open();

if (empty($_POST['usuario']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

console_log($usuario);
console_log($senha);

$query = $pdo->prepare("SELECT Usuario, TipoUsuario FROM login WHERE Usuario=:usuario AND Senha=:senha");
$query->bindValue(':usuario', $usuario, PDO::PARAM_STR);
$query->bindValue(':senha', $senha, PDO::PARAM_STR);
$query->execute();
$row_count = $query->rowCount();

$result=$query->fetch(PDO::FETCH_ASSOC);

if ($row_count == 1) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipoUsuario'] = $result['TipoUsuario'];
    header('Location: pessoa/list.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: pessoa/list.php');
    exit();
}

?>