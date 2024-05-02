<?php
	    // Arquivo de configuração
  require_once "../config/config.php";

       # Corrige o erro de acentuação no banco
         mysqli_query($conn,"SET NAMES 'utf8'");

$matricula = $_POST["matricula"];
$not_biometria = $_POST["not_biometria"];

$query = "UPDATE `biometria` SET  `not_biometria`='".$not_biometria."' WHERE  `matricula`='".$matricula."' ";

$update = mysqli_query($conn, $query);

if($insert){

	echo"<script language='javascript' type='text/javascript'>modal.style.display = 'none';'</script>";

}else{

	echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar');window.location.href='painel.php?int=1'</script>";
}

?>