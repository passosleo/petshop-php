<?php
	session_start();

	if (!isset($_SESSION["email"]) ){
		$_SESSION["erro"] = "Você precisa estar logado para acessar essa página";

		header("location: /trabalho_final_pet/login.php");	
	}
?>
