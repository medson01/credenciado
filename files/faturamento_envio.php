<?php 



$id_usuario =  $_POST["id"];
$codigo = $_POST["codigo"];
$credenciado = $_POST["credenciado"];
$prod_mes = $_POST["prod_mes"];
$prod_ano = $_POST["prod_ano"];
$cpf_cnpj = $_POST["cpf_cnpj"];
$telefone = $_POST["telefone"];
$celular = $_POST["celular"];
$email = $_POST["email"];
$qtd_eletivas = $_POST["qtd_eletivas"];
$val_eletivas = $_POST["val_eletivas"];
$qtd_emergencias = $_POST["qtd_emergencias"];
$val_emergencias = $_POST["val_emergencias"];
$qtd_visitas = $_POST["qtd_visitas"];
$val_visitas = $_POST["val_visitas"];
$qtd_raix = $_POST["qtd_raix"];
$val_raix = $_POST["val_raix"];
$qtd_previos = $_POST["qtd_previos"];
$val_previos = $_POST["val_previos"];
$qtd_procedimento = $_POST["qtd_procedimento"];
$val_procedimento = $_POST["val_procedimento"];
$qtd_pa = $_POST["qtd_pa"];
$val_pa = $_POST["val_pa"];
$qtd_auditoria = $_POST["qtd_auditoria"];
$val_auditoria = $_POST["val_auditoria"];
$quantidade = $_POST["quantidade"];
$valor = $_POST["valor"];


		$query = "INSERT INTO `faturamento`(`id`, `id_usuario`, `mes`, `ano`, `qtd_eletivas`, `val_eletivas`, `qtd_emergencias`, `val_emergencias`, `qtd_visitas`, `val_visitas`, `qtd_raix`, `val_raix`, `qtd_previos`, `val_previos`, `qtd_procedimento`, `val_procedimento`, `qtd_pa`, `val_pa`, `qtd_auditoria`, `val_auditoria`, `quantidade`, `valor`) VALUES (null, '".$id_usuario."', '".$prod_mes."', '".$prod_ano."', '".$qtd_eletivas."', '".$val_eletivas."', '".$qtd_emergencias."', '".$val_emergencias."', '".$qtd_visitas."', '".$val_visitas."', '".$qtd_raix."', '".$val_raix."', '".$qtd_previos."', '".$val_previos."', '".$qtd_procedimento."', '".$val_procedimento."', '".$qtd_pa."', '".$val_pa."', '".$qtd_auditoria."', '".$val_auditoria."', '".$quantidade."', '".$valor."')";

		             

        $insert = mysqli_query($conn, $query);
        
        if($insert){
         
		   
		  
		     if(isset($_FILES['arquivo']))
				   {
					  date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
				
											  
						// DEFINIÇÕES
						// Numero de campos de upload
						$numeroCampos = 5;
						// Tamanho máximo do arquivo (em bytes)
						$tamanhoMaximo = 1000000;
						// Extensões aceitas
						$extensoes = array(".xlsx", ".txt", ".pdf", ".xls");
						// Caminho para onde o arquivo será enviado
						$caminho = "../producao/";
						// Substituir arquivo já existente (true = sim; false = nao)
						$substituir = false;
						 
						for ($i = 0; $i < $numeroCampos; $i++) {
							
							// Informações do arquivo enviado
							$nomeArquivo = $_FILES["arquivo"]["name"][$i];
							$tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
							$nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
							
							$nomeArqAntigo[$i] = $nomeArquivo;
							
							// Verifica se o arquivo foi colocado no campo
							if (!empty($nomeArquivo)) {
							
								$erro = false;
							
								// Verifica se o tamanho do arquivo é maior que o permitido
								if ($tamanhoArquivo > $tamanhoMaximo) {
									$erro = "O arquivo " . $nomeArquivo . " n\u00e3o deve ultrapassar " . $tamanhoMaximo. " bytes";
								} 
								// Verifica se a extensão está entre as aceitas
								elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
									$erro = "A extens\u00e3o do arquivo " . $nomeArquivo . " n\u00e3o \u00e9 v\u00e1lida. \\n Exten\u00e7\u00f5es permitidas: .xlsx, .txt, .pdf, .xls";
								} 
								// Verifica se o arquivo existe e se é para substituir
								elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
									$erro = "O arquivo " . $nomeArquivo . " j\u00e1 existe";
								}
								
								//Pegando extensão do arquivo
								 $ext = strtolower(substr($nomeArquivo,-3));
								 
								// Se não houver erro
								if (!$erro) {
									// Muda o nome do arquivo
									$nomeArquivo = $_SESSION["credenciado"]."_prod".$prod_mes.$prod_ano."_". $i ."_". date("d.m.Y-H.i.s").".".$ext;
									// Move o arquivo para o caminho definido
									move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
									// Mensagem de sucesso
									//echo "O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso. <br />";

								} 
								// Se houver erro
								else {
									// Mensagem de erro
									
									 echo"<script language='javascript' type='text/javascript'>alert('".$erro."');window.location.href='faturamento_formulario.php'</script>";
										
								}

								$x = $i + 1;
							}
						}
				   }
		  
		  									  
		  // Arquivos enviados

				if(!isset($x) ){		   
				  	
				  	echo"<script language='javascript'>alert('Faturamento cadastrado com sucesso! nenhum arquivo enviado; \\n Obrigado!');</script>"; 
				}else{
					
					echo"<script language='javascript'>alert('Faturamento cadastrado com sucesso! \\n ".$x." arquivo(s) enviado(s); \\n Obrigado!');</script>";
				
				}  
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Produção não enviada com sucesso!');window.location.href='faturamento_formulario.php'</script>";

        }
  
     
  
?>   