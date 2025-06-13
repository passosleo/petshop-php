<?php
require("utils/protege.php");
require("db/conexao.php");

$sqlPets = "SELECT COUNT(*) AS total_pets FROM pets";
$resultPets = mysqli_query($conn, $sqlPets);
$linhaPets = mysqli_fetch_assoc($resultPets);
$totalPets = $linhaPets["total_pets"] ?? 0;

$sqlEspecies = "SELECT COUNT(*) AS total_especies FROM especies";
$resultEspecies = mysqli_query($conn, $sqlEspecies);
$linhaEspecies = mysqli_fetch_assoc($resultEspecies);
$totalEspecies = $linhaEspecies["total_especies"] ?? 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - PetShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/global.css">
    <style>
        section {
            margin-top: 2rem;
            background: #f7f7f7;
            padding: 1rem;
            border-radius: 8px;
        }

        section h2 {
            margin: 0px;
        }

        section ul {
            list-style: none;
            padding-left: 0;
        }

        section li {
            padding: 0.5rem 0;
        }
    </style>
</head>
<body class="page">
    <?php include "components/header.php"; ?>

    <div class="layout">
        <?php include "components/sidebar.php"; ?>
        <main class="content">
            <body>
                <h1>Bem-vindo à Dashboard</h1>
                <p>Escolha um módulo no menu à esquerda para começar.</p>

                <section>
                    <h2>Resumo</h2>
                    <ul>
                        <li>🐶 Total de pets cadastrados: <strong><?php echo $totalPets; ?></strong></li>
                        <li>🧬 Espécies disponíveis: <strong><?php echo $totalEspecies; ?></strong></li>
                    </ul>
                </section>
            </body>
        </main>
    </div>
</body>
</html>
