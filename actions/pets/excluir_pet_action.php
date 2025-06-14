<?php
require("../../db/conexao.php");
require("../../utils/protege.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['erro'] = "ID inválido para exclusão.";
    header("Location: /pets.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT id_pet FROM pets WHERE id_pet = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $_SESSION['erro'] = "Pet não encontrado.";
    $stmt->close();
    header("Location: /pets.php");
    exit;
}
$stmt->close();

$stmt = $conn->prepare("DELETE FROM pets WHERE id_pet = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = "Pet excluído com sucesso!";
} else {
    $_SESSION['erro'] = "Erro ao excluir pet.";
}

$stmt->close();
header("Location: /pets.php");
exit;
?>
