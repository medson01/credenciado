<?php

  
	if(!empty($_GET["id_internacao"])){

		  //Arquivo de configura��o
  		  include "cabecalho.php";

  		      # Corrige o erro de acentua��o no banco
				mysqli_query($conn,"SET NAMES 'utf8'");
	

		$res = $_GET["id_internacao"];

			 $query = mysqli_query($conn,"SELECT internamento.nome as paciente, internamento.matricula as matricula, prorrogacao.medico_solicitante as solicitante, prorrogacao.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, cid.cid , cid.descricao as descricao ,usuarios.nome as credenciado, cid.dias as dias,  prorrogacao.motivo as motivo, prorrogacao.data_prorrogacao as data_prorrogacao, prorrogacao.dias as prorrogacao_dias FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa WHERE internamento.id =".$res) or die("erro ao carregar consulta");


						
	                    while($registro = mysqli_fetch_row($query)){

                        $nome = $registro[0];
                        $matricula = $registro[1];
                        $solicitante = $registro[2];
                        $crm = $registro[3];
                        $dat_entrada = $registro[4];
                        $dat_saida = $registro[5];
                        $cid = $registro[6];
                        $cid_desc = $registro[7];
                        $credenciado = $registro[8];
                        $dias = $registro[9];
                        $motivo = $registro[10];
                        $data_prorrogacao = $registro[11];
                        $prorrogacao_dias = $registro[12];
                         
                   }


	}else{
	 		 $query = mysqli_query($conn,"SELECT internamento.dat_saida as dat_saida , usuarios.nome as credenciado , internamento.dat_entrada as dat_entrada  FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario WHERE internamento.id =".$res) or die("erro ao carregar consulta");
	

	  					
	                    while($registro = mysqli_fetch_row($query)){
                        
                        $dat_saida = $registro[0];
                        $credenciado = $registro[1];
                        $dat_entrada = $registro[2];
                        

                        
                   }
 
	 } 

