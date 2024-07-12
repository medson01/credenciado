<?php
// ARQUIVO DE BANCO
  require_once "../config/config.php";
// FORMATAR A DATA PARA O FORMATO DO BANCO ENG
  require_once "../func/formatar_data_banco.php";
  
// ENTRADA DE DADOS
	// SOLICITAÇÃO
	// ESTATUS TEM QUE SER 1
	if($_POST["status"] == 1){ 	
		$status = $_POST["status"];
		$id = $_POST["id"];
		$id_acomodacao = $_POST["id_acomodacao"];
		$id_usuario = $_SESSION["id"];
		$data_inicial  = formatar_data_banco($_POST["data_inicial"]);
		$data_final  = formatar_data_banco($_POST["data_final"]);
		$medico_solicitante  = $_POST["medico_solicitante"];
		$crm  = $_POST["crm"];
		$dias_solicitados  = $_POST["dias"];
		$qtd_respiratoria1  = $_POST["qtd_respiratoria1"];
		$qtd_motora1  = $_POST["qtd_motora1"];
		$motivo  = $_POST["motivo"];	
		$foto = $_FILES['imagem'];
		$evento = utf8_decode($_POST["evento"]);
		$descricao = utf8_decode($_POST["descricao"]);	
		$data_prorrogacao = date("Y-m-d H:i:s" );
		$url  = $_POST["url"];
	}
	// AUTORIZAÇÃO
		// ESTATUS TEM QUE SER 2
		if($_POST["status"] == 2){
			$status = $_POST["status"]; 
			$dias_autorizados  = $_POST["dias_autorizados"];
			$motivo_medico  = $_POST["motivo_medico"];
			$data_autorizacao = $_POST["data_autorizacao"];
		}
	// VALIDAÇÃO DE DADOS
		// PEGA A URL DO FORMULARIO DE PRORROGAÇÃO E ATIVA A ABA PRORROGAÇÃO, ALÉM DE DEIXAR ELA NO PADRÃO prorro=1
		//$url = str_replace('prorro=','prorro=1',$url);
		//if (strpos($url, 'prorro=11') !== false) {
		//	$url = str_replace('prorro=11','prorro=1',$url);
		//}	
		// TRANSFORMAR DATA
		 		
	
// INSERIR A SOLICITAÇÃO NO BANCO
	if($status == 1){
	  $sql = "INSERT INTO `prorrogacao`(`id`, `id_internamento`,`id_acomodacao`, `id_usuario`, `data_inicial`,`data_final`,`medico_solicitante`, `crm`, `dias_solicitados`, `dias_autorizados` , `motivo`, `motivo_medico`, `data_prorrogacao` , `qtd_respiratoria`, `qtd_motora`,`status`) VALUES ( null ,'".$id."', '".$id_acomodacao."', '".$id_usuario."','".$data_inicial."','".$data_final."', '".$medico_solicitante."' , '".$crm."' , '".$dias_solicitados."' , null ,'".$motivo."' , null ,'". $data_prorrogacao ."' ,'".$qtd_respiratoria1."' ,'".$qtd_motora1."' , '1' )";
	
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
				$stmt->bindParam(':id_internamento', $id, PDO::PARAM_INT);
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
		echo"<script language='javascript' type='text/javascript'>alert('Erra na geração do ID prorroga\u00e7\u00e3o!\\n Tente novamente. ');window.location.href='".$url."'</script>";
			exit;		
	}
// -- //
?>

