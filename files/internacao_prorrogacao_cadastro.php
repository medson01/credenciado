
<?php 
  //Arquivo de configura��o
  include "cabecalho.php";
  

$id_internamento = $_POST["id"];
$id_usuario = $_POST["id_usuario"];
$medico_solicitante = $_POST["medico_solicitante"];
$crm = $_POST["crm"];
$dias = $_POST["dias"];
$motivo = $_POST["motivo"];


            $query = "INSERT INTO `prorrogacao`(`id`, `id_internamento`, `id_usuario`, `medico_solicitante`, `crm`, `dias`, `motivo`, `data_prorrogacao`) VALUES ( null ,'".$id_internamento."','".$id_usuario."', '".$medico_solicitante."' , '".$crm."' , '".$dias."' , '".$motivo."' ,'".date("Y-m-d H:i:s" )."')";
	 
        $insert = mysqli_query($conn, $query);
		
		    $res = mysqli_insert_id($conn);
        
        if($insert){
          
		   echo"<script language='javascript' type='text/javascript'>window.location.href='internacao_prorrogacao_relatorio.php?id_internacao=".$id_internamento."'</script>";
          
        }else{
		
          echo"<script language='javascript' type='text/javascript'>alert('internamento n�o cadastrado com sucesso!');window.location.href='painel.php?int=1'</script>";

        }
  
     
    
?>