if(!empty($_GET["id_pa"])){
			$query_pa = mysqli_query($conn,"SELECT  pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida, usuarios.nome as credenciado, pronto_atendimento.medico as medico, pronto_atendimento.motivo as motivo FROM `pronto_atendimento` 
								 INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario 
								 WHERE pronto_atendimento.id =".$_GET["id_pa"]) or die("erro ao carregar consulta");


									
				                    while($registro = mysqli_fetch_row($query_pa)){
			   
			                        $entrada_pa = $registro[0];
			                        $saida_pa = $registro[1];
			                        $credenciado_pa = $registro[2];
			                        $medico_pa = $registro[3];
									$motivo_pa = $registro[4];
			                      

			                         
			                   }


				}




?>
<style type="text/css">
<!--
.style2 {font-size: 24px}
.style6 {font-size: 18px}
-->
</style>
        
            <td width="898" id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    

  	<!-- T�tulo da p�gina -->                  
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading"> Relat&oacute;rio de Prorroga&ccedil;&atilde;o de Internamento </h1>
								</div>
                    </div>

  	<!-- / T�tulo da p�gina --> 
                    <div id="div">
                      <div>
                        <h1 class="documentFirstHeading"><br />
                          </p>
                          <!--  Conteudo --></h1>
                        <div id="div2" style="position:relative; height:100px; margin-left:40px; top:-20px" >
                          <div>
                            <div style="width:70px; position:relative" >
								<span class="documentFirstHeading">
									<span class="style2">
										<img src="../imagem/logo_ipaseal.png" width="71" height="97" />									</span>								</span>							</div>
							<div style="width:40px; position:relative; left:80px; width:500px; top:-60px">
							  <div align="center"><span class="documentFirstHeading"><span class="style2">Instituto de Assist&ecirc;ncia &agrave; Sa&uacute;de dos Servidores do Estado de Alagoas</span></span></div>
							</div>
                          </div>
                        </div>
                      </div>
                    </div>

       <?php
            if(!empty($_GET["id_pa"])){
				
				echo "<div style='height:725px'>";


            }else{
            	echo "<div style='height:550px'>";
       		 }     

       ?>   
        <table width="100%" class='table' style='font-size: 10px';>	
						
						<tr>
						  <th colspan="2" bgcolor="#CCCCCC" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">
					      N&uacute;mero da guia:  <?php echo $res; ?></div></th>
		  </tr>
						<tr>
							<th width='48%' scope='col'><div align='left'>Nome do paciente: <br> &nbsp; <?php echo $nome; ?></div></th>
			 
							<th width="52%" scope='col'><div align='left'>Matricula: <br> &nbsp; <?php echo $matricula; ?></div></th>
		              	</tr>
						 <tr>
								<th scope='row'><div align='left'>
							    <div align="left">Data de Emiss&atilde;o: <br> &nbsp; <?php print date("j / n / Y"); ?></div></th>
								<th> <div align="left">Hora: <br> &nbsp; <?php print date("H:i:s"); ?></div></th>
						</tr>
			
						 <tr>
						   <th scope='row'><div align="left">Credenciado: <br> &nbsp; <?php echo	$credenciado;  ?> </div></th>
						   <th scope='col'><div align="left"></div></th>
	      </tr>
					    <tr>
								<th scope='row'><div align='left'>Atendente: <br> &nbsp; <?php echo utf8_encode($_SESSION['login']); ?></div></th>
								<th scope='col'><div align='left' style="color:#FF0000"></div></th>
          </tr>
		  
		<?php  
			
			if(!empty($_GET["id_pa"])){

				echo	'    <tr>
                          <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope="row"><div align="center">Dados do Pronto Atendimento </div></th>
				      </tr>
					    <tr>
                          <th scope="row"><div align="left">
                              <div align="left">M�dico atendente<br />
                                &nbsp; ';
                               
								
								if(!empty($medico)){

					      			echo $medico_pa;
					      		}

				echo '	      	
                              </div>
                            <div align="left"> <br />
                              </div>
                            <div align="left"></div></th>
					      <th scope="col"><div align="left">
                              <div align="left">Motivo do atendimento <br />
                                &nbsp; ';
                                
								
								if(!empty($motivo)){

					      			echo $motivo_pa;
					      		}

				echo '	      	
                              </div>
					        <div align="left"> </div></th>
				      </tr>
					    <tr>
                          <th scope="row"><div align="left">Data da entrada: <br />
                            &nbsp;';

                              print date('j / n / Y', strtotime($dat_entrada)); 

                echo'               </div></th>
					      <th scope="col"><div align="left">Hora da entrada: <br />
					        &nbsp; ';

					         print date('H:i:s', strtotime($dat_entrada));  

				echo'	         <br />
					        &nbsp;</div></th>
				      </tr>
					    <tr>
					      <th scope="row"><div align="left">Data de Sa�de: <br />  &nbsp;';
  
					      		
					      			if($dat_saida <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida));	
					      			} 
					      		 
				echo'	      	
                          </div></th>
					      <th scope="col"><div align="left">Perman�ncia: <br /> &nbsp;';
  
								
								if(!empty($dat_saida)){	
										
										 $date_time  = new DateTime($dat_entrada);
										 $diff       = $date_time->diff( new DateTime($dat_saida));
										 echo $diff->format('%H hora(s), %i minuto(s) e %s segundo(s)');

					      		}

				echo'	      	
                          </div></th>
				      </tr>';

			}	      

		?>			    
					    <tr>
					      <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope='row'><div align="center">Dados da Prorroga&ccedil;&atilde;o </div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">M&eacute;dico solicitante: <br> &nbsp; <?php echo $solicitante; ?></div></th>
					      <th scope='col'><div align="left">CRM: <br> &nbsp; <?php echo $crm; ?></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">C&oacute;digo do CID: <br> &nbsp; <?php echo  $cid; ?> </div></th>
					      <th scope='col'><div align="left">Descri&ccedil;&atilde;o do CID: <br> &nbsp;<?php echo "&nbsp;&nbsp;".$cid_desc; ?></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Data de entrada: <br />
  &nbsp; <?php print date('d / m / Y ', strtotime($dat_entrada));  ?></div></th>
					      <th scope='col'><div align="left">Di&aacute;rias CID: <br />
  &nbsp; <?php echo $dias; ?> dia(s) </div></th>
	      </tr>
					    <tr>
					      <th scope='row'><div align="left">Prorroga&ccedil;&atilde;o: <br />
&nbsp; <?php echo $prorrogacao_dias; ?> dia(s) </div></th>
					      <th scope='col'><div align="left">Nova previs&atilde;o de  sa&iacute;da: <br />
&nbsp;
<?php 
						  		$dias = $dias+$prorrogacao_dias;
						  		echo date('d / m / Y', strtotime($dat_entrada."+".$dias." days"));   
						  
						  ?>
