<?php
	require("../../db/conexao.php");
	session_start();

	if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
		$_SESSION["erro"] = "Parâmetros incorretos";
		header("location: /registrar.php");
		exit;
	}

	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	$sql_email_existe = "SELECT * FROM usuarios WHERE email = '$email'";
	$resultado = mysqli_query($conn, $sql_email_existe);

	if (mysqli_num_rows($resultado) > 0) {
		$_SESSION["erro"] = "E-mail já cadastrado";
		header("location: /registrar.php");
		exit;
	}

	$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

	$sql_cadastro = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";

	if (mysqli_query($conn, $sql_cadastro)) {
		$_SESSION["sucesso"] = "Cadastro realizado com sucesso!";
		header("location: /login.php");
	} else {
		$_SESSION["erro"] = "Erro ao cadastrar usuário";
		header("location: /registrar.php");
	}
?>
