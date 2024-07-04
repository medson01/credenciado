<?php
// ARQUIVO DE BANCO
  require_once "../config/config.php";
  
// ENTRADA DE DADOS
	$id = $_POST["id"];
	$evento = utf8_decode($_POST["evento"]);
	$descricao = utf8_decode($_POST["descricao"]);
	$url  = $_POST["url"];
	// PEGA A URL DO FORMULARIO DE PRORROGAÇÃO E ATIVA A ABA PRORROGAÇÃO, ALÉM DE DEIXAR ELA NO PADRÃO prorro=1
	str_replace('prorro=','prorro=1',$url);
	if (strpos($url, 'prorro=11') !== false) {
		str_replace('prorro=11','prorro=1',$url);
	}
	// VERIFICA SE A IMAGEM FOI ENVIADA
	if (!isset($_FILES['imagem'])){	
		echo retorno('Selecione uma imagem');
		exit;
	}else{
		$foto = $_FILES['imagem'];
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
	$sql = 'INSERT INTO imagem (id, id_internamento, id_pronto_atendimento, nome, evento, descricao, tipo, tamanho, data ,imagem) VALUES (null,'.$id.',null,:nome,:evento ,:descricao ,:tipo,:tamanho, "'.date("Y-m-d H:i:s" ).'", :imagem)';
	
	$stmt = $pdo->prepare($sql);
	// PARAMETROS
	$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
	$stmt->bindParam(':evento', $evento, PDO::PARAM_STR);
	$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
	$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
	$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
	$stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
	
	$stmt->execute();
	echo $_SESSION['ultimo_id_umagem'] = $pdo->lastInsertId();
	exit();
   }

?>

