<?php
// ARQUIVO DE BANCO
  require_once "../config/config.php";
// FORMATAR A DATA PARA O FORMATO DO BANCO ENG
  require_once "../func/formatar_data_banco.php";
  
// ENTRADA DE DADOS
	// SOLICITAÇÃO
	

	if($_POST["status"] == 1){ 	
		$status = $_POST["status"];
		$id_internamento = $_POST["id_internamento"];
		$id_acomodacao = $_POST["id_acomodacao"];
		$id_usuario = $_SESSION["id"];
		$data_inicial  = formatar_data_banco($_POST["data_inicial"]);
	 	$data_final  = formatar_data_banco($_POST["data_final"]);
		$medico_solicitante  = $_POST["medico_solicitante"];
		$crm  = $_POST["crm"];
		$dias_solicitados  = $_POST["dias_solicitados"];
		$qtd_respiratoria  = $_POST["qtd_respiratoria1"];
		$qtd_motora  = $_POST["qtd_motora1"];
		$motivo  = $_POST["motivo"];	
		$foto = $_FILES['imagem'];
		$evento = utf8_decode($_POST["evento"]);
		$descricao = utf8_decode($_POST["descricao"]);	
		$data_prorrogacao = date("Y-m-d H:i:s" );
		$url  = $_POST["url"];
	}

	// AUTORIZAÇÃO
		if($_POST["status"] == 2){ 	
		    $id_prorro = $_POST["id_prorro"];
			$data_inicial_aut  = formatar_data_banco($_POST["data_inicial2"]);
	 	    $data_final_aut  = formatar_data_banco($_POST["data_final2"]);
			$qtd_respiratoria_aut  = $_POST["qtd_respiratoria2"];
		    $qtd_motora_aut  = $_POST["qtd_motora2"];
			$dias_autorizados  = $_POST["dias2"];
			$motivo_autorizacao  = $_POST["motivo_autorizacao"];
			$data_autorizacao = date("Y-m-d H:i:s");
			$url  = $_POST["url"];
			
		}
		

	
// INSERIR A SOLICITAÇÃO NO BANCO
	if($_POST["status"] == 1){ 	
	  $sql = "INSERT INTO `prorrogacao`(`id`, `id_internamento`,`id_acomodacao`, `id_usuario`, `data_inicial`,`data_final`,`medico_solicitante`, `crm`, `dias_solicitados`, `dias_autorizados` , `motivo`, `motivo_autorizacao`, `data_prorrogacao` , `qtd_respiratoria`, `qtd_motora`,`status`) VALUES ( null ,'".$id_internamento."', '".$id_acomodacao."', '".$id_usuario."','".$data_inicial."','".$data_final."', '".$medico_solicitante."' , '".$crm."' , '".$dias_solicitados."' , null ,'".$motivo."' , null ,'". $data_prorrogacao ."' ,'".$qtd_respiratoria."' ,'".$qtd_motora."' , '1' )";
	
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	$ultimo_id_prorrogacao = $pdo->lastInsertId();

	if(isset($ultimo_id_prorrogacao) && !empty($ultimo_id_prorrogacao)){
	// TRATAMENTO IMAGEM
		// VERIFICA SE A IMAGEM FOI ENVIADA
		if (!isset($_FILES['imagem'])){	
			echo retorno('Selecione uma imagem');
			exit;
		}else{
			
			$nome = utf8_decode($foto['name']);
			$tipo = $foto['type'];
			$tamanho = $foto['size'];		
			// DEFINIÇÕES DO ARQUIVO
				//TAMANHO MÁXIMO TRATADO (2M)
					define('TAMANHO_MAXIMO', (2 * 1024 * 1024));		
				// TIPO 
				if( preg_match('/^application\/(pdf)$/', $tipo) ) {
				  $tag = 1;
				}
				// EXTENÇÃO
				if (preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)){
				  $tag = 1;
				}
			
			// VALIDAÇÕES	
				// SE FORMATO OU EXTENÇÃO NÃO ESTIVER EM CONFORMIDADE
				if(isset($tag) <> 1){  
					 echo"<script language='javascript' type='text/javascript'>alert('Extenção de arquivo válida!');window.location.href='".$url."'</script>";
					exit;
				}
				// SE TAMANHO MÁXIMO NÃO ESTIVER EM CONFORMIDADE 
				if ($tamanho > TAMANHO_MAXIMO){
					echo"<script language='javascript' type='text/javascript'>alert('A imagem deve possuir no máximo 2 MB!');history.back();</script>";
					exit;
				}		
			// TRANS FORMANDO IMAGEM EM DADO BINÁRIO
				$imagem = file_get_contents($foto['tmp_name']);		
			// IMAGEM NO BANCO 
				$sql = 'INSERT INTO imagem (id, id_internamento, id_prorrogacao, id_pronto_atendimento, nome, evento, descricao, tipo, tamanho, data ,imagem) VALUES (null,:id_internamento ,:ultimo_id_prorrogacao,null,:nome,:evento ,:descricao ,:tipo,:tamanho, "'.date("Y-m-d H:i:s" ).'", :imagem)';
				
				$stmt = $pdo->prepare($sql);
				// PARAMETROS
				$stmt->bindParam(':id_internamento', $id_internamento, PDO::PARAM_INT);
				$stmt->bindParam(':ultimo_id_prorrogacao', $ultimo_id_prorrogacao, PDO::PARAM_INT);
				$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
				$stmt->bindParam(':evento', $evento, PDO::PARAM_STR);
				$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
				$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
				$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
				$stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
			
				
				if ($stmt->execute()){
					 echo"<script language='javascript' type='text/javascript'>alert('Solicita\u00e7\u00e3o encaminhada para aprova\u00e7\u00e3o!');window.location.href='".$url."&prorro=x';</script>";
					exit;
					
				}
			   }
		}
	}else{
	
	 $sql ='UPDATE `prorrogacao` SET 
			`data_inicial_aut` = "'.$data_inicial_aut.'", 
			`data_final_aut`   = "'.$data_final_aut.'" , 
			`dias_autorizados` = '.$dias_autorizados.',  
			`motivo_autorizacao`    = "'.$motivo_autorizacao.'",  
			`data_autorizacao` = "'.$data_autorizacao.'", 
			`qtd_motora_aut` = "'.$qtd_motora_aut.'", 
			`qtd_respiratoria_aut` = "'.$qtd_respiratoria_aut.'", 
			`status`= 2  
		  WHERE `id` = '.$id_prorro;
	
	$stmt = $pdo->prepare($sql);
		if ($stmt->execute()){
			echo"<script language='javascript' type='text/javascript'>alert('Prorroga\u00e7\u00e3o autorizada!');window.location.href='".$url."&prorro=x';</script>";
			exit;	
		}	
	}
// -- //
?>

