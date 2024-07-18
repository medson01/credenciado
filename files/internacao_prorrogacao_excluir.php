<?php
    // Arquivo de configuração
  require_once "../config/config.php";

$id = $_GET["id"];
$id_prorrogacao = $_GET["id_prorrogacao"];


$sql = "DELETE FROM prorrogacao WHERE id_internamento = '".$id."' and id='".$id_prorrogacao."'";
$stmt = $pdo->prepare($sql);
		if ($stmt->execute()){
echo"<script language='javascript' type='text/javascript'>alert('Prorrogação exluida!');window.location.href='internacao_menu.php?id=".$id."&prorro=x';</script>";
					exit;	
		}	
?>