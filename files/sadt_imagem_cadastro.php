<?php
    // Arquivo de configuração
require_once "../config/config.php";

// Verificando se selecionou alguma imagem
if (!isset($_FILES['imagem']))
{
    echo retorno('Selecione uma imagem');
    exit;
}
// TAMANHO MÁQUIMO 2M
define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

// Recupera os dados dos campos
$id = isset($_POST["id_sadt"])? $_POST["id_sadt"] : '';
$nome = $_FILES['imagem']['name'];
$foto = $_FILES['imagem'];
$tipo = $foto['type'];
$tamanho = $foto['size'];
$evento = "sadt";

// VALIDAÇÕES DO ARQUIVO DE IMAGEM

// FORMATO
if( preg_match('/^application\/(pdf)$/', $tipo) ) {
  $tag = 1;
}
// EXTENÇÃO
if (preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)){
  $tag = 1;
}

// REGRA DO TIPO DE ARQUIVO ENVIADO APENAS pjpeg,jpeg,png,gif,bmp
if(isset($tag) <> 1){  
    //echo retorno('Isso não é uma imagem válida');
	echo"<script language='javascript' type='text/javascript'>alert('Exten\u00e7\u00e3o de arquivo v\u00e1lida!');window.history.back();</script>";
    exit;
}

// REGRA DE TAMANHO MÁXIMO DO ARQUIVO
if ($tamanho > TAMANHO_MAXIMO)
{
    echo"<script language='javascript' type='text/javascript'>alert('A imagem deve possuir no m\u00e1ximo 2 MB!');window.history.back();</script>";
    exit;
}

// Transformando foto em dados (binário)
$imagem = file_get_contents($foto['tmp_name']);


// Preparando comando
	if(isset($_SESSION['ultima_id_sdat']) && $_SESSION['ultima_id_sdat'] == $id){
		$sql4 = 'UPDATE `imagem` SET `imagem`=:imagem WHERE `id_sadt` = '.$id;
	}else{
		$sql4 = 'INSERT INTO imagem (id, id_internamento, id_prorrogacao, id_pronto_atendimento, id_sadt, nome, evento, descricao, tipo, tamanho, data ,imagem) VALUES (null,null,null,null,'.$id.',:nome,:evento ,null,:tipo,:tamanho, "'.date("Y-m-d H:i:s" ).'", :imagem)';
	
	}

$stmt4 = $pdo->prepare($sql4);

// Definindo parâmetros
$stmt4->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt4->bindParam(':evento', $evento, PDO::PARAM_STR);
$stmt4->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt4->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
$stmt4->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
$stmt4->execute();
$_SESSION['ultima_id_sdat'] = $id;
// Executando e exibindo resultado
 echo"<script language='javascript' type='text/javascript'>alert('Imagem anexada!');window.history.back();</script>";
?>

