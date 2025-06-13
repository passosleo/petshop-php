<header>
    <div class="logo">🐾 PetShop</div>
    <div class="user-area">
        <span>Bem-vindo, <b><?= htmlspecialchars($_SESSION["nome"]) ?></b></span>
        <a href="actions/auth/logout_action.php" class="logout">Sair</a>
    </div>
</header>
