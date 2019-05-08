
<?php 
  //Arquivo de configuração
  include "cabecalho.php";

$matricula = $_POST["matricula"];
$nome = $_POST["nome"];
$medico = $_POST["medico"];
$motivo = $_POST["motivo"];

$matricula = str_replace(".", "", $matricula);
$matricula = str_replace("-", "", $matricula);

date_default_timezone_set('America/Maceio');

    $matric = substr($matricula, 9, -2);

    $query = mysqli_query($conn,"SELECT * FROM `beneficiarios` WHERE `matricula` = '".$matric."' and `contrato_ativo` = '1' and `pessoa_ativa` = '1'") or die("erro ao selecionar");


        if (mysqli_num_rows($query)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Usuario não está ativo ou matrícula não existe.');window.location.href='pronto_atendimento.php?id=1';</script>";
          die();



        }else{

         

                $query = "INSERT INTO `pronto_atendimento`(`id`,`id_usuario`,`matricula`, `nome`,`dat_entrada`,`dat_saida`,`medico`, `motivo`) VALUES (null ,'".$_SESSION['id']."','".$matricula."' , '".$nome."' , '".date("Y-m-d H:i:s" )."' , null , '".$medico."' , '".$motivo."')";

                 
               
                    $insert = mysqli_query($conn, $query);
                
                    $res = mysqli_insert_id($conn);
                    
                    if($insert){
                      
                      require_once"pronto_atendimento_relatorio.php";
                      
                    }else{
                     echo"<script language='javascript' type='text/javascript'>alert('O pronto atendimento não cadastrado com sucesso!');window.location.href='pronto_atendimento.php'</script>";

                    }

        }

  




  
    
    
?>