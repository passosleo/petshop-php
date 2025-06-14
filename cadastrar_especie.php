<?php require("utils/protege.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Espécie - PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body class="page">
    <?php include "components/header.php"; ?>

    <div class="layout">
        <?php include "components/sidebar.php"; ?>
        <main class="content">
            <div class="page-header">
                <div>
                    <h1>Cadastrar Espécie</h1>
                    <p>Preencha o formulário para adicionar uma nova espécie.</p>
                </div>
                <a href="especies.php" class="add-button">Voltar</a>
            </div>

            <section>
                <form method="post" style="max-width: 400px;" action="actions/especies/cadastrar_especie_action.php">
                    <label for="nome" style="display: block; margin-bottom: 6px; font-weight: bold;">Nome da Espécie</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Cachorro" required>

                    <button type="submit">Cadastrar</button>
                    <?php require("utils/mostra_mensagem.php");?>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
