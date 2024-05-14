
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
  
	
	  
// VARI�VEIS DE SESS�O USU�RIO DO SISTEMA E A QUAL LOCAL OU EMPRESA PERTENCE
 $id_credenciado = $_SESSION['id_credenciado'];
 $nome_usuario = $_SESSION['login'];  
 
// VARI�VEL DO SCRIPT confirmar(), VIA  GET, ARQUIVO lab_autorizazao_medica.php
 $motivo = isset($_GET["motivo"])? $_GET["motivo"] : '';
 
// VARI�VEL DO SCRIPT CONFIRMAR, VIA  PSOT, ARQUIVO lab_modal_procedimento.php 
 $id_paciente = isset($_POST["id_paciente"])? $_POST["id_paciente"] : '';
 $lab    = isset($_POST['lab']  )? $_POST['lab'] : '';
 $id_especialidade = isset($_POST["id_especialidade"])? $_POST["id_especialidade"] : '';
 $id_beneficiarios = isset($_POST["id_beneficiarios"])? $_POST["id_beneficiarios"] : '';
 $id_proc = isset($_POST["id_proc"])? $_POST["id_proc"] : '';


 

 // Vem do arquivo lab_modal_procedimento.php via POST
/*  if(isset($_POST["lab"])){
   $lab = $_POST["lab"];
 }else{
 	$lab = "";
 }

*/

// TESTE VALORES VINDO DO TELA/MODAL INSERIR PROCEDIMENTOS (lab_modal_procedimento.php)
//echo $_POST['lab'];
//echo $_POST['id_proc'] // id_proc = 2795 -> 10101012 -> consulta.
//echo $_SESSION["perfil"];

// ================================================================================
//                   REGRAS DE ENTRADAS
// ================================================================================
// 1� REGRA = LABORAT�RIO N�O PODE SOLICITAR PROCEDIMENTO CONSULTA ID_PROC = 2795.
if( $_SESSION["perfil"] == "laboratorio" && isset($id_proc) && $id_proc == '2795' ){
			echo"<script language='javascript' type='text/javascript'>alert('Laborat\u00f3rio n\u00e3o pode solicitar consulta!');window.history.back();</script>";	
			exit();	
}

// 2� REGRA = CLINICA N�O PODE SOLICITAR PROCEDIMENTO EXAMES.
if( $_SESSION["perfil"] == "clinica" && isset($id_proc) && $id_proc <> '2795' ){
			echo"<script language='javascript' type='text/javascript'>alert('Cl\u00ednica n\u00e3o pode solicitar exames!');window.history.back();</script>";	
			exit();	
}
if( isset($_GET['senha']) && !empty($_GET['senha']) ){
	if( empty($_GET["proc"]) ){
	
			echo"<script language='javascript' type='text/javascript'>alert('Verifique se o procedimento foi ticado!');window.history.back();</script>";	
			exit();		
	}				
}
// 3� REGRA = RETORNO = � O PER�ODO DE 30DIAS APARTIR DA ULTIMA CONSULTA DENTRO DA ESPECIALIDADE. CODIGO ID DO PRODEDIMENTO CONSULTA NO BANCO � 2795.
	require_once "../func/retorno.php";
	if( $_SESSION["perfil"] == "clinica" && isset($id_proc) && $id_proc == '2795' ){
		$retorno = retorno($id_beneficiarios, $id_credenciado, $id_especialidade, $pdo);
		if(!empty($retorno["msg"])){
			echo $retorno["msg"];
			exit();
		}
	}
// A REGRA TEM QUE SER QUANTIDADE DE CONSULTA POR M�S, MAIS EFICIENTE,	
// 4� REGRA = CONSULTA POD DIA PROFISSIONAL SA�DE = UM M�DICO S� PODE ATENDER UMA DETERNINADA QUANTIDADE DE PESSOAS POR DIA. EX.: 4 PACIENTES 
	require_once "../func/quantidade.php";
	if( isset($id_proc) ){
		$consulta_dia = consulta_dia($id_proc , $pdo);
		if(!empty($consulta_dia["msg"])){
			echo $consulta_dia["msg"];
			exit();
		}
	}

//=================================================================================
//                   INFORMA��ES IMPORTANTE SOBRE O PROCESSO
//=================================================================================
/*
INFORMA��ES T�CNICAS: 
	- O PROCESSO � COMPOSTO POR 3 FAZES QUE � CONTROLADAS PELA VARI�VEL $status, CADASTRADA DURANTE TODO O PROCESSO NO BANCO;
	- AS FASES: PEOCESSO DO ENVIO DAS INFORMA��ES PARA O CALLCENTER E O RERORNO DESSA PARA A CL�NICAS E LABORAT�RIOS:
		 1 GUIA N�O VALIDADE;
		 2 GUIA ENVIADA PARA CALLCENTER;
		 3 GUIA AUTORIZADA PELO CALLCENTER;
*/

