<?php
require("../../db/conexao.php");
session_start();

if (!isset($_POST['email'], $_POST['senha'])) {
    $_SESSION["erro"] = "Usuário ou senha incorretos";
    header("location: /login.php");
    exit;
}

$email = trim($_POST["email"]);
$senha = $_POST["senha"];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha, $usuario["senha"])) {
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["nome"] = $usuario["nome"];
        header("location: /dashboard.php");
        exit;
    }
}

$_SESSION["erro"] = "Usuário ou senha incorretos";
header("location: /login.php");
exit;
