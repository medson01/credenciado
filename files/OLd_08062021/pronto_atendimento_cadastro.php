
<?php 
  //Arquivo de configuração
  include "cabecalho.php";

  # Corrige o erro de acentuação no banco
        mysqli_query($conn,"SET NAMES 'utf8'");

$matricula = $_POST["matricula"];
$nome = $_POST["nome"];
$medico = $_POST["medico"];
$motivo = $_POST["motivo"];
//$deficiente = $_POST["deficiente"];
$id_beneficiarios = $_POST["id_beneficiarios"];
$id_usuario = $_POST["id_usuario"];

$matricula = str_replace(".", "", $matricula);
$matricula = str_replace("-", "", $matricula);

date_default_timezone_set('America/Maceio');



    $matric = substr($matricula, 9, -2);

    $query = mysqli_query($conn,"SELECT * FROM `beneficiarios` WHERE `matricula` = '".$matric."'") or die("erro ao selecionar");


     $query = "INSERT INTO `pronto_atendimento`(`id`,`id_usuario`,`id_beneficiarios` , `matricula`, `nome`,`dat_entrada`,`dat_saida`,`medico`, `motivo`) VALUES (null , '".$id_usuario."' , '".$id_beneficiarios."' , '".$matricula."' , '".$nome."' , '".date("Y-m-d H:i:s" )."' , null , '".$medico."' , '".$motivo."')";

                 
               
    $insert = mysqli_query($conn, $query);
                
    $res = mysqli_insert_id($conn);
                    
    if($insert){
                      
       require_once"pronto_atendimento_relatorio.php";
                      
    }else{
       echo"<script language='javascript' type='text/javascript'>alert('O pronto atendimento não cadastrado com sucesso!');window.location.href='painel.php?pa=1'</script>";

    }


  




  
    
    
?>