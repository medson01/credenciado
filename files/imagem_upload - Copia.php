<?php
    // Arquivo de configuração
  require_once "../config/config.php";

// Funções de utilidade
//require_once('../funcs/imagem_util.php');

// Constantes
define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

// Verificando se selecionou alguma imagem
if (!isset($_FILES['imagem']))
{
    echo retorno('Selecione uma imagem');
    exit;
}

// Recupera os dados dos campos
$evento = $_POST["evento"];
$descricao = $_POST["descricao"];
$foto = $_FILES['imagem'];
$nome = $foto['name'];
$tipo = $foto['type'];
$tamanho = $foto['size'];

// Validações básicas
// Formato
if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo))
{
    echo retorno('Isso não é uma imagem válida');
    exit;
}

// Tamanho
if ($tamanho > TAMANHO_MAXIMO)
{
    echo retorno('A imagem deve possuir no máximo 2 MB');
    exit;
}

// Transformando foto em dados (binário)
$imagem = file_get_contents($foto['tmp_name']);

// Preparando comando
$stmt = $pdo->prepare('INSERT INTO imagem (id, id_internamento, id_pronto_atendimento, nome, evento, descricao, tipo, tamanho, imagem) VALUES (null,null,null,:nome,:evento ,:descricao ,:tipo,:tamanho,:imagem)');

// Definindo parâmetros
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':evento', $evento, PDO::PARAM_STR);
$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
$stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_INT);
$stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);

// Executando e exibindo resultado
if ($stmt->execute()) { 
   
header("Location: ".$_SERVER['HTTP_REFERER']."");

} else {
    die (mysql_error());
}

?>

