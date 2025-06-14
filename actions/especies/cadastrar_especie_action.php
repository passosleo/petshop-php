<?php
require("../../db/conexao.php");
require("../../utils/protege.php");

if (isset($_POST['nome'])) {
    $nome = trim($_POST['nome']);

    if (empty($nome)) {
        $_SESSION["erro"] = "O nome da espécie é obrigatório.";
    } else {
        $stmt = $conn->prepare("SELECT id_especie FROM especies WHERE nome = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION["erro"] = "Já existe uma espécie com esse nome.";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO especies (nome, criado_em, atualizado_em) VALUES (?, NOW(), NOW())");
            $stmt->bind_param("s", $nome);
            if ($stmt->execute()) {
                $_SESSION["sucesso"] = "Espécie cadastrada com sucesso!";
            } else {
                $_SESSION["erro"] = "Erro ao cadastrar espécie.";
            }
        }
        $stmt->close();
    }
}

header("Location: /especies.php");
exit;
?>
