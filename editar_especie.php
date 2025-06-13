<?php
require("utils/protege.php");
require("db/conexao.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION["erro"] = "ID inválido para edição.";
    header("Location: /especies.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT id_especie, nome FROM especies WHERE id_especie = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION["erro"] = "Espécie não encontrada.";
    header("Location: /especies.php");
    exit;
}

$especie = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Espécie - PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/global.css">
</head>
<body class="page">
    <?php include "components/header.php"; ?>

    <div class="layout">
        <?php include "components/sidebar.php"; ?>
        <main class="content">
            <div class="page-header">
                <div>
                    <h1>Editar Espécie</h1>
                    <p>Atualize os dados da espécie.</p>
                </div>
                <a href="/especies.php" class="add-button">Voltar</a>
            </div>

            <section>
                <form method="post" style="max-width: 400px;" action="actions/especies/editar_especie_action.php">
                    <input type="hidden" name="id" value="<?php echo $especie['id_especie']; ?>">
                    <label for="nome" style="display: block; margin-bottom: 6px; font-weight: bold;">Nome da Espécie</label>
                    <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($especie['nome']); ?>">
                    <button type="submit">Salvar Alterações</button>
                </form>
                <?php require("utils/mostra_mensagem.php"); ?>
            </section>
        </main>
    </div>
</body>
</html>
