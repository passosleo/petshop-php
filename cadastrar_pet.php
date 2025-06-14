<?php
require("utils/protege.php");
require("db/conexao.php");

$sql = "SELECT id_especie, nome FROM especies ORDER BY nome ASC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pet - PetShop</title>
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
                    <h1>Cadastrar Pet</h1>
                    <p>Preencha o formulário para adicionar um novo pet.</p>
                </div>
                <a href="/pets.php" class="add-button">Voltar</a>
            </div>

            <section>
              <div class="form-container">
                  <form method="post" action="actions/pets/cadastrar_pet_action.php">
                      <label for="nome"><strong>Nome</strong></label>
                      <input type="text" id="nome" name="nome" required>

                      <label for="id_especie"><strong>Espécie</strong></label>
                      <select id="id_especie" name="id_especie" required>
                          <option value="">Selecione...</option>
                          <?php while ($especie = mysqli_fetch_assoc($resultado)): ?>
                              <option value="<?= $especie['id_especie'] ?>"><?= htmlspecialchars($especie['nome']) ?></option>
                          <?php endwhile; ?>
                      </select>

                      <label><strong>Gênero</strong></label>
                      <div class="radio-group">
                          <label><input type="radio" name="genero" value="M" required> Macho</label>
                          <label><input type="radio" name="genero" value="F" required> Fêmea</label>
                      </div>

                      <label for="dt_nascimento"><strong>Data de Nascimento</strong></label>
                      <input type="date" id="dt_nascimento" name="dt_nascimento" required>

                      <label for="prontuario"><strong>Prontuário</strong></label>
                      <textarea id="prontuario" name="prontuario" rows="5" placeholder="Informações do pet..."></textarea>

                      <button type="submit">Cadastrar</button>
                      <?php require("utils/mostra_mensagem.php");?> 
                  </form>
              </div>
            </section>
        </main>
    </div>
</body>
</html>
