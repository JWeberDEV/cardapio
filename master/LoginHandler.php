<?php

require_once "../funcoes/Conexao.php";
require_once "../funcoes/Key.php";

class LoginHandler
{
  private $connect;

  public function __construct($dbConnection)
  {
    if (!$dbConnection instanceof PDO) {
      throw new InvalidArgumentException("Invalid database connection.");
    }
    $this->connect = $dbConnection;
  }

  public function authenticate($cpfLogin, $senhaLogin)
  {
    try {
      $senhaHash = sha1($senhaLogin);

      // Query para buscar o usuário
      $query = "SELECT id FROM adm WHERE login = :login AND senha = :senha";
      $stmt = $this->connect->prepare($query);

      $arrayData = [
        'login' => "$cpfLogin",
        'senha' => "$senhaHash"
      ];

      $stmt->execute($arrayData) or die ('query failed');
      
      $countUser = $stmt->rowCount();
      
      if ($countUser > 0) {
        $dadosCliente = $stmt->fetch(PDO::FETCH_OBJ);

        if ($dadosCliente->id) {
          // Salva o ID do usuário na sessão
          session_start();
          $_SESSION["cod_id"] = $dadosCliente->id;

          // Retorna a URL de redirecionamento
          return "controle.php";
        }
      }

      // Retorna para a página inicial com erro, se não autenticado
      return "./?erro=login";
    } catch (Exception $e) {
      // Em caso de erro, logar ou exibir mensagem de erro
      error_log("Exception in authenticate: " . $e->getMessage());
      return "./?erro=server";
    }
  }
}
