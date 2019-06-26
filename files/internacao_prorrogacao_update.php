
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  

$id_prorrogacao = $_POST["id_prorrogacao"];
$id_internamento = $_POST["id_internamento"];
$dias_autorizados = $_POST["dias_autorizados"];
$qtd_motora = $_POST["qtd_motora"];
$qtd_respiratoria = $_POST["qtd_respiratoria"];


 $sql = "UPDATE `prorrogacao` SET  `dias_autorizados`= ".$dias_autorizados." ,  `status`= 2  ,  `qtd_respiratoria`= ".$qtd_respiratoria." , `qtd_motora`= ".$qtd_motora."  WHERE id = '".$id_prorrogacao."'";

 $update = mysqli_query($conn,$sql); 


 $sql = "SELECT dias, qtd_respiratoria, qtd_motora FROM `internamento` WHERE `id` = '".$id_internamento."'";


 echo $dias_internamento = mysqli_query($conn,$sql) or die("erro ao selecionar");

 $result = mysqli_fetch_row($dias_internamento);
 


 $dias = $dias_autorizados + $result[0];
 $qtd_respiratoria = $qtd_respiratoria + $result[1];
 $qtd_motora = $qtd_motora + $result[2];


 $sql = "UPDATE `internamento` SET  `dias`= ".$dias." , `qtd_respiratoria`= ".$qtd_respiratoria." , `qtd_motora`= ".$qtd_motora."  WHERE id = '".$id_internamento."'";

 $update = mysqli_query($conn,$sql); 
        
        
	echo"<script language='javascript' type='text/javascript'>window.location.href='painel.php?int=1'</script>";

       

    
    
?>