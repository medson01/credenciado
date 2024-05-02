
<?php 

// Arquivo de configuracao
  require_once "../config/config.php";

// Arquivo de carencia
  require_once "../func/carencia.php";

// Arquivo de quantidade
  require_once "../func/quantidade.php";

  // Arquivo de quantidade
  require_once "../func/calc_idade.php";

  // Arquivo de periodicidade
  require_once "../func/periodicidade.php";

  // Arquivo de valor procedimento
  require_once "../func/restricao.php";

// CONFIRMAR SADT FECHAR SOLICITAÇÃO

/*
 if(isset($_POST["proc"])){
    echo $_POST["proc"];
 }
 */
 if(isset($_POST["motivo"])){
    $motivo = $_POST["motivo"];
 }else{
 	$motivo = "";
 }

/* if(isset($_POST['id_especialidade'])){
    echo      $id_especialidade = $_POST['id_especialidade'];
         $medico_solicitante = $_POST['medico_solicitante'];
         $cr = $_POST['cr'];
         $codsig = $_POST['codsig'];
}
*/

//FASES:
// 1 GUIA NÃO VALIDADE;
// 2 GUIA ENVIADA PARA CALLCENTER
// 3 GUIA AUTORIZADA PELO CALLCENTER

if( isset($_GET['senha']) && !empty($_GET['senha']) ){
	if( empty($_GET["proc"]) ){
	
			echo"<script language='javascript' type='text/javascript'>alert('Verifique se o procedimento foi ticado!');window.history.back();</script>";	
			exit();		
	}				
}

