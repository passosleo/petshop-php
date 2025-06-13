<?php
require("../../db/conexao.php");
require("../../utils/protege.php");

if (isset($_POST['id'], $_POST['nome']) && is_numeric($_POST['id'])) {
    $id = (int) $_POST['id'];
    $nome = trim($_POST['nome']);

    if (empty($nome)) {
        $_SESSION["erro"] = "O nome da espécie é obrigatório.";
        header("Location: /editar_especie.php?id=$id");
        exit;
    }

    $stmt = $conn->prepare("SELECT id_especie FROM especies WHERE nome = ? AND id_especie != ?");
    $stmt->bind_param("si", $nome, $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION["erro"] = "Já existe outra espécie com esse nome.";
        $stmt->close();
        header("Location: /editar_especie.php?id=$id");
        exit;
    }
    $stmt->close();

    $stmt = $conn->prepare("UPDATE especies SET nome = ?, atualizado_em = NOW() WHERE id_especie = ?");
    $stmt->bind_param("si", $nome, $id);

    if ($stmt->execute()) {
        $_SESSION["sucesso"] = "Espécie atualizada com sucesso!";
    } else {
        $_SESSION["erro"] = "Erro ao atualizar espécie.";
    }

    $stmt->close();
}

header("Location: /especies.php");
exit;
