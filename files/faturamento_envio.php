<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
	

 ?>
 
<style type="text/css">
<!--
.style3 {font-size: 10px}
-->
</style>
        
            <td width="898" id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading">Envio Faturamento </h1>
   									 <p class="documentFirstHeading">&nbsp;</p>
                      			</div>
                    </div>
					<table width="688"border="0"align="center">
                                <tr>
                                  <td colspan="4"><div align="center"><font>Detalhe do envio</font> </div></td>
                                </tr>
                                <tr>
                                  <td colspan="4">&nbsp;                                </td>
                      <tr>
                        <td colspan="4"><span class="style3">Arquivos:</span>                          <br />
                        <?php 


$id_usuario =  $_POST["id"];
$prod_mes = $_POST["prod_mes"];
$prod_ano = $_POST["prod_ano"];
$qtd_lote = $_POST["qtd_lote"];
$valor = $_POST["valor"];

        $query = "INSERT INTO faturamento (id, id_usuario, mes, ano, qtd_lote, valor) VALUES (null,'$id_usuario','$prod_mes','$prod_ano','$qtd_lote', '$valor')";
      

        $insert = mysqli_query($conn, $query);
        
        if($insert){
          /* echo"<script language='javascript' type='text/javascript'>alert('Faturamento cadastrado com sucesso!');window.location.href='form_faturamento_envio.php'</script>"; */
		  
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
							
							
							// Verifica se o arquivo foi colocado no campo
							if (!empty($nomeArquivo)) {
							
								$erro = false;
							
								// Verifica se o tamanho do arquivo é maior que o permitido
								if ($tamanhoArquivo > $tamanhoMaximo) {
									$erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
								} 
								// Verifica se a extensão está entre as aceitas
								elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
									$erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
								} 
								// Verifica se o arquivo existe e se é para substituir
								elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
									$erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
								}
								
								//Pegando extensão do arquivo
								 $ext = strtolower(substr($nomeArquivo,-3));
								 
								// Se não houver erro
								if (!$erro) {
									// Muda o nome do arquivo
									$nomeArquivo = $_SESSION["credenciado"]."_". $i ."_". date("d.m.Y-H.i.s").".".$ext;
									// Move o arquivo para o caminho definido
									move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
									// Mensagem de sucesso
									echo "O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso. <br />";
									$x = 0;
									$x = $x + 1;
								} 
								// Se houver erro
								else {
									// Mensagem de erro
									
									echo "<tr>
                                  			<td>Erros</td>
                                  			<td>" . $erro .	"</td>
										  </tr>";
										
								}
							}
						}
				   }
		  
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Produção não enviada com sucesso!');window.location.href='form_faturamento_envio.php'</script>";

        }
  
     
  
?>                                </td>
                      <tr>
                        <td width="263">&nbsp;</td>
                        <td width="415" colspan="3" style="font-size:10px">
                      <tr>
                          <td colspan="2"><span class="style3">Quantidade de arquivos enviados</span><br />
                          <?php echo $x+1; ?></td>
                          </tr>
		</table>
<p><br />
		            </p>
                     <div class="x"></div>
			<div id="feature"></div>
  </div>		
<!-- Conteudo -->
					
			       
					
					
					
					
<!--/ Coonteudo -->                      
                      </p>
              </div>
           
          </tr>
        </tbody>
    </table>

</div>
  
  
 <?php
 
 	  include "rodape.php";
 ?>     