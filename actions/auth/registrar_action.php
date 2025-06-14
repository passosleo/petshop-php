<?php
require("../../db/conexao.php");
session_start();

if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
    $_SESSION["erro"] = "Parâmetros incorretos";
    header("location: /registrar.php");
    exit;
}

$nome = trim($_POST["nome"]);
$email = trim($_POST["email"]);
$senha = $_POST["senha"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["erro"] = "E-mail inválido";
    header("location: /registrar.php");
    exit;
}

$stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $_SESSION["erro"] = "E-mail já cadastrado";
    header("location: /registrar.php");
    exit;
}
$stmt->close();

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha_hash);

if ($stmt->execute()) {
    $_SESSION["sucesso"] = "Cadastro realizado com sucesso!";
    header("location: /login.php");
} else {
    $_SESSION["erro"] = "Erro ao cadastrar usuário";
    header("location: /registrar.php");
}

$stmt->close();
?>