</div></th>
				      </tr>
					    
					    <tr>
					      <th scope='row'><div align="left">
					      	<?php
								
								if(!empty($motivo)){

									echo "Motivo do internamento: <br> &nbsp;";	 

					      			echo $motivo;
					      		}

					      	?> </div>					      </th>
					      <th scope='col'><div align="left"></div>					      </th>
				      </tr>
				       <tr>
					      <th scope='row'><div align="left">
					        <?php
								
								if(!empty($data_prorrogacao)){

									echo "Data da Prorroga&ccedil;&atilde;o: <br> &nbsp;";	 

					      			echo date('d / m / Y \h\s H:i:s', strtotime($data_prorrogacao)); 
					      		}

					      	?>
					      </div>					      </th>
				         <th scope='col'><div align="left">Data de Sa&iacute;de: <br />
&nbsp;
<?php 
					      		
					      			if($dat_saida <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida));	
					      			} 
					      		 
					      	?>
</div>					      	</th>
				      </tr>
    				</table>
		 		</div>
				        <div align="center">
	        <p>

	<!-- Remover o sublinhado -->
				<style type="text/css">
					a:link {
					text-decoration:none;
					}
					a:visited {
					text-decoration:none;
					}
					a:hover {
					text-decoration:underline;
					}
				</style>

  <a href='painel.php?int=1' > <input class='btn btn-primary delete' type="button" value="Voltar"> </a>
 
	          <input class='btn btn-primary delete'  name="button" type="button" onClick="window.print();" value="Imprimir" />
          </p>
	        <p><br />
            </p>
        </div>
                      


          </tr>
        </tbody>
    </table>
	
	
	

</div>
      <div class="visualClear" id="clear-space-before-footer"><!-- --></div>
      
      

      

        <div id="portal-footer">
	<div id="governo">
	  <p>&nbsp;</p>
	</div>
	<div id="institucional">
		<p>Estado de Alagoas</p>
		<p>
			�2017 
			- 
			Instituto de Assist�ncia � Sa�de dos Servidores do Estado de Alagoas 
			
			- 
			IPASEAL SA�DE
			
		</p>
		
			<p>Pr�dio Sede - Rua Cincinato Pinto, N� 226, 57020-050, Macei�-AL</p>
                        <p>Centro Cl�nico - Rua Ladislau Neto, esquina com a Rua Cincinato Pinto, s/n� - Centro</p>
			<script type="text/javascript">jq(document).ready(function() {
					jq("a#iframe").fancybox();
				})
			</script>
		
		<div id="contato">
			<img src="imagem/telefone.gif" alt="Telefone" width="28" height="25">
			Telefone: 
			0800-082-8182 
			
			
			<img src="imagem/email.gif" alt="E-mail" width="28" height="25">
			ascom@ipaseal.al.gov.br		</div>
	</div>
	<div id="itec"></div>
	<div class="visualClear"></div>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11181463-19']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

      

      <div class="visualClear"><!-- --></div>
    </div>
<div id="kss-spinner"></div>



<div id="fancy_overlay"></div><div id="fancy_wrap"><div class="fancy_loading" id="fancy_loading"><div></div></div><div id="fancy_outer"><div id="fancy_inner"><div id="fancy_close"></div><div id="fancy_bg"><div class="fancy_bg fancy_bg_n"></div><div class="fancy_bg fancy_bg_ne"></div><div class="fancy_bg fancy_bg_e"></div><div class="fancy_bg fancy_bg_se"></div><div class="fancy_bg fancy_bg_s"></div><div class="fancy_bg fancy_bg_sw"></div><div class="fancy_bg fancy_bg_w"></div><div class="fancy_bg fancy_bg_nw"></div></div><a href="javascript:;" id="fancy_left"><span class="fancy_ico" id="fancy_left_ico"></span></a><a href="javascript:;" id="fancy_right"><span class="fancy_ico" id="fancy_right_ico"></span></a><div id="fancy_content"></div><div id="fancy_title"></div>
</div></div></div><div id="fancy_overlay"></div><div id="fancy_wrap"><div class="fancy_loading" id="fancy_loading"><div></div></div><div id="fancy_outer"><div id="fancy_inner"><div id="fancy_close"></div><div id="fancy_bg"><div class="fancy_bg fancy_bg_n"></div><div class="fancy_bg fancy_bg_ne"></div><div class="fancy_bg fancy_bg_e"></div><div class="fancy_bg fancy_bg_se"></div><div class="fancy_bg fancy_bg_s"></div><div class="fancy_bg fancy_bg_sw"></div><div class="fancy_bg fancy_bg_w"></div><div class="fancy_bg fancy_bg_nw"></div></div><a href="javascript:;" id="fancy_left"><span class="fancy_ico" id="fancy_left_ico"></span></a><a href="javascript:;" id="fancy_right"><span class="fancy_ico" id="fancy_right_ico"></span></a><div id="fancy_content"></div><div id="fancy_title"></div></div></div></div>

<!-- java script bootstrap-->
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</body></html>