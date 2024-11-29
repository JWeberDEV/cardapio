<?php

require_once(__DIR__ . "/../php/session.php");

if (empty($_SESSION['userAuth']["idUsuario"]) || empty($_SESSION['userAuth']["idPerfil"])) {
  header("location: /login.php");
  exit;
}

function logout()
{
  ob_clean();
  session_unset();
  session_destroy();
  $_SESSION = array();
  header("location: /login.php");
  exit;
}

if (isset($_GET['opt']) && $_GET['opt'] == "logout") {
  logout();
}

?>