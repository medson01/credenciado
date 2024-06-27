
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
  
	
	  
// VARIÁVEIS DE SESSÃO
 $id_credenciado = $_SESSION['id_credenciado'];
 $nome_usuario = $_SESSION['login'];  
 $id_usuario = isset($_SESSION['id'])? $_SESSION['id'] : '';

 
/*===============================================================
	INFORMAÇÕES TÉCNICOS
  ===============================================================	
	TUDO 	QUE VIR VIA POST, VIRÁ DO ARQUIVO lab_modal_procedimento.php E TUDO QUE VIR DO GET VIRA DO 
SCRIPT confirmar() e do arquivo lab_autorizazao_medica.php.
	ESSAS VARIÁVEIS VEM COM APENAS UMA VALOR DO PROCEDIMENTO, AO CONTRÁTR DO GET, QUE VEM COMO UM ARRAY.
OS if TEM QUE DIFERENCIAR OS RECEBIMENTOS E COM ISSO AS ETAPAS ATRAVÉS POR ESSES MÉTIDOS(GET E POST).
*/ 
// VARIÁVEL VIA  POST, ARQUIVO lab_modal_procedimento.php  
// DADOS DO USUÁRIO 
 $id = isset($_POST["id"])? $_POST["id"] : '';
 $id_beneficiarios = isset($_POST["id_beneficiarios"])? $_POST["id_beneficiarios"] : '';
 $nome = isset($_POST["nome"])? $_POST["nome"] : '';
 $matricula = isset($_POST["matricula"])? $_POST["matricula"] : '';
 $deficiente = isset($_POST["deficiente"])? $_POST["deficiente"] : '';
 $data_inclusao = isset($_POST["data_inclusao"])? $_POST["data_inclusao"] : '';
 $imagem = !empty($_FILES['imagem'])? $_FILES['imagem'] : '';

//DADPS DO PROFISIONAL SAUDE E ESPECIALIDADE 
 $id_profissional_saude = isset($_POST['id_profissional_saude'])? $_POST['id_profissional_saude'] : '';
 $medico_solicitante = isset($_POST['medico_solicitante'])? $_POST['medico_solicitante'] : '';
 $id_especialidade = isset($_POST["id_especialidade"])? $_POST["id_especialidade"] : '';
 $cr = isset($_POST['cr'])? $_POST['cr'] : '';
 $codsig = isset($_POST['codsig'])? $_POST['codsig'] : '';
 $data_aut  = isset($_POST["data_aut"]) ? $_POST["data_aut"]: 'null';
// DADOS DO PROCEDIMENTO
 $id_proc = isset($_POST["id_proc"])? $_POST["id_proc"] : '';
 $qtd_proc = isset($_POST["qtd_proc"])? $_POST["qtd_proc"] : '';
 $id_imagem  = isset($_POST["id_imagem"]) ? $_POST["id_imagem"]: 'null';
 $lab    = isset($_POST['lab']  )? $_POST['lab'] : '';
 $qtd_proc_guia = isset($_POST['i']  )? $_POST['i'] : ''; 
 
 // VARIÁVEL DO SCRIPT confirmar(), VIA  GET, ARQUIVO lab_autorizazao_medica.php
 $senha = isset($_GET["senha"])? $_GET["senha"] : '';
 $n_autorizacao = isset($_GET["n_autorizacao"])? $_GET["n_autorizacao"] : '';
 $motivo = isset($_GET["motivo"])? $_GET["motivo"] : '';
 $motivo_retorno = isset($_GET["motivo_retorno"])? $_GET["motivo_retorno"] : '';
 $imagem = isset($_GET["imagem"])? $_GET["imagem"] : '';
 



