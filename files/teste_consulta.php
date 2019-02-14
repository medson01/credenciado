<?php
  //Arquivo de configura��o
  include "cabecalho.php";

// DEFINI��ES
// Numero de campos de upload
$numeroCampos = 5;
// Tamanho m�ximo do arquivo (em bytes)
$tamanhoMaximo = 1000000;
// Extens�es aceitas
$extensoes = array(".xlsx", ".txt", ".pdf", ".xls");
// Caminho para onde o arquivo ser� enviado
$caminho = "../producao/";
// Substituir arquivo j� existente (true = sim; false = nao)
$substituir = false;
 
for ($i = 0; $i < $numeroCampos; $i++) {
	
	// Informa��es do arquivo enviado
	$nomeArquivo = $_FILES["arquivo"]["name"][$i];
	$tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
	$nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
	
	
	// Verifica se o arquivo foi colocado no campo
	if (!empty($nomeArquivo)) {
	
		$erro = false;
	
		// Verifica se o tamanho do arquivo � maior que o permitido
		if ($tamanhoArquivo > $tamanhoMaximo) {
			$erro = "O arquivo " . $nomeArquivo . " n�o deve ultrapassar " . $tamanhoMaximo. " bytes";
		} 
		// Verifica se a extens�o est� entre as aceitas
		elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
			$erro = "A extens�o do arquivo <b>" . $nomeArquivo . "</b> n�o � v�lida";
		} 
		// Verifica se o arquivo existe e se � para substituir
		elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
			$erro = "O arquivo <b>" . $nomeArquivo . "</b> j� existe";
		}
	    
		//Pegando extens�o do arquivo
	     $ext = strtolower(substr($nomeArquivo,-3));
		 
		// Se n�o houver erro
		if (!$erro) {
			// Muda o nome do arquivo
			$nomeArquivo = $_SESSION["credenciado"]."_". date("d.m.Y-H.i.s").".".$ext;
			// Move o arquivo para o caminho definido
			move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
			// Mensagem de sucesso
			echo "O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso. <br />";
		} 
		// Se houver erro
		else {
			// Mensagem de erro
			echo $erro . "<br />";
		}
	}
}
?>