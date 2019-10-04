<?php

  //Conexão com o banco 
  $host = 'localhost';
  $usuario = 'root';
  $senha = '';
  $banco = 'credenciado';
  
  $conn = mysqli_connect($host,$usuario ,$senha,$banco);

  $dsn = "mysql:host={$host};port=3306;dbname={$banco}";


  try 
{
    // Conectando
    $pdo = new PDO($dsn, $usuario, $senha);
} 
catch (PDOException $e) 
{
    // Se ocorrer algum erro na conexão
    die($e->getMessage());
}

  // Início de sessão
  session_start();
         

?>