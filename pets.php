<?php
require("utils/protege.php");
require("db/conexao.php");

$sql = "SELECT p.id_pet, p.nome, p.prontuario, p.dt_nascimento, p.genero, p.criado_em, p.atualizado_em, e.nome AS especie 
        FROM pets p
        JOIN especies e ON p.id_especie = e.id_especie
        ORDER BY p.nome ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pets - PetShop</title>
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
                    <h1>Pets</h1>
                    <p>Gerencie os pets cadastrados.</p>
                </div>
                <a href="actions/pets/cadastrar_pet.php" class="add-button">Adicionar</a>
            </div>

            <section>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="list-table">
                        <thead>
                            <tr>
                                <th style="width: 70px;">ID</th>
                                <th>Nome</th>
                                <th>Espécie</th>
                                <th>Gênero</th>
                                <th>Nascimento</th>
                                <th>Prontuário</th>
                                <th>Criado em</th>
                                <th>Atualizado em</th>
                                <th style="width: 170px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['id_pet']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($row['especie']); ?></td>
                                    <td><?php echo $row['genero']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['dt_nascimento'])); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars($row['prontuario'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['criado_em'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['atualizado_em'])); ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="actions/pets/editar_pet.php?id=<?php echo $row['id_pet']; ?>" class="btn-actions btn-editar">Editar</a>
                                            <a href="actions/pets/excluir_pet.php?id=<?php echo $row['id_pet']; ?>" class="btn-actions btn-excluir" onclick="return confirm('Deseja realmente excluir este pet?');">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="sem-dados">Nenhum pet cadastrado até o momento.</div>
                <?php endif; ?>
                <?php require("utils/mostra_mensagem.php");?>
            </section>
        </main>
    </div>
</body>
</html>
