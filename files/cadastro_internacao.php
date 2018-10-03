
<?php 
  //Arquivo de configuração
  include "cabecalho.php";

$id_cid = $_POST["cid"];
$matricula = $_POST["matricula"];
$nome = $_POST["nome"];
$dias = $_POST["dias"];
$solicitante = $_POST["solicitante"];
$crm = $_POST["crm"];

$matricula = str_replace(".", "", $matricula);
$matricula = str_replace("-", "", $matricula);

		$query = "INSERT INTO `internamento`(`id`, `id_usuario`, `id_cid`, `id_revalida`, `nome`, `matricula`, `solicitante`, `crm`, `data`) VALUES (null ,'".$_SESSION['id']."', '".$id_cid."' , null , '".$nome."' , '".$matricula."' , '".$solicitante."' , '".$crm."' ,'".date("Y-m-d H:i:s")."')";

        
	 
        $insert = mysqli_query($conn, $query);
		
		$res = mysqli_insert_id($conn);
        
        if($insert){
          
          require_once"rel_internacao.php";
          
        }else{
         echo"<script language='javascript' type='text/javascript'>alert('Aviso não cadastrado com sucesso!');window.location.href='form_internacao.php'</script>";

        }
  
      
    
?>