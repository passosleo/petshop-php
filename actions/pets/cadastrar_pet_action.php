<?php
require("../../db/conexao.php");
require("../../utils/protege.php");

if (isset($_POST['nome'], $_POST['id_especie'], $_POST['genero'], $_POST['dt_nascimento'])) {
    $nome = trim($_POST['nome']);
    $id_especie = (int) $_POST['id_especie'];
    $genero = $_POST['genero'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $prontuario = isset($_POST['prontuario']) ? trim($_POST['prontuario']) : '';

    if (empty($nome) || empty($id_especie) || empty($genero) || empty($dt_nascimento)) {
        $_SESSION["erro"] = "Todos os campos obrigatórios devem ser preenchidos.";
    } else {
        $stmt = $conn->prepare("INSERT INTO pets (nome, id_especie, genero, dt_nascimento, prontuario, criado_em, atualizado_em) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("sisss", $nome, $id_especie, $genero, $dt_nascimento, $prontuario);
        if ($stmt->execute()) {
            $_SESSION["sucesso"] = "Pet cadastrado com sucesso!";
        } else {
            $_SESSION["erro"] = "Erro ao cadastrar pet.";
        }
        $stmt->close();
    }
} else {
    $_SESSION["erro"] = "Dados incompletos enviados.";
}

header("Location: /cadastrar_pet.php");
exit;
