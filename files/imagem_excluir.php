<?php
    // Arquivo de configuração
  require_once "../config/config.php";

$id = $_GET["id"];
$sqlExclusao = "DELETE FROM imagem WHERE id = '".$id."' ";
$queryExclusao = mysqli_query($conn, $sqlExclusao) 
or die("Algo deu errado ao excluir a imagem. Tente novamente.");

header("Location: ".$_SERVER['HTTP_REFERER']."&status=2");
?>