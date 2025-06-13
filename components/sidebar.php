<?php
function renderizar_item_menu(string $arquivo, string $label, string $emoji): string {
    $paginaAtual = basename($_SERVER['SCRIPT_NAME'], '.php');
    $ativo = $paginaAtual === $arquivo ? 'ativo' : '';
    return "<li><a href=\"$arquivo.php\" class=\"$ativo\">$emoji $label</a></li>";
}
?>

<nav class="sidebar">
    <ul>
        <?= renderizar_item_menu("dashboard", "Dashboard", "🏠") ?>
        <?= renderizar_item_menu("pets", "Pets", "🐶") ?>
        <?= renderizar_item_menu("especies", "Espécies", "🧬") ?>
    </ul>
</nav>
