<?php
require("../../db/conexao.php");
require("../../utils/protege.php");

if (isset($_POST['id'], $_POST['nome'], $_POST['id_especie'], $_POST['genero'], $_POST['dt_nascimento'], $_POST['prontuario'])) {
    echo "estou aqui";
    $id_pet = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $id_especie = (int) $_POST['id_especie'];
    $genero = $_POST['genero'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $prontuario = trim($_POST['prontuario']);

    if (empty($nome) || empty($genero) || empty($dt_nascimento)) {
        $_SESSION["erro"] = "Todos os campos obrigatórios devem ser preenchidos.";
    } else {
        $stmt = $conn->prepare("UPDATE pets SET nome = ?, id_especie = ?, genero = ?, dt_nascimento = ?, prontuario = ?, atualizado_em = NOW() WHERE id_pet = ?");
        $stmt->bind_param("sisssi", $nome, $id_especie, $genero, $dt_nascimento, $prontuario, $id_pet);
        if ($stmt->execute()) {
            $_SESSION["sucesso"] = "Pet atualizado com sucesso!";
        } else {
            $_SESSION["erro"] = "Erro ao atualizar pet.";
        }
        $stmt->close();
    }
} else {
    $_SESSION["erro"] = "Dados inválidos.";
}

header("Location: /editar_pet.php?id=" . $_POST['id']);
exit;
