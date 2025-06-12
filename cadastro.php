<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
</head>
<body>
     <div class="login-wrapper">
        <div class="container">
            <div class="icon">🐾</div>
            <h2>Crie sua conta</h2>
            <form method="POST" action="processa_cadastro.php">
                <input type="text" name="nome" placeholder="Nome completo" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="password" name="confirmar_senha" placeholder="Confirmar senha" required>
                <button type="submit">Cadastrar</button>
                <?php
                    session_start();
                    if (isset($_SESSION["erro"])) {
                        echo '<p class="error">' . $_SESSION["erro"] . '</p>';
                        unset($_SESSION["erro"]);
                    }
                    if (isset($_SESSION["sucesso"])) {
                        echo '<p class="success">' . $_SESSION["sucesso"] . '</p>';
                        unset($_SESSION["sucesso"]);
                    }
                ?>
            </form>
            <a href="login.php" class="link">Já tenho conta</a>
            <div class="paw">🐶 🐱</div>
        </div>
    </div>
</body>
</html>
