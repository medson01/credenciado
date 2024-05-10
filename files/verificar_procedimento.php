<?php
// Arquivo de configuração
 require_once "../config/config.php";

$assunto = isset($_GET['assunto'])?  $assunto : '' ;
$cod_proc = $_GET['cod_proc'];

//Verifica se não verdadeiros para não repetir oprocedimento novamente de criar a sessão das variáveis.Sem isso ele não quarda os médicos que não estão cadastrados no ipaseal.
	$id_especialidade = isset($_GET['id_especialidade'])? $_GET['id_especialidade'] : '';
	$medico_solicitante = isset($_GET['medico_solicitante'])? $_GET['medico_solicitante'] : '';
	$cr = isset($_GET['cr'])? $_GET['cr'] : '';
	$codsig = isset($_GET['codsig'])? $_GET['codsig'] : '';
	



$tamanho = strlen($cod_proc);
 
If($tamanho < 8){

 echo"<script language='javascript' type='text/javascript'>alert('O procedimento tem que ter no m\u00ednimo 8 d\u00edgitos');location.href=\"".$_SESSION["url"]."\"</script>";

}else{

      $sql = "SELECT id, descricao FROM `procedimento` WHERE codigo = ".$cod_proc;

      $stmt = $pdo->prepare($sql);
         
      $stmt->execute();

      $resultado = $stmt->rowCount();

   if ($resultado > 0){
      if(isset($cod_proc)){

            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
               $id_proc = $registro["id"];
               $desc_proc = $registro["descricao"];
           };
		   
	
            if(!isset($_GET['numero_protocolo'])){   
            echo "<script>location.href=\"".$_SESSION["url"]."&codsig=".$codsig."&cr=".$cr."&medico_solicitante=".$medico_solicitante."&id_especialidade=".$id_especialidade."&desc_proc=".$desc_proc."&id_proc=".$id_proc."&cod_proc=".$cod_proc."\"</script>";
			
            }else{
              exit();  echo "<script>location.href=\"".$_SESSION["url"]."&desc_proc2=".$desc_proc."&id_proc2=".$id_proc."&cod_proc2=".$cod_proc."&assunto2=".$assunto."\"</script>";
            }	
         }
   }else{
      echo"<script language='javascript' type='text/javascript'>alert('Procedimento n\u00e3o existe!');location.href=\"".$_SESSION["url"]."\"</script>";
   }
}


?>