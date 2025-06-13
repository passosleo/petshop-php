<?php
require("utils/protege.php");
require("db/conexao.php");

$sql = "SELECT id_especie, nome, criado_em, atualizado_em FROM especies ORDER BY nome ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Espécies - PetShop</title>
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
                    <h1>Espécies</h1>
                    <p>Gerencie as espécies de pets cadastradas.</p>
                </div>
                <a href="cadastrar_especie.php" class="add-button">Adicionar</a>
            </div>

            <section>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="list-table">
                        <thead>
                            <tr>
                                <th style="width: 70px;">ID</th>
                                <th>Nome</th>
                                <th>Criado em</th>
                                <th>Atualizado em</th>
                                <th style="width: 170px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['id_especie']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['criado_em'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['atualizado_em'])); ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="editar_especie.php?id=<?php echo $row['id_especie']; ?>" class="btn-actions btn-editar">Editar</a>
                                            <a href="actions/especies/excluir_especie_action.php?id=<?php echo $row['id_especie']; ?>" class="btn-actions btn-excluir" onclick="return confirm('Deseja realmente excluir esta espécie?');">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    
                <?php else: ?>
                    <div class="sem-dados">Nenhuma espécie cadastrada até o momento.</div>
                <?php endif; ?>
                <?php require("utils/mostra_mensagem.php");?>
            </section>
        </main>
    </div>
</body>
</html>
