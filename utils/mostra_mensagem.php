<?php
  if (isset($_SESSION["erro"])) {
      echo '<p class="error">' . $_SESSION["erro"] . '</p>';
      unset($_SESSION["erro"]);
  }
  if (isset($_SESSION["sucesso"])) {
      echo '<p class="success">' . $_SESSION["sucesso"] . '</p>';
      unset($_SESSION["sucesso"]);
  }
?>
