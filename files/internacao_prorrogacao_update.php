
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  
$id = $_POST["id"];
$id_prorrogacao = $_POST["id_prorrogacao"];
$dias_autorizados = $_POST["dias_autorizados"];
$motivo_medico = utf8_decode($_POST["motivo_medico"]);
$qtd_respiratoria = $_POST["qtd_respiratoria2"];
$qtd_motora = $_POST["qtd_motora2"];



 $sql = "UPDATE `prorrogacao` SET  `dias_autorizados`= ".$dias_autorizados." ,  `motivo_medico`= '".$motivo_medico."' , `qtd_respiratoria`=".$qtd_respiratoria." , `qtd_motora`=".$qtd_motora.",`status`= 2, `data_autorizacao` = '".date("Y-m-d H:i:s" )."'  WHERE id = '".$id_prorrogacao."'";

 $update = mysqli_query($conn,$sql); 


 $sql = "SELECT dias FROM `internamento` WHERE `id` = '".$id."'";


 echo $dias_internamento = mysqli_query($conn,$sql) or die("erro ao selecionar");

 $result = mysqli_fetch_row($dias_internamento);
 


 $dias = $dias_autorizados + $result[0];


 $sql = "UPDATE `internamento` SET  `dias`= ".$dias.", `qtd_respiratoria`=".$qtd_respiratoria." , `qtd_motora`=".$qtd_motora." WHERE id = '".$id."'";

 $update = mysqli_query($conn,$sql); 

 echo $update = mysqli_query($conn,"UPDATE `internamento` SET `prorrogacao`= null WHERE id = '".$id."'");        
        
echo"<script language='javascript' type='text/javascript'>alert('Prorroga\u00e7\u00e3o efetuada com sucesso!');window.location.href='internacao_menu.php?id=".$id."&prorro=1'</script>";

       

    
    
?>