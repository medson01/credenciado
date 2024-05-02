
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  

$id = $_POST["id"];
$id_imagem = $_POST["id_imagem"];
$id_usuario = $_POST["id_usuario"];
$medico_solicitante = utf8_decode($_POST["medico_solicitante"]);
$crm = $_POST["crm"];
$dias_solicitados = $_POST["dias"];
$motivo = utf8_decode($_POST["motivo"]);
$motivo_medico = utf8_decode($_POST["motivo_medico"]);
$qtd_respiratoria = $_POST["qtd_respiratoria"];
$qtd_motora = $_POST["qtd_motora"];


          $query = "INSERT INTO `prorrogacao`(`id`, `id_internamento`, `id_usuario`, `medico_solicitante`, `crm`, `dias_solicitados`, `dias_autorizados` , `motivo`, `motivo_medico`, `data_prorrogacao` , `qtd_respiratoria`, `qtd_motora`,`status`) VALUES ( null ,'".$id."','".$id_usuario."', '".$medico_solicitante."' , '".$crm."' , '".$dias_solicitados."' , null ,'".$motivo."' ,'".$motivo_medico."' ,'".date("Y-m-d H:i:s" )."' ,'".$qtd_respiratoria."' ,'".$qtd_motora."' , '1' )";

	 
        $insert = mysqli_query($conn, $query);
		
		    $id_prorrogacao = mysqli_insert_id($conn);

        $update = mysqli_query($conn,"UPDATE `imagem` SET `id_prorrogacao`= '".$id_prorrogacao."' WHERE id = '".$id_imagem."'"); 

        $update = mysqli_query($conn,"UPDATE `internamento` SET `prorrogacao`= 1 WHERE id = '".$id."'"); 

        
        if($insert){
          
		 echo"<script language='javascript' type='text/javascript'>alert('Solicita\u00e7\u00e3oo de prorroga\u00e7\u00e3o encaminhada para aprova\u00e7\u00e3o!');window.location.href='painel.php?int=1'</script>";
         // echo"<script language='javascript' type='text/javascript'>alert('Alteração aplicada com sucesso!'); history.go(-1);</script>";

        }else{
		
    echo"<script language='javascript' type='text/javascript'>alert('internamento não cadastrado com sucesso!');window.location.href='painel.php?int=1'</script>";

        }
  
     
    
?>