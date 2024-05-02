<?php

  //Conex達o com o banco 
  $host = 'localhost';
  $usuario = 'root';
  $senha = '';
  $banco = 'credenciado_prod';
  
  $conn = mysqli_connect($host,$usuario ,$senha,$banco);

  $dsn = "mysql:host={$host};port=3306;dbname={$banco}";


  try 
{
    // Conectando
    $pdo = new PDO($dsn, $usuario, $senha);
} 
catch (PDOException $e) 
{
    // Se ocorrer algum erro na conex達o
    die($e->getMessage());
}

if(!isset($_SESSION)){

  //Tempo de permanencia da sess達o
 // session_cache_expire(180000);
  // In鱈cio de sess達o
  session_start();
}

// Configura艫o da data e hora
date_default_timezone_set('America/Maceio');

?>