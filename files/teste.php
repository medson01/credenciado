<?php 
  
  //Arquivo de configura��o
  include "cabecalho.php";
	

 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de busca interna com PHP/MySQL</title>
</head>
 
<body>
<form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
    <input type="text" name="palavra" />
    <input type="submit" value="Buscar" />
</form>
 
<?php
// Conexão com o banco de dados
$conn = @mysql_connect("localhost", "usuario", "senha") or die("Não foi possível a conexão com o Banco");
// Selecionando banco
$db = @mysql_select_db("produtos", $conn) or die("Não foi possível selecionar o Banco");
 
// Recuperamos a ação enviada pelo formulário
$a = $_GET['a'];
 
// Verificamos se a ação é de busca
if ($a == "buscar") {
 
	// Pegamos a palavra
	$palavra = trim($_POST['palavra']);
 
	// Verificamos no banco de dados produtos equivalente a palavra digitada
	$sql = mysql_query("SELECT * FROM produtos WHERE nome LIKE '%".$palavra."%' ORDER BY nome");
 
	// Descobrimos o total de registros encontrados
	$numRegistros = mysql_num_rows($sql);
 
	// Se houver pelo menos um registro, exibe-o
	if ($numRegistros != 0) {
		// Exibe os produtos e seus respectivos preços
		while ($produto = mysql_fetch_object($sql)) {
			echo $produto->nome . " (R$ ".$produto->valor.") <br />";
		}
	// Se não houver registros
	} else {
		echo "Nenhum produto foi encontrado com a palavra ".$palavra."";
	}
}
?>
</body>
</html>