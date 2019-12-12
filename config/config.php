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

if(!isset($_SESSION)){

  //Tempo de permanencia da sessão
 // session_cache_expire(180000);
  // Início de sessão
  session_start();
}

// Configuração da data e hora
date_default_timezone_set('America/Maceio');

?>