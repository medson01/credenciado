
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  

$id_internamento = $_POST["id"];
$id_usuario = $_POST["id_usuario"];
$medico_solicitante = $_POST["medico_solicitante"];
$crm = $_POST["crm"];
$dias_solicitados = $_POST["dias"];
$motivo = $_POST["motivo"];


            $query = "INSERT INTO `prorrogacao`(`id`, `id_internamento`, `id_usuario`, `medico_solicitante`, `crm`, `dias_solicitados`, `dias_autorizados` , `motivo`, `data_prorrogacao` , `status`) VALUES ( null ,'".$id_internamento."','".$id_usuario."', '".$medico_solicitante."' , '".$crm."' , '".$dias_solicitados."' , null ,'".$motivo."' ,'".date("Y-m-d H:i:s" )."' , '1' )";

	 
        $insert = mysqli_query($conn, $query);
		
		    $id_prorrogacao = mysqli_insert_id($conn);

        $update = mysqli_query($conn,"UPDATE `internamento` SET `id_prorrogacao`= '".$id_prorrogacao."' WHERE id = '".$id_internamento."'"); 
        
        if($insert){
          
		   echo"<script language='javascript' type='text/javascript'>window.location.href='internacao_prorrogacao_relatorio.php?id_internacao=".$id_internamento."'</script>";
          
        }else{
		
          echo"<script language='javascript' type='text/javascript'>alert('internamento não cadastrado com sucesso!');window.location.href='painel.php?int=1'</script>";

        }
  
     
    
?>