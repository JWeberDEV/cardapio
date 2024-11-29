<?php

require_once(__DIR__ . "/../php/_session.php");

if ((!isset($_SESSION['cod_id']) == true)) {
  unset($_SESSION['cod_id']);
  header('location: ./');
}

function logout()
{
  ob_clean();
  session_unset();
  session_destroy();
  $_SESSION = array();
  header("location: /.");
  exit;
}

if (isset($_GET['opt']) && $_GET['opt'] == "logout") {
  logout();
}

?>