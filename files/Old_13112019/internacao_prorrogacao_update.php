
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  
$id = $_POST["id"];
$id_prorrogacao = $_POST["id_prorrogacao"];
$dias_autorizados = $_POST["dias_autorizados"];
$motivo_medico = utf8_decode($_POST["motivo_medico"]);



 $sql = "UPDATE `prorrogacao` SET  `dias_autorizados`= ".$dias_autorizados." ,  `motivo_medico`= '".$motivo_medico."' , `status`= 2  WHERE id = '".$id_prorrogacao."'";

 $update = mysqli_query($conn,$sql); 


 $sql = "SELECT dias FROM `internamento` WHERE `id` = '".$id."'";


 echo $dias_internamento = mysqli_query($conn,$sql) or die("erro ao selecionar");

 $result = mysqli_fetch_row($dias_internamento);
 


 $dias = $dias_autorizados + $result[0];


 $sql = "UPDATE `internamento` SET  `dias`= ".$dias." WHERE id = '".$id."'";

 $update = mysqli_query($conn,$sql); 

        
        
echo"<script language='javascript' type='text/javascript'>alert('Prorroga\u00e7\u00e3o efetuada com sucesso!');window.location.href='internacao_prorrogacao_relatorio.php?id_internacao=".$id."'</script>";

       

    
    
?>