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
    <title>Registrar-se - PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
     <div class="login-wrapper">
        <div class="container">
            <div class="icon">🐾</div>
            <h2>Crie sua conta</h2>
            <form id="cadastro_form" method="POST" action="actions/auth/registrar_action.php">
                <input type="text" name="nome" placeholder="Nome completo" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input id="senha" type="password" name="senha" placeholder="Senha" required>
                <input id="confirmar_senha" type="password" name="confirmar_senha" placeholder="Confirmar senha" required>
                <p id="senha_erro" class="error" style="display: none;">As senhas não coincidem.</p>
                <button type="submit">Cadastrar</button>
                <?php require("utils/mostra_mensagem.php");?>
            </form>
            <a href="login.php" class="link">Já tenho conta</a>
            <div class="paw">🐶 🐱</div>
        </div>
    </div>
    <script>
        const form = document.getElementById('cadastro_form');
        const senha = document.getElementById('senha');
        const confirmarSenha = document.getElementById('confirmar_senha');
        const erro = document.getElementById('senha_erro');

        form.addEventListener('submit', function (e) {
            if (senha.value !== confirmarSenha.value) {
                e.preventDefault();
                erro.style.display = 'block';
                confirmarSenha.focus();
            } else {
                erro.style.display = 'none';
            }
        });
    </script>
</body>
</html>
