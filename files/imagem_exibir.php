<?php
    // Arquivo de configuração
  require_once "../config/config.php";
  
$id_imagem = $_GET['id'];

$querySelecionaPorCodigo = "SELECT imagem, tipo FROM imagem WHERE id = '".$id_imagem."'";

$resultado = mysqli_query($conn, $querySelecionaPorCodigo) or die("Algo deu errado ao caregar o registro. Tente novamente.");

$row=mysqli_fetch_object($resultado); 

if($row->tipo == 'image/png'){
    Header( "Content-type: image/gif"); 
}else{
    Header( "Content-type: application/pdf"); 
}

    echo $row->imagem;


?>

