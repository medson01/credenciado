<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id_especialidade = $_GET['id_especialidade'];
$cr = $_GET['cr'];



     $sql = "SELECT profissional_saude.id , profissional_saude.nome, profissional_saude.codsig FROM `profissional_saude` INNER JOIN especialidade ON profissional_saude.id_especialidade = especialidade.id WHERE profissional_saude.numcr = ".$cr." AND especialidade.id = ".$id_especialidade;

      //exit();
	  $stmt = $pdo->prepare($sql);
         
      $stmt->execute();

      $resultado = $stmt->rowCount();

   if ($resultado > 0){
        while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
               $id_profissional_saude= $registro["id"];
               $medico_solicitante = $registro["nome"];
               $codsig = $registro["codsig"];
        };

		
         $_SESSION["id_especialidade"] = $id_especialidade;
         $_SESSION["medico_solicitante"] = $medico_solicitante;
         $_SESSION["cr"] = $cr;
         $_SESSION["codsig"] = $codsig;



       echo "<script>location.href=\"".$_SESSION["url"]."&codsig=".$codsig."&id_profissional_saude=".$id_profissional_saude."&medico_solicitante=".$medico_solicitante."&cr=".$cr."&id_especialidade=".$id_especialidade."\"</script>";
	   
	   
	   
    }else{
         /*
		  echo"<script language='javascript' type='text/javascript'>alert('Especialidade n\u00e3o vinculada ao m\u00e9dico ou m\u00e9dico n\u00e3o cadastrado.\\nFavor verificar.');location.href=\"".$_SESSION["url"]."\"</script>";
 echo "<script>
		*/
		 $id_profissional_saude = isset($id_profissional_saude)? $id_profissional_saude : '' ;
         $id_especialidade = isset($id_especialidade)? $id_especialidade : '' ;
         $medico_solicitante = isset($medico_solicitante)? $medico_solicitante : '' ;
         $cr = isset($cr)? $cr : '' ;
         $codsig = isset($codsig)? $codsig : '' ;
		
		  echo "<script>location.href=\"".$_SESSION["url"]."&codsig=".$codsig."&id_profissional_saude=".$id_profissional_saude."&medico_solicitante=".$medico_solicitante."&cr=".$cr."&id_especialidade=".$id_especialidade."\"</script>";
          
    }

    // GUARDA A URL NA SESSÃO POIS É DIFERENTE DO FORMULÁRIO CADASTRO
    $_SESSION["url"] = $_SERVER["REQUEST_URI"];
?>