
<?php 
  //Arquivo de configuração
  include "cabecalho.php";

$id_cid = $_POST["id_cid"];
$matricula = $_POST["matricula"];
$nome = $_POST["nome"];
$dias = $_POST["dias"];
$solicitante = $_POST["solicitante"];
$crm = $_POST["crm"];
$motivo = $_POST["motivo"];
$cid = $_POST["cid"];
$cid_desc = $_POST["cid_desc"];

$matricula = str_replace(".", "", $matricula);
$matricula = str_replace("-", "", $matricula);

		$query = "INSERT INTO `internamento`(`id`, `id_usuario`, `id_cid`, `id_revalida`, `nome`, `matricula`, `solicitante`, `crm`, `dat_entrada`,`motivo`, `prorrogacao`) VALUES (null ,'".$_SESSION['id']."', '".$id_cid."' , null , '".$nome."' , '".$matricula."' , '".$solicitante."' , '".$crm."' , '".date("Y-m-d H:i:s" )."' , '".$motivo."', null)";

        
	 
        $insert = mysqli_query($conn, $query);
		
		    $res = mysqli_insert_id($conn);
        
        if($insert){
          
          require_once"internacao_relatorio.php";
          
        }else{
         echo"<script language='javascript' type='text/javascript'>alert('internamento não cadastrado com sucesso!');window.location.href='internacao_fomulario.php'</script>";

        }
  
     
    
?>