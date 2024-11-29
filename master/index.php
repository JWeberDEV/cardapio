<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Painel Administrativo Delivery.">
  <meta name="author" content="MDINELLY">
  <title>PAINEL ADMINISTRATIVO</title>
  <link href="../basecard/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../basecard/lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link rel="stylesheet" href="../basecard/css/slim.css">
  <?php require_once("../basecard/include/header.php"); ?>
</head>

<body>

  <div class="signin-wrapper">

    <div class="signin-box" align="center">
      <h3 class="slim-logo">ADM Master<span></h3>
      <div class="form-group">
        <input type="text" class="form-control" id="cpflogin" placeholder="Login" maxlength="14" required>
      </div><!-- form-group -->
      <div class="form-group">
        <input type="password" class="form-control" id="senhalogin" placeholder="Senha" maxlength="8" required>
      </div><!-- form-group -->
      <?php if (isset($_GET["erro"])) { ?>
        <div class="form-group" style="color:#FF0000">
          <i class="fa fa-certificate"></i> Login ou Senha incorreto.
        </div>
      <?php } ?>
      <button type="button" id="login" class="btn btn-primary btn-block btn-signin" onclick="login();">Entrar</button>
    </div>
  </div>
</body>

</html>

<script>
  $("#cpflogin").keyup(function(data) {
    if (data.keyCode === 13) {
      $("#login").click();
    }
  });

  $("#senhalogin").keyup(function(data) {
    if (data.keyCode === 13) {
      $("#login").click();
    }
  });

  const login = () => {
    let data = {
      cpflogin: $('#cpflogin').val(),
      senhalogin: $('#senhalogin').val()
    }

    $.post("../master/TrackLogin.php", data)
      .done(response => {
        response = JSON.parse(response);
        location.href = response.redirect;
      });
  }
</script>

<?php
ob_end_flush();
?>