
<?php 
  // Arquivo de configura��o
  require_once "../config/config.php";
  // FORMATAR A DATA PARA O FORMATO DO BANCO ENG
  require_once "../func/formatar_data_banco.php";

  // RECEBIMENTO DE DADOS HOSPITAL SOLICITA��O DE ALIMENTA��O
if($_POST["status"] == 1){ 	
	$id_internamento = $_POST["id"]; 
	$id_prorro = $_POST["id_prorro"]; 
	$medico_solicitante = utf8_decode($_POST["medico_solicitante"]);
	$crm = $_POST["ali_crm"]; // FOI MUDADO O NOME PARA EVITAR QUE A VARI�VEL USA-SE UM VALOR ASSIM QUE ABRE A TELA.
	$nutrologo = utf8_decode($_POST["nutrologo"]);
	$crm_rqe = $_POST["crm_rqe"];echo "<br>";
	$qtd_diarias = $_POST["qtd_diarias"];
	$vias = utf8_decode($_POST["vias"]);
	$por_dia = $_POST["por_dia"];
	//$total_alimentacao  = $_POST["total_alimentacao"];	// N�O ADICIONAR NO BANCO PQ O CALCULO DE qtd_diarias X por_dia = TOTAL DE ALIMENTA��O
	$motivo = utf8_decode($_POST["motivo"]);
	$foto = $_FILES['imagem'];
	$evento = utf8_decode($_POST["evento"]);
	$descricao = utf8_decode($_POST["descricao"]);
	$data_inicial  = formatar_data_banco($_POST["data_inicial"]);
	$data_final  = formatar_data_banco($_POST["data_final"]);	
	$url  = $_POST["url"];
}


		
	
// INSERIR A SOLICITA��O NO BANCO
	if($_POST["status"] == 1){ 	
	  $sql = "INSERT INTO `alimentacao`(`id`, `id_internamento`, `id_prorro`, `medico_solicitante`, `crm`, `nutrologo`, `crm_rqe`, `qtd_diarias`, `vias`, `por_dia`, `motivo`, `data_inicial`, `data_final`, `data_sol_alimentacao`, `status`) VALUES (null,".$id_internamento.",".$id_prorro.",'".$medico_solicitante."',".$crm.",'".$nutrologo."',".$crm_rqe.",".$qtd_diarias.",'".$vias."',".$por_dia.",'".$motivo."',".$data_inicial.",".$data_final.",'".date("Y-m-d H:i:s" )."',1)";

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
			// DEFINI��ES DO ARQUIVO
				//TAMANHO M�XIMO TRATADO (2M)
					define('TAMANHO_MAXIMO', (2 * 1024 * 1024));		
				// TIPO 
				if( preg_match('/^application\/(pdf)$/', $tipo) ) {
				  $tag = 1;
				}
				// EXTEN��O
				if (preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)){
				  $tag = 1;
				}
			
			// VALIDA��ES	
				// SE FORMATO OU EXTEN��O N�O ESTIVER EM CONFORMIDADE
				if(isset($tag) <> 1){  
					 echo"<script language='javascript' type='text/javascript'>alert('Exten��o de arquivo v�lida!');window.location.href='".$url."'</script>";
					exit;
				}
				// SE TAMANHO M�XIMO N�O ESTIVER EM CONFORMIDADE 
				if ($tamanho > TAMANHO_MAXIMO){
					echo"<script language='javascript' type='text/javascript'>alert('A imagem deve possuir no m�ximo 2 MB!');history.back();</script>";
					exit;
				}		
			// TRANS FORMANDO IMAGEM EM DADO BIN�RIO
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
		}
	}else{
	
	 $sql ='UPDATE `alimentacao` SET 
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