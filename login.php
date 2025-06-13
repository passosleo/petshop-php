<?php
    session_start();
    if (isset($_SESSION["email"])) {
        header("location: /dashboard.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="container">
            <div class="icon">🐾</div>
            <h2>Bem-vindo ao PetShop</h2>
            <form method="POST" action="actions/auth/login_action.php">
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Entrar</button>
                <?php require("utils/mostra_mensagem.php");?>
            </form>
            <a href="registrar.php" class="link">Não tenho conta</a>
            <div class="paw">🐶 🐱</div>
        </div>
    </div>
</body>
</html>
