<?php
require("utils/protege.php");
require("db/conexao.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION["erro"] = "ID de pet inválido.";
    header("Location: /pets.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM pets WHERE id_pet = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION["erro"] = "Pet não encontrado.";
    header("Location: /pets.php");
    exit;
}

$pet = $result->fetch_assoc();
$stmt->close();

$especies_resultado = mysqli_query($conn, "SELECT id_especie, nome FROM especies ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Pet - PetShop</title>
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
                    <h1>Editar Pet</h1>
                    <p>Atualize os dados do pet.</p>
                </div>
                <a href="/pets.php" class="add-button">Voltar</a>
            </div>

            <section>
                <div class="form-container">
                    <form method="post" action="actions/pets/editar_pet_action.php">
                        <input type="hidden" name="id" value="<?php echo $pet['id_pet']; ?>">

                        <label for="nome"><strong>Nome</strong></label>
                        <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($pet['nome']); ?>">

                        <label for="id_especie"><strong>Espécie</strong></label>
                        <select id="id_especie" name="id_especie" required>
                            <option value="">Selecione...</option>
                            <?php while ($esp = mysqli_fetch_assoc($especies_resultado)): ?>
                                <option value="<?php echo $esp['id_especie']; ?>" <?php if ($esp['id_especie'] == $pet['id_especie']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($esp['nome']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <label><strong>Gênero</strong></label>
                        <div class="radio-group">
                            <label><input type="radio" name="genero" value="M" <?php if ($pet['genero'] == 'M') echo 'checked'; ?> required> Macho</label>
                            <label><input type="radio" name="genero" value="F" <?php if ($pet['genero'] == 'F') echo 'checked'; ?> required> Fêmea</label>
                        </div>

                        <label for="dt_nascimento"><strong>Data de Nascimento</strong></label>
                        <input type="date" id="dt_nascimento"  name="dt_nascimento" value="<?php echo $pet['dt_nascimento']; ?>">

                        <label for="prontuario"><strong>Prontuário</strong></label>
                        <textarea id="prontuario" name="prontuario" rows="5"><?php echo htmlspecialchars($pet['prontuario']); ?></textarea>

                        <button type="submit">Salvar Alterações</button>
                        <?php require("utils/mostra_mensagem.php"); ?>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
