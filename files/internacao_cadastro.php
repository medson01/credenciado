
<?php 
  //Arquivo de configuração
  include "cabecalho.php";


$id_cid = $_POST["id_cid"];
$matricula = $_POST["matricula"];
$nome = $_POST["nome"];
$dias = $_POST["dias"];
$solicitante = $_POST["solicitante"];
$crm = $_POST["crm"];
$motivo =  utf8_decode($_POST["motivo"]);
$cid = $_POST["cid"];
$cid_desc = utf8_decode($_POST["cid_desc"]);
$id_beneficiarios = $_POST["id_beneficiarios"];
$id_pa = $_POST["id_pa"];
$id_acomodacao = $_POST["id_acomodacao"];
$id_usuario = $_POST["id_usuario"];
$contato = $_POST["contato"];



// Tratamento contato
$contato = str_replace("(", "", $contato);
$contato = str_replace(")", "", $contato);
$contato = str_replace(" ", "", $contato);
$contato = str_replace("-", "", $contato);

//$matricula = str_replace(".", "", $matricula);
//$matricula = str_replace("-", "", $matricula);
//$matric = substr($matricula, 9, -2);

//session_destroy();



    $query = mysqli_query($conn,"SELECT * FROM `beneficiarios` WHERE `matricula` = '".$id_beneficiarios."'") or die("erro ao selecionar");



    if($_POST['id_pa'] == false){


		     $query = "INSERT INTO `internamento`(`id`, `id_usuario`, `id_cid`, `id_beneficiarios`, `id_pa`, `id_prorrogacao` , `id_alocacao` , `nome`, `matricula`, `solicitante`, `crm`, `dat_entrada`,`dat_saida`, `motivo`, `prorrogacao`, `dias` , `qtd_respiratoria` ,`qtd_motora`) VALUES (null ,'".$id_usuario."', '".$id_cid."' , '".$id_beneficiarios."', '0' , null  , null , '".$nome."' , '".$matricula."' , '".$solicitante."' , '".$crm."' , '".date("Y-m-d H:i:s" )."' , null ,'".$motivo."', null,'".$dias."' , null , null)";

     }else{

        $id_pa = $_POST['id_pa'];

        $query = "INSERT INTO `internamento`(`id`, `id_usuario`, `id_cid`, `id_beneficiarios`, `id_pa`,`id_prorrogacao` , `id_alocacao` , `nome`, `matricula`, `solicitante`, `crm`, `dat_entrada`, `dat_saida` , `motivo`, `prorrogacao`, `dias`, `qtd_respiratoria` ,`qtd_motora` ) VALUES (null ,'".$id_usuario."', '".$id_cid."' , '".$id_beneficiarios."' , '".$id_pa."' , null , null , '".$nome."' , '".$matricula."' , '".$solicitante."' , '".$crm."' , '".date("Y-m-d H:i:s" )."' , null , '".$motivo."', null,'".$dias."', null , null)";

     }
       
	 
        $insert = mysqli_query($conn, $query);
		
		$res = mysqli_insert_id($conn);
		
		



        $query = "INSERT INTO `alocacao`(`id`, `id_internamento`, `id_acomodacao`, `motivo`, `data`) VALUES (null , '".$res."', '".$id_acomodacao."' , null ,'".date("Y-m-d H:i:s" )."' )";

        $insert = mysqli_query($conn, $query);

        $id_alocacao = mysqli_insert_id($conn);
		
		
		// Atualização das Tabelas internamento e beneciciarios
        $sql1 = "UPDATE `internamento` SET  `id_alocacao`= ".$id_alocacao." WHERE id = '".$res."'";
        $update1 = mysqli_query($conn,$sql1); 
		
		$sql2 = "UPDATE `beneficiarios` SET  `contato`= ".$contato." WHERE id = '".$id_beneficiarios."'";    
        $update2 = mysqli_query($conn,$sql2); 

        
        // Se não tiver biometria set 1 se não null
        if( (isset($_GET["not_biometria"])) && ($_GET["not_biometria"]) == 1 ){
          $sql3 = "UPDATE `beneficiarios` SET  `not_biometria`= 1 WHERE  `nome` = '".$matricula."'";
          $update3 = mysqli_query($conn,$sql3);         
        }
        
        if($insert){

          require_once"internacao_relatorio.php";
          
        }else{
         echo"<script language='javascript' type='text/javascript'>alert('internamento não cadastrado com sucesso!');window.location.href='painel.php?int=1'</script>";

        }
  
     
    
?>