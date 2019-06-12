
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
$id_beneficiarios = $_POST["id_beneficiarios"];
$id_pa = $_POST["id_pa"];

//$matricula = str_replace(".", "", $matricula);
//$matricula = str_replace("-", "", $matricula);
//$matric = substr($matricula, 9, -2);

    $query = mysqli_query($conn,"SELECT * FROM `beneficiarios` WHERE `matricula` = '".$id_beneficiarios."'") or die("erro ao selecionar");



    if($_POST['id_pa'] == false){


		    $query = "INSERT INTO `internamento`(`id`, `id_usuario`, `id_cid`, `id_beneficiarios`, `id_pa`,`nome`, `matricula`, `solicitante`, `crm`, `dat_entrada`,`dat_saida`, `motivo`, `prorrogacao`) VALUES (null ,'".$_SESSION['id']."', '".$id_cid."' , '".$id_beneficiarios."', '0' , '".$nome."' , '".$matricula."' , '".$solicitante."' , '".$crm."' , '".date("Y-m-d H:i:s" )."' , null ,'".$motivo."', null)";

     }else{

        $id_pa = $_POST['id_pa'];

        $query = "INSERT INTO `internamento`(`id`, `id_usuario`, `id_cid`, `id_beneficiarios`, `id_pa`,`nome`, `matricula`, `solicitante`, `crm`, `dat_entrada`, `dat_saida` , `motivo`, `prorrogacao`) VALUES (null ,'".$_SESSION['id']."', '".$id_cid."' , '".$id_beneficiarios."' , '".$id_pa."' , '".$nome."' , '".$matricula."' , '".$solicitante."' , '".$crm."' , '".date("Y-m-d H:i:s" )."' , null , '".$motivo."', null)";

     }

       
	 
        $insert = mysqli_query($conn, $query);
		
		    $res = mysqli_insert_id($conn);
        
        if($insert){
          
          require_once"internacao_relatorio.php";
          
        }else{
         echo"<script language='javascript' type='text/javascript'>alert('internamento não cadastrado com sucesso!');window.location.href='painel.php?int=1'</script>";

        }
  
     
    
?>