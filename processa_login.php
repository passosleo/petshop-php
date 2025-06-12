<?php
	require("conecta_db.php");
	session_start();

	if (!isset($_POST['email'], $_POST['senha'])) {
		$_SESSION["erro"] = "Usuário ou senha incorretos";
		header("location: /trabalho_final_pet/login.php");
		exit;
	}

	$email = $_POST["email"];
	$senha = $_POST["senha"];

	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	$resultado = mysqli_query($conn, $sql);

	if (mysqli_num_rows($resultado) === 1) {
		$usuario = mysqli_fetch_assoc($resultado);

		if (password_verify($senha, $usuario["senha"])) {
			$_SESSION["email"] = $usuario["email"];
			$_SESSION["nome"] = $usuario["nome"];
			header("location: /trabalho_final_pet/index.php");
			exit;
		}
	}

	$_SESSION["erro"] = "Usuário ou senha incorretos";
	header("location: /trabalho_final_pet/login.php");
	exit;
?>
