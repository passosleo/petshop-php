<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli("localhost", "root", "php", "php", 3366);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    header("Location: /erro.php");
    exit();
}
?>
