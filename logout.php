<?php
      require('./connection.php');
      session_start();
      session_unset();
      session_destroy();
      pg_close();
      header("Location: ./index.php");
?>