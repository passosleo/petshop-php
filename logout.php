<?php
    session_start();
    session_destroy();
    header("Location: /trabalho_final_pet/login.php");
    exit;
?>