if( (isset($_GET['status'])) && ($_GET['status'] == 2) ){

// CONCELAMENTO DE GUIA
	if(isset($_GET["cancelar"]) && $_GET["cancelar"] == 1){

			 $sql = "UPDATE `sadt` SET `status`= 3, `senha`= '0',`n_autorizacao`= '0' WHERE `id`= ".$_GET['id'];	
			 $stmt = $pdo->prepare($sql);  
			 $stmt->execute();	
			 echo"<script language='javascript' type='text/javascript'>alert('Cancelada com sucesso!');window.history.back();</script>";	
			 exit();		
	}else{
// PROCESSO DE INSEIR PROCEDIMENTOS N�O CANCELADOS			
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
			   
// EST�GIO FINAL 3 -  PERCORRE O ARRAY $proc E ATUALIZA O CAMPO AUTORIZA��O = 1, VALIDANDO OS PROCEDIMENTOS ENVIADOS PELO CALLCENTER
				foreach ($proc as $valor) {	
					 $sql = "UPDATE `sadt_procedimento` SET `autorizado`=1 WHERE `id_sadt`= ".$_GET['id']." AND `id_proc` =".$valor;
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute();
					 
					 
				}	
// 	EST�GIO FINAL 3 - ATUALIZA O status = 3, FINALIZANDO O PROCESSO PELO CALLCENTER.			
					 $sql = "UPDATE `sadt` SET `status`= 3, `motivo_retorno`= '".$motivo_retorno."',`senha`= '".$senha."',`n_autorizacao`= '".$n_autorizacao."' WHERE `id`= ".$_GET['id'];	 
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute();	
				
			}else{
		
					 $sql = "UPDATE sadt SET status = 2, motivo = '".$_GET['motivo']."' WHERE id=".$_GET['id'];
					 $stmt = $pdo->prepare($sql);  
					 $stmt->execute(); 
			}
	}

       

// FINALIZA O PROCESSO DA SOLICITA��O PARA O CALLCENTER	
  	echo"<script language='javascript' type='text/javascript'>alert('Autoriza\u00e7\u00e3o processada com sucesso!');window.history.back()</script>";
	exit();
}else{



// VARIAVEIS VEM DO ARQUIVO lab_modal_procedimento.php VIA POST. 
// 1� EXECU��O AP�S O CADASTRO DOS M�DICOS E ESPECIALIDADE.
  	$matricula = $_POST['matricula'];
 	$nome = $_POST['nome'];
 	$deficiente = $_POST['deficiente'];
 	$id_beneficiarios = $_POST['id_beneficiarios'];
	$qtd_proc = $_POST["qtd_proc"];
	$id_proc = $_POST["id_proc"];
 	
	$id_usuario = $_SESSION['id'];
	$id_especialidade = $_POST['id_especialidade'];
	$id_profissional_saude = $_POST['id_profissional_saude'];
	$medico_solicitante = $_POST['medico_solicitante'];
	$cr = $_POST['cr'];
	$codsig = $_POST['codsig'];
 
 	$id_imagem  = isset($_POST["id_imagem"]) ? $_POST["id_imagem"]: 'null';
	$data_aut  = isset($_POST["data_aut"]) ? $_POST["data_aut"]: 'null';
	//$id_internamento  = isset($_POST["id_internamento"]) ? $_POST["id_internamento"]: 'null';
	
	

	//REGRAS DE NEGÓCIO PROCEDIMENTOS
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
    // 1 - REGRA CAR�NCIA RETORNO 0 OU MSG
    // TEMPO ESTIMADO PARA COME�AR A USAR O PLANO
    $carencia = carencia($carencia,$id_beneficiarios, $unid_carencia, $pdo);
    if(empty($carencia["msg"])){
        echo $carencia["msg"];
        $cadastrar = 0; 
    }else{
        $cadastrar = 1;
    } 
    
    // 2 - REGRA RESTRI��O RETORNO 0 OU MSG
    // RESTRI��O DEVIDO O VALOR , A COMPLEXIDADE E AO BLOQUEIO
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
    // QUANTIDADE VEZES QUE O MESMO PROCEDIMENTO PODE SER UTILIZADO DENTRO DE UM PER�ODO PELO USU�RIO NO ANO 
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
      

            // Inserir o 1 procedimento caso n�o exita.
            if(!isset($_SESSION['last_id'])){
                         
				 $sql = "INSERT INTO sadt (id, id_beneficiario, id_usuario,id_especialidade ,id_usuario_aut, id_internamento, id_autorizacao, id_credenciado, id_profissional_saude, id_imagem, medico_solicitante, cr , codsig , motivo, data_sadt, data_aut, operador, senha, status) VALUES (null,'".$id_beneficiarios."','".$id_usuario."','".$id_especialidade."',null,null, null ,'".$id_credenciado."','".$id_profissional_saude."','".$id_imagem."','".$medico_solicitante."','".$cr."','".$codsig."',null,'".date("Y-m-d H:i:s")."','".$data_aut."','".$nome_usuario."',null,1)";
			
			
               $stmt = $conn->prepare($sql);
               $stmt->execute();
               $_SESSION['last_id'] = $conn->insert_id;

                //Inserir procedimento no SADT

               $sql = "INSERT INTO sadt_procedimento(id, id_sadt, id_proc, qtd_proc, data,autorizado) VALUES (null,".$_SESSION['last_id'].",".$id_proc.",'".$qtd_proc."','".date("Y-m-d H:i:s")."',null)";
               $stmt = $conn->prepare($sql);
               $stmt->execute();
			   $_SESSION['ultimo_proc_id'] = $id_proc;
	
					
            }else{
			   // CASO EXISTA MAIS DE UMA SOLICITA��O DE PROCEDIMENTO PARA N�O REPETIR O PROCEDIMENTO AO DIGITADO 
				if(isset($_SESSION['ultimo_proc_id']) && $id_proc == $_SESSION['ultimo_proc_id'] ){
				 echo"<script language='javascript' type='text/javascript'>alert('Procedimento j\u00e1 inserido!');window.history.back()</script>";
				 exit();
				}else{
				   $sql = "INSERT INTO sadt_procedimento(id, id_sadt, id_proc, qtd_proc, data) VALUES (null,".$_SESSION['last_id'].",".$id_proc.",'".$qtd_proc."','".date("Y-m-d H:i:s")."')";
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
				echo"<script language='javascript' type='text/javascript'>window.location.href='painel.php?lab=".$lab."&id=".$_SESSION['last_id']."'</script>";				
				exit();
				
			}

       }else{

           echo $dados;

       }




}
  




    
?>