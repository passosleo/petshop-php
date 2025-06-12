<?php
require("protege.php");
$nome = $_SESSION["nome"];
$pagina = $_GET["pagina"] ?? "dashboard";

$permitidas = ["pets", "especies", "dashboard"];

if (!in_array($pagina, $permitidas)) {
    $pagina = "dashboard";
}

function renderizar_item_menu(string $id, string $label, string $emoji, string $paginaAtual): string {
    $ativo = $paginaAtual === $id ? 'ativo' : '';
    return "<li><a href=\"?pagina=$id\" class=\"$ativo\">$emoji $label</a></li>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
</head>
<body class="inicio">
    <header>
        <div class="logo">🐾 PetShop</div>
        <div class="user-area">
            <span>Bem-vindo, <b><?= htmlspecialchars($nome) ?></b></span>
            <a href="logout.php" class="logout">Sair</a>
        </div>
    </header>

    <div class="layout">
        <nav class="sidebar">
            <ul>
                <?= renderizar_item_menu("dashboard", "Dashboard", "🏠", $pagina) ?>
                <?= renderizar_item_menu("pets", "Pets", "🐶", $pagina) ?>
                <?= renderizar_item_menu("especies", "Espécies", "🧬", $pagina) ?>
            </ul>
        </nav>
        <main class="content">
            <?php include "paginas/$pagina.php"; ?>
        </main>
    </div>
</body>
</html>