// USA O POST PARA SÓ EXECUTAR OS COMANDOS VIA MODAL DE INCLUSÃO DE PROCEDIMENTOS lab_modal_procedimento.php
	if(isset($_POST["matricula"])){
	
// ================================================================================
//                   REGRAS DE ENTRADAS
// ================================================================================	

	// 1º REGRA = VALOR PROCEDIMENTO. 
			require_once "../func/valor_procedimento.php";
			if( isset($id_proc) && $id_proc <> '2795' ){
				$valor_procedimento = valor_procedimento($qtd_proc_guia, $id_proc ,$pdo);
				if(!empty($valor_procedimento["msg"])){
					echo $valor_procedimento["msg"];
					exit();
				}else{
					// DAR UM AVISO SOBRE A REGRA QUE FALTA CONFIGUARA E CONTINUAR O PROCESSO INSERINDO O PROCEDIMENTO NA GUIA.  
					//echo isset($valor_procedimento["go"])? $valor_procedimento["go"]: '' ;
					//$aviso = $valor_procedimento["procedimento"];
					echo $valor_procedimento["go"];
					$imagem=0;		
				}
			}
			
	// 2º REGRA = LABORATÓRIO NÃO PODE SOLICITAR PROCEDIMENTO CONSULTA ID_PROC = 2795.
		if( $_SESSION["perfil"] == "laboratorio" && !empty($id_proc) && $id_proc == '2795' ){
					echo"<script language='javascript' type='text/javascript'>alert('Laborat\u00f3rio n\u00e3o pode solicitar consulta!');window.history.back();</script>";	
					exit();	
		}
		
	// 3º REGRA = CLINICA NÃO PODE SOLICITAR PROCEDIMENTO EXAMES.
		if( $_SESSION["perfil"] == "clinica" && !empty($id_proc) && $id_proc <> '2795' ){
					echo"<script language='javascript' type='text/javascript'>alert('Cl\u00ednica n\u00e3o pode solicitar exames!');window.history.back();</script>";	
					exit();	
		}
		if( isset($_GET['senha']) && !empty($_GET['senha']) ){
			if( empty($_GET["proc"]) ){
			
					echo"<script language='javascript' type='text/javascript'>alert('Verifique se o procedimento foi ticado!');window.history.back();</script>";	
					exit();		
			}				
		}
		
	// 4º REGRA = CARÊNCIA = CADA PROCEDIMENTO TEM UMA CARÊNCIA, SÓ PODE USAR DA DATA DE CARÊNCA EM DIANTE APARTIR DA DATA DE INCLUSÃO.
			require_once "../func/carencia.php";
			// CONSULTA NÃO TEM CARÊNCIA
			if( isset($id_proc) && $id_proc <> '2795' ){
				$carencia = carencia($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $qtd_proc, $id, $pdo);
				if(!empty($carencia["msg"])){
					echo $carencia["msg"];
					exit();
				}else{
					// DAR UM AVISO SOBRE A REGRA QUE FALTA CONFIGUARA E CONTINUAR O PROCESSO INSERINDO O PROCEDIMENTO NA GUIA.  
					echo $carencia["go"];
				}
			}
		
	// 5º REGRA = RETORNO = É O PERÍODO DE 30DIAS APARTIR DA ULTIMA CONSULTA DENTRO DA ESPECIALIDADE. CODIGO ID DO PRODEDIMENTO CONSULTA NO BANCO É 2795.
			require_once "../func/retorno.php";
			if( $_SESSION["perfil"] == "clinica" && isset($id_proc) && $id_proc == '2795' ){
				$retorno = retorno($id_beneficiarios, $id_credenciado, $id_especialidade, $pdo);
				if(!empty($retorno["msg"])){
					echo $retorno["msg"];
					exit();
				}
			}
			
	// 6º REGRA = QUANTIDADE DE PROCEDIMENTOS EXECUTADOS EM UM DETERMINADO PERÍODO. 
		// - RETORNA FALSO SE ESTIVER DENTRO DA QUANTIDADE
		// - RETORNA UMA INFORMAÇÃO DE NÃO CONFIGURADO OS PARÂMETROS DE QUANTIDADE E UNIDADE DA QUANTIDADE
			require_once "../func/quantidade.php";
			if( isset($id_proc) && $id_proc <> '2795' ){
				$quantidade = quantidade($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $qtd_proc, $id, $pdo);
				if(!empty($quantidade["msg"])){
					echo $quantidade["msg"];
					exit();
				}else{
					// DAR UM AVISO SOBRE A REGRA QUE FALTA CONFIGUARA E CONTINUAR O PROCESSO INSERINDO O PROCEDIMENTO NA GUIA.  
					echo $quantidade["go"];
				}
			}
			
	// 7º REGRA = QUANTIDADE DE PROCEDIMENTOS EXECUTADOS EM UM DETERMINADO PERÍODO. 
			require_once "../func/periodicidade.php";
			if( isset($id_proc) && $id_proc <> '2795' ){
				$periodicidade = periodicidade($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $id, $pdo);
				if(!empty($periodicidade["msg"])){
					echo $periodicidade["msg"];
					exit();
				}else{
					// DAR UM AVISO SOBRE A REGRA QUE FALTA CONFIGUARA E CONTINUAR O PROCESSO INSERINDO O PROCEDIMENTO NA GUIA.  
					echo $periodicidade["go"];
				}
			}	

		
			
	}
//=================================================================================
//                   INFORMAÇÕES IMPORTANTE SOBRE O PROCESSO
//=================================================================================
/*
INFORMAÇÕES TÉCNICAS: 
	- O PROCESSO É COMPOSTO POR 3 FAZES QUE É CONTROLADAS PELA VARIÁVEL $status, CADASTRADA DURANTE TODO O PROCESSO NO BANCO;
	- AS FASES: PEOCESSO DO ENVIO DAS INFORMAÇÕES PARA O CALLCENTER E O RERORNO DESSA PARA A CLÍNICAS E LABORATÓRIOS:
		 1 GUIA NÃO VALIDADE;
		 2 GUIA ENVIADA PARA CALLCENTER;
		 3 GUIA AUTORIZADA PELO CALLCENTER;
*/

