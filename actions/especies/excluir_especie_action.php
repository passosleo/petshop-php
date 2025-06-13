<?php
require("../../db/conexao.php");
require("../../utils/protege.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['erro'] = "ID inválido para exclusão.";
    header("Location: /especies.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT id_especie FROM especies WHERE id_especie = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $_SESSION['erro'] = "Espécie não encontrada.";
    $stmt->close();
    header("Location: /especies.php");
    exit;
}
$stmt->close();

$stmt = $conn->prepare("DELETE FROM especies WHERE id_especie = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = "Espécie excluída com sucesso!";
} else {
    $_SESSION['erro'] = "Erro ao excluir espécie.";
}

$stmt->close();
header("Location: /especies.php");
exit;
?>
