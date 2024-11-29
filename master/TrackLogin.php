<?php 

require_once "LoginHandler.php";
require_once "../funcoes/Conexao.php";
require_once "../funcoes/Key.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cpflogin"], $_POST["senhalogin"])) {
  $loginCpf = $_POST['cpflogin'];
  $loginSenha = $_POST['senhalogin'];

  // Instancia a classe passando a conexão com o banco
  $loginHandler = new LoginHandler($connect);

  // Chama o método de autenticação
  $redirectUrl = $loginHandler->authenticate($loginCpf, $loginSenha);

  // Retorna a URL em formato JSON
  echo json_encode(['redirect' => $redirectUrl]);
}

?>