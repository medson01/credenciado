<?php
    // Arquivo de configuração
  require_once "../config/config.php";

$id = $_GET["id"];
$id_imagem = $_GET["id_imagem"];
$id_prorrogacao = $_GET["id_prorrogacao"];

$sql1 = "DELETE FROM imagem WHERE id = '".$id_imagem."' ";

$query1 = mysqli_query($conn, $sql1) or die("Algo deu errado ao excluir a imagem. Tente novamente.");

$sql2 = "DELETE FROM prorrogacao WHERE id_internamento = '".$id."' and id='".$id_prorrogacao."'";

$query2 = mysqli_query($conn, $sql2) or die("Algo deu errado ao excluir a imagem. Tente novamente.");


header("Location: internacao_menu.php?id=".$id."&status=");
?>