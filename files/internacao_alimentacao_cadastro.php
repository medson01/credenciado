
<?php 
  // Arquivo de configuração
  require_once "../config/config.php";
  // FORMATAR A DATA PARA O FORMATO DO BANCO ENG
  require_once "../func/formatar_data_banco.php";
  

// NEGAR AUTORIZAÇÃO DE PRORROGAÇÃO
if(isset($_GET["negar"])){ 
	$id_ali = $_GET["id_ali"];
	$id_internacao = $_GET["id_internacao"];
	$motivo_autorizacao  = $_GET["motivo_autorizacao"];
	$data_autorizacao = date("Y-m-d H:i:s");
		
	$sql ='UPDATE `alimentacao` SET `status`= 0 , `motivo_autorizacao`= "'.$motivo_autorizacao.'" , `data_autorizacao` = "'.$data_autorizacao.'" WHERE `id` = '.$id_ali;
	
	$stmt = $pdo->prepare($sql);
	
	if ($stmt->execute()){
			echo"<script language='javascript' type='text/javascript'>alert('Alimenta\u00e7\u00e3o negada!');window.location.href='internacao_menu.php?id=".$id_internacao."&ali=x';</script>";
			exit;	
	}	
	
	
	}
	
	// SOLICITAÇÃO
if($_POST["status"] == 1){ 	
	$id_internamento = $_POST["id"]; 
	$id_prorro = $_POST["id_prorro"]; 
	$medico_solicitante = utf8_decode($_POST["medico_solicitante"]);
	$crm = $_POST["ali_crm"]; // FOI MUDADO O NOME PARA EVITAR QUE A VARIÁVEL USA-SE UM VALOR ASSIM QUE ABRE A TELA.
	$nutrologo = utf8_decode($_POST["nutrologo"]);
	$crm_rqe = $_POST["crm_rqe"];echo "<br>";
	$qtd_diarias = $_POST["qtd_diarias"];
	$terapia_nutricial = utf8_decode($_POST["vias"]);
	$por_dia = $_POST["por_dia"];
	//$total_alimentacao  = $_POST["total_alimentacao"];	// NÃO ADICIONAR NO BANCO PQ O CALCULO DE qtd_diarias X por_dia = TOTAL DE ALIMENTAÇÃO
	$motivo_solicitacao = utf8_decode($_POST["motivo_ali"]);
	$foto = $_FILES['imagem'];
	$evento = utf8_decode($_POST["evento"]);
	$descricao = utf8_decode($_POST["descricao"]);
	$data_inicial  = formatar_data_banco($_POST["data_inicial"]);
	$data_final  = formatar_data_banco($_POST["data_final"]);	
	$url  = $_POST["url"];
}

// AUTORIZAÇÃO
if($_POST["status"] == 2){ 
	$id_internamento = $_POST["id"]; 
	$id_ali= $_POST["id_ali"];
	$qtd_diarias_aut = $_POST["dias_autorizados"];
	$qtd_por_dia_aut = $_POST["por_dia_aut"];
	$motivo_autorizacao = utf8_decode($_POST["medico_aut"]);
	$data_autorizacao = date("Y-m-d H:i:s");
	$url  = $_POST["url"];
}
		
	
// INSERIR A SOLICITAÇÃO NO BANCO
	if($_POST["status"] == 1){ 	
	  $sql = "INSERT INTO `alimentacao`(`id`, `id_internamento`, `id_prorro`, `medico_solicitante`, `crm`, `nutrologo`, `crm_rqe`, `qtd_diarias`, `terapia_nutricial`, `por_dia`, `motivo_solicitacao`, `data_inicial`, `data_final`, `data_sol_alimentacao`, `status`) VALUES (null,".$id_internamento.",".$id_prorro.",'".$medico_solicitante."',".$crm.",'".$nutrologo."',".$crm_rqe.",".$qtd_diarias.",'".$terapia_nutricial."',".$por_dia.",'".$motivo_solicitacao."',".$data_inicial.",".$data_final.",'".date("Y-m-d H:i:s" )."',1)";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	$ultimo_id_alimentacao = $pdo->lastInsertId();
	
	if(isset($ultimo_id_alimentacao) && !empty($ultimo_id_alimentacao)){
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
				$sql = 'INSERT INTO imagem (id, id_internamento, id_alimentacao, id_pronto_atendimento, nome, evento, descricao, tipo, tamanho, data ,imagem) VALUES (null,:id_internamento ,:ultimo_id_alimentacao,null,:nome,:evento ,:descricao ,:tipo,:tamanho, "'.date("Y-m-d H:i:s" ).'", :imagem)';
				
				$stmt = $pdo->prepare($sql);
				// PARAMETROS
				$stmt->bindParam(':id_internamento', $id_internamento, PDO::PARAM_INT);
				$stmt->bindParam(':ultimo_id_alimentacao', $ultimo_id_prorrogacao, PDO::PARAM_INT);
				$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
				$stmt->bindParam(':evento', $evento, PDO::PARAM_STR);
				$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
				$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
				$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
				$stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
			
				
				if ($stmt->execute()){
					 echo"<script language='javascript' type='text/javascript'>alert('Solicita\u00e7\u00e3o encaminhada para aprova\u00e7\u00e3o!');window.location.href='internacao_menu.php?id=".$id_internamento."&ali=0';</script>";
					exit;
					
				}
			}
		}else{
					echo"<script language='javascript' type='text/javascript'>alert('Problema na base alimenta\u00e7\u00e3oo. Solicita\u00e7\u00e3o n\u00e3o encaminhada!');window.location.href='internacao_menu.php?id=".$id_internamento."&ali=0';</script>";
					exit;
		}

	}else{
	
	 $sql ='UPDATE `alimentacao` SET 
	 		`qtd_diarias_aut` = "'.$qtd_diarias_aut.'", 
			`qtd_por_dia_aut` = "'.$qtd_por_dia_aut.'", 
			`motivo_autorizacao` = "'.$motivo_autorizacao.'", 
			`data_autorizacao` = "'.$data_autorizacao.'", 
			`status`= 2  
		  WHERE `id` = '.$id_ali;
	
	$stmt = $pdo->prepare($sql);

		if ($stmt->execute()){
			echo"<script language='javascript' type='text/javascript'>alert('Alimenta\u00e7\u00e3o autorizada!');window.location.href='internacao_menu.php?id=".$id_internamento."&id_prorro=';</script>";
			exit;	
		}	
	}
// -- //
?>