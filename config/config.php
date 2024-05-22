<?php

/*
VARI�VEIS ALTERADAS 
  senha => pwd
  usuario => user
  banco => bd 
*/

  //Conexão com o banco 
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
    // Se ocorrer algum erro na conexão
    die($e->getMessage());
}

if(!isset($_SESSION)){

  //Tempo de permanencia da sessão
 // session_cache_expire(180000);
  // Início de sessão
  session_start();
}

// Configura��o da data e hora
date_default_timezone_set('America/Maceio');

?>