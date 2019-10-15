<?php
    // Arquivo de configuração
  require_once "../config/config.php";

$id = $_GET["id"];
$id_imagem = $_GET["id_imagem"];
$sqlExclusao = "DELETE FROM imagem WHERE id = '".$id_imagem."' ";
$queryExclusao = mysqli_query($conn, $sqlExclusao) 
or die("Algo deu errado ao excluir a imagem. Tente novamente.");

header("Location: internacao_menu.php?id=".$id."&status=");
?>