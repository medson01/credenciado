<?php
    // Arquivo de configuração
  require_once "../config/config.php";
  
$id_imagem = $_GET['id'];

$querySelecionaPorCodigo = "SELECT imagem FROM imagem WHERE id = '".$id_imagem."'";

$resultado = mysqli_query($conn, $querySelecionaPorCodigo) or die("Algo deu errado ao caregar o registro. Tente novamente.");

$row=mysqli_fetch_object($resultado); 

Header( "Content-type: image/gif"); 

    echo $row->imagem;




?>