if( (isset($_GET['status'])) && ($_GET['status'] == 2) ){
;
	if(isset($_GET["cancelar"]) && $_GET["cancelar"] == 1){

			 $sql = "UPDATE `sadt` SET `status`= 3, `senha`= '0',`n_autorizacao`= '0' WHERE `id`= ".$_GET['id'];	
			 $stmt = $pdo->prepare($sql);  
			 $stmt->execute();	
			 echo"<script language='javascript' type='text/javascript'>alert('Cancelada com sucesso!');window.location.href='painel.php?lab=1'</script>";	
			 exit();		
	}else{
			if(isset($_GET["proc"]) && !empty($_GET["proc"])){
				 
				if(isset($_GET['senha'])){
					 $senha = $_GET['senha'];
					
				}else{
					$senha = "null";
				}
				if(isset($_GET['n_autorizacao'])){
					 $n_autorizacao = $_GET['n_autorizacao'];
				}else{
					 $n_autorizacao = "null";
				}
				if(isset($_GET['motivo_retorno'])){
					 $motivo_retorno = $_GET['motivo_retorno'];
				}else{
					 $motivo_retorno = "null";
				}

			   $proc = array();
			   $proc = explode( ',', $_GET["proc"]);
			   
				foreach ($proc as $valor) {	
					 $sql = "UPDATE `sadt_procedimento` SET `autorizado`=1 WHERE `id_sadt`= ".$_GET['id']." AND `id_proc` =".$valor;
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute();
					 
					 
				}	
				
					 $sql = "UPDATE `sadt` SET `status`= 3, `motivo_retorno`= '".$motivo_retorno."',`senha`= '".$senha."',`n_autorizacao`= '".$n_autorizacao."' WHERE `id`= ".$_GET['id'];	 
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute();	
				
			}else{
		
					 $sql = "UPDATE sadt SET status = 2, motivo = '".$_GET['motivo']."' WHERE id=".$_GET['id'];
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute(); 
			}
	}

      unset(
	  $_SESSION["matricula"], 
	  $tipreg, 
	  $_SESSION["nome"],  
	  $_SESSION["data_nasc"], 
	  $_SESSION["deficiente"], 
	  $_SESSION["data_sadt"] , 
	  $_SESSION["status"], 
	  $_SESSION["senha"], 
	  $_SESSION["data_aut"], 
	  $_SESSION["perfil_bd"], 
	  $_SESSION["motivo"], 
	  $_SESSION["nome_cred"], 
	  $_SESSION["nome_usuario"],
	  $_SESSION["operador"], 
	  $_SESSION["url"], 
	  $_SESSION["id_beneficiarios"] , 
	  $_SESSION['last_id'], 
	  $_SESSION["codsig"], 
	  $_SESSION["cr"] , 
	  $_SESSION["especialidade"], 
	  $_SESSION['id_profissional_saude'],
	  $_SESSION['ultimo_proc_id']
	  

	   );  

   	echo"<script language='javascript' type='text/javascript'>alert('Autoriza\u00e7\u00e3o processada com sucesso!');window.location.href='painel.php?lab=1'</script>";

}else{

// 1° execução após do cadasdro da especialidade e médicos.
 $qtd_proc = $_POST["qtd_proc"];
 $id_proc = $_POST["id_proc"];
 $id_usuario = $_SESSION['id'];
 $matricula = $_SESSION['matricula'];
 $nome = $_SESSION['nome'];
 $deficiente = $_SESSION['deficiente'];
 $id_beneficiarios = $_SESSION['id_beneficiarios'];
 $id_credenciado = $_SESSION['id_credenciado'];
 $nome_usuario = $_SESSION['login'];
 $id_especialidade = $_SESSION['id_especialidade'];
 $id_profissional_saude = $_SESSION['id_profissional_saude'];
 $medico_solicitante = $_SESSION['medico_solicitante'];
 $cr = $_SESSION['cr'];
 $codsig = $_SESSION['codsig'];
 $id_internamento  = isset($_POST["id_internamento"]) ? $_POST["id_internamento"]: 'null';
 $id_imagem  = isset($_POST["id_imagem"]) ? $_POST["id_imagem"]: 'null';
 $data_aut  = isset($_POST["data_aut"]) ? $_POST["data_aut"]: 'null';



	//REGRAS DE NEGÃ“CIO PROCEDIMENTOS
    // PEGAR REGRA NA TABELA PROCEDIMENTOS
    /* $sql = "SELECT * FROM procedimento WHERE id=".$id_proc;

     $stmt = $pdo->prepare($sql);  
     $stmt->execute();

    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){    
       $carencia = $registro["carencia"];
       $quantidade = $registro["quantidade"];
       //$perioticidade = $registro["pedioticidade"];
       $bloqueio = $registro["bloqueio"];
      
    }
    */
	
	
    /*
    // 1 - REGRA CARÊNCIA RETORNO 0 OU MSG
    // TEMPO ESTIMADO PARA COMEÇAR A USAR O PLANO
    $carencia = carencia($carencia,$id_beneficiarios, $unid_carencia, $pdo);
    if(empty($carencia["msg"])){
        echo $carencia["msg"];
        $cadastrar = 0; 
    }else{
        $cadastrar = 1;
    } 
    
    // 2 - REGRA RESTRIÇÃO RETORNO 0 OU MSG
    // RESTRIÇÃO DEVIDO O VALOR , A COMPLEXIDADE E AO BLOQUEIO
    if($cadastrar <> 0){
        $restricao = restricao($id_proc, $pdo);
        if(empty($restricao["msg"])){
            echo $restricao["msg"];
            $cadastrar = 0; 
        }else{
            $cadastrar = 1;
        }
    }
        
    // 3 - REGRA QUANTIDADE RETORNO 0 OU MSG
    // QUANTIDADE VEZES QUE O MESMO PROCEDIMENTO PODE SER UTILIZADO DENTRO DE UM PERÍODO PELO USUÁRIO NO ANO 
    $quantidade =  quantidade($quantidade ,$id_beneficiarios ,$unid_quantidade ,$pdo);
    if (!empty($quantidade["msg"])){
            echo $quantidade["msg"];
            $cadastrar = 0; 
    }else{
        $cadastrar = 1;
    }

    // 4 - REGRA PERIODICIDADE PEDA A DATA DO ULTIMO PROCEDIMENTO DA REGRA QUANTIDADADE QUE RETONA A ULTIMO PROCEDIMENTO EXECUTADO OU MSG  
    $periodicidade = periodicidade($quantidade);
    if (!empty($periodicidade["msg"])){
       echo $periodicidade["msg"]; 
       $cadastrar = 0; 
    }else{
        $cadastrar = 1; 
    }
    */

    $cadastrar = 1;
     
    // CADASTRO PROCEDIMENTO   
       if($cadastrar == 1){
        
            // Inserir o procedimento caso não exita com o primeiro procedmento
            if(!isset($_SESSION['last_id'])){
                         
			$sql = "INSERT INTO sadt (id, id_beneficiario, id_usuario,id_especialidade ,id_usuario_aut, id_internamento, id_autorizacao, id_credenciado, id_profissional_saude, id_imagem, medico_solicitante, cr , codsig , motivo, data_sadt, data_aut, operador, senha, status) VALUES (null,'".$id_beneficiarios."','".$id_usuario."','".$id_especialidade."',null,".$id_internamento.", null ,'".$id_credenciado."','".$id_profissional_saude."','".$id_imagem."','".$medico_solicitante."','".$cr."','".$codsig."',null,'".date("Y-m-d H:i:s")."','".$data_aut."','".$nome_usuario."',null,1)";
			
               $stmt = $conn->prepare($sql);
               $stmt->execute();
               $_SESSION['last_id'] = $conn->insert_id;

                //Inserir procedimento no SADT

               $sql = "INSERT INTO sadt_procedimento(id, id_sadt, id_proc, qtd_proc, data,autorizado) VALUES (null,".$_SESSION['last_id'].",".$id_proc.",'".$qtd_proc."','".date("Y-m-d H:i:s")."',null)";
               $stmt = $conn->prepare($sql);
               $stmt->execute();
					$_SESSION['ultimo_proc_id'] = $id_proc;
            }else{
			   // Caso exista mais de um SADT   
				if(isset($_SESSION['ultimo_proc_id']) && $id_proc == $_SESSION['ultimo_proc_id']){
					 echo"<script language='javascript' type='text/javascript'>alert('Procedimento j\u00e1 inserido!');window.location.href='painel.php?lab=1&id=".$_SESSION['last_id']."'</script>";
					 exit();
				}else{
				   $sql = "INSERT INTO sadt_procedimento(id, id_sadt, id_proc, qtd_proc, data) VALUES (null,".$_SESSION['last_id'].",".$id_proc.",'".$qtd_proc."','".date("Y-m-d H:i:s")."')";
				   $stmt = $conn->prepare($sql);
				   $stmt->execute();
				   $_SESSION['ultimo_proc_id'] = $id_proc;
				 
				}   	   
           }
		
	 // Quantidade de procedimentos

     echo"<script language='javascript' type='text/javascript'>window.location.href='painel.php?lab=1&id=".$_SESSION['last_id']."'</script>";
	 
       }else{

           echo $dados;

       }




// ---    ***     ---
}
  




    
?>