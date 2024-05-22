<?php

/*
VARI햂EIS ALTERADAS 
  senha => pwd
  usuario => user
  banco => bd 
*/

  //Conex찾o com o banco 
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'credenciado_prod';
  
  $conn = mysqli_connect($host,$username ,$password ,$dbname);

  $dsn = "mysql:host={$host};port=3306;dbname={$dbname}";


  try 
{
    // Conectando
    $pdo = new PDO($dsn, $username, $password );
} 
catch (PDOException $e) 
{
    // Se ocorrer algum erro na conex찾o
    die($e->getMessage());
}

if(!isset($_SESSION)){

  //Tempo de permanencia da sess찾o
 // session_cache_expire(180000);
  // In챠cio de sess찾o
  session_start();
}

// Configura豫o da data e hora
date_default_timezone_set('America/Maceio');

?>