if( (isset($_GET['status'])) && ($_GET['status'] == 2) ){

// CONCELAMENTO DE GUIA
	if(isset($_GET["cancelar"]) && $_GET["cancelar"] == 1){

			 $sql = "UPDATE `sadt` SET `status`= 3, `senha`= '0',`n_autorizacao`= '0', `motivo_retorno`= '".$motivo_retorno."' WHERE `id`= ".$_GET['id'];	
			 $stmt = $pdo->prepare($sql);  
			 $stmt->execute();	
			 echo"<script language='javascript' type='text/javascript'>alert('Cancelada com sucesso!');window.history.back();</script>";	
			 exit();		
	}else{
// PROCESSO DE INSEIR PROCEDIMENTOS NÃO CANCELADOS			
			if(isset($_GET["proc"]) && !empty($_GET["proc"])){
			/*	 
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
			*/
			   $proc = array();
			   $proc = explode( ',', $_GET["proc"]);
			   
// ESTÁGIO FINAL 3 -  PERCORRE O ARRAY $proc E ATUALIZA O CAMPO AUTORIZAÇÃO = 1, VALIDANDO OS PROCEDIMENTOS ENVIADOS PELO CALLCENTER
				foreach ($proc as $valor) {	
					 $sql = "UPDATE `sadt_procedimento` SET `autorizado`=1 WHERE `id_sadt`= ".$_GET['id']." AND `id_proc` =".$valor;
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute();
					 
					 
				}	
// 	ESTÁGIO FINAL 3 - ATUALIZA O status = 3, FINALIZANDO O PROCESSO PELO CALLCENTER.			
					 $sql = "UPDATE `sadt` SET `status`= 3, `motivo_retorno`= '".$motivo_retorno."',`senha`= '".$senha."',`n_autorizacao`= '".$n_autorizacao."' WHERE `id`= ".$_GET['id'];	 
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute();	
				
			}else{
		
					 $sql = "UPDATE sadt SET status = 2, motivo = '".$_GET['motivo']."' WHERE id=".$_GET['id'];
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute(); 
			}
	}

// exit();      

// FINALIZA O PROCESSO DA SOLICITAÇÃO PARA O CALLCENTER	
  	echo"<script language='javascript' type='text/javascript'>alert('Autoriza\u00e7\u00e3o processada com sucesso!');window.history.back();</script>";
	exit();
}else{

    // CRIA O A GUIA SADT E INSERI O 1º PROCEDIMENTO
        if(!isset($_SESSION['last_id'])){
                         
				// CRIA A GUIA
				$sql = "INSERT INTO sadt (id, id_beneficiario, id_usuario,id_especialidade ,id_usuario_aut, id_internamento, id_autorizacao, id_credenciado, id_profissional_saude, id_imagem, medico_solicitante, cr , codsig , motivo, data_sadt, data_aut, operador, senha, status) VALUES (null,'".$id_beneficiarios."','".$id_usuario."','".$id_especialidade."',null,null, null ,'".$id_credenciado."','".$id_profissional_saude."','".$id_imagem."','".$medico_solicitante."','".$cr."','".$codsig."',null,'".date("Y-m-d H:i:s")."','".$data_aut."','".$nome_usuario."',null,1)";
	
               $stmt = $conn->prepare($sql);
               $stmt->execute();
               $_SESSION['last_id'] = $conn->insert_id;

// 	ESTÁGIO 2 - LANÇAMENTO DOS PROCEDIMENTOS NA LISTA DE PROCEDIMENTOS lab_lista.php
		// INSERI APENAS O 1º PROCEDIMENTO DA LISTA			
               $sql = "INSERT INTO sadt_procedimento(id, id_sadt, id_proc, qtd_proc, data,autorizado) VALUES (null,".$_SESSION['last_id'].",".$id_proc.",'".$qtd_proc."','".date("Y-m-d H:i:s")."',null)";
               $stmt = $conn->prepare($sql);
               $stmt->execute();
			   $_SESSION['ultimo_proc_id'] = $id_proc;
			   

					
        }else{
			   // PARA NÃO REPETIR OS PROCEDIMENTOS AO DIGITADOS 
				if(isset($_SESSION['ultimo_proc_id']) && $id_proc == $_SESSION['ultimo_proc_id'] ){
				 echo"<script language='javascript' type='text/javascript'>alert('Procedimento j\u00e1 inserido!');window.history.back()</script>";
				 exit();
				}else{
		// INSERI APARTIR DO 2º PROCEDIMENTO DA LISTA EM DIANTE. 			
				   $sql = "INSERT INTO sadt_procedimento(id, id_sadt, id_proc, qtd_proc, data,autorizado, critica) VALUES (null,".$_SESSION['last_id'].",".$id_proc.",'".$qtd_proc."','".date("Y-m-d H:i:s")."', null, null)";
				   $stmt = $conn->prepare($sql);
				   $stmt->execute();
				   $_SESSION['ultimo_proc_id'] = $id_proc;
				}   	   
        }

	// Quantidade de procedimentos
		if($lab == "consulta"){
				echo"<script language='javascript' type='text/javascript'>window.location.href='painel.php?lab=".$lab."&id=".$_SESSION['last_id']."&".$lab."=1'</script>";				
				exit();
		}else{	
				echo"<script language='javascript' type='text/javascript'>window.location.href='painel.php?lab=".$lab."&id=".$_SESSION['last_id']."&imagem=".$id_imagem."'</script>";				
				exit();
				
		}
}
  
    
?>