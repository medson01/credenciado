<?php
    // Arquivo de configuração
  require_once "../config/config.php";

// Constantes
define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

// Verificando se selecionou alguma imagem
if (!isset($_FILES['imagem']))
{
    echo retorno('Selecione uma imagem');
    exit;
}

// Recupera os dados dos campos
$id = $_POST["id"];
$evento = utf8_decode($_POST["evento"]);
$descricao = utf8_decode($_POST["descricao"]);
$foto = $_FILES['imagem'];
$nome = utf8_decode($foto['name']);
$tipo = $foto['type'];
$tamanho = $foto['size'];

// Validações básicas
// Formato
if( preg_match('/^application\/(pdf)$/', $tipo) ) {
  $tag = 1;
}

if (preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)){
  $tag = 1;
}

if(isset($tag) <> 1){  
    //echo retorno('Isso não é uma imagem válida');

	 echo"<script language='javascript' type='text/javascript'>alert('Extenção de arquivo válida!');window.location.href='internacao_menu.php?id=".$id."'</script>";

    exit;
}

// Tamanho
if ($tamanho > TAMANHO_MAXIMO)
{
    echo"<script language='javascript' type='text/javascript'>alert('A imagem deve possuir no máximo 2 MB!');history.back();</script>";
    exit;
}

// Transformando foto em dados (binário)
$imagem = file_get_contents($foto['tmp_name']);

// Preparando comando
$stmt = $pdo->prepare('INSERT INTO imagem (id, id_internamento, id_pronto_atendimento, nome, evento, descricao, tipo, tamanho, data ,imagem) VALUES (null,'.$id.',null,:nome,:evento ,:descricao ,:tipo,:tamanho, "'.date("Y-m-d H:i:s" ).'", :imagem)');

// Definindo parâmetros
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':evento', $evento, PDO::PARAM_STR);
$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
$stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);

// Executando e exibindo resultado
if ($stmt->execute()) { 
   
header("Location: internacao_menu.php?id=".$id."&status=1");

} else {
    die (mysql_error());
}

?>

