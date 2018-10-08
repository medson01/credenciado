<?php

  
	if(!empty($_GET["id_internacao"])){

		  //Arquivo de configuração
  		  include "cabecalho.php";

  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");
	

		$res = $_GET["id_internacao"];

			$query = mysqli_query($conn,"SELECT internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante,
					 internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, cid.cid , cid.descricao as 
					 descricao ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo FROM `internamento` 
					 INNER JOIN usuarios on usuarios.id = internamento.id_usuario 
					 INNER JOIN cid on cid.id = internamento.id_cid 
					 WHERE internamento.id =".$res) or die("erro ao carregar consulta");


						
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
                         
                   }


	}else{
	 		 $query = mysqli_query($conn,"SELECT internamento.dat_saida as dat_saida , usuarios.nome as credenciado , internamento.dat_entrada as dat_entrada, internamento.motivo as motivo FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario WHERE internamento.id =".$res) or die("erro ao carregar consulta");
	

	  					
	                    while($registro = mysqli_fetch_row($query)){
                        
                        $dat_saida = $registro[0];
                        $credenciado = $registro[1];
                        $dat_entrada = $registro[2];
                        $motivo = $registro[4];

                        
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
                    

                                      
                    <div id="viewlet-above-content"></div>

  	<!-- Título da página -->                  
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading"> Relatório de Internamento </h1>
								</div>
                    </div>

  	<!-- / Título da página --> 
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
							  <div align="center"><span class="documentFirstHeading"><span class="style2">Instituto de Assistência à Saúde dos Servidores do Estado de Alagoas</span></span></div>
							</div>
                          </div>
                        </div>
                        </div>
                    </div>
				<div style="height:500px">
                    <table width="100%" class='table' style='font-size: 10px';>	
						
						<tr>
						  <th colspan="2" bgcolor="#CCCCCC" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">
					      <?php echo "Número da Guia: ".$res; ?></div></th>
		  </tr>
						<tr>
							<th width='48%' scope='col'><div align='left'>Nome do paciente: <br> &nbsp; <?php echo $nome; ?></div></th>
			 
							<th width="52%" scope='col'><div align='left'>Matricula: <br> &nbsp; <?php echo $matricula; ?></div></th>
		              	</tr>
						 <tr>
								<th scope='row'><div align='left'>
							    <div align="left">Data de Emissão: <br> &nbsp; <?php print date("j / n / Y"); ?></div></th>
								<th> <div align="left">Hora: <br> &nbsp; <?php print date("H:i:s"); ?></div></th>
						</tr>
			
						 <tr>
						   <th scope='row'><div align="left">Credenciado: <br> &nbsp; <?php echo	$credenciado;  ?> </div></th>
						   <th scope='col'><div align="left"></div></th>
	      </tr>
					    <tr>
								<th scope='row'><div align='left'>Atendente: <br> &nbsp; <?php echo $_SESSION['login']; ?></div></th>
								<th scope='col'><div align='left' style="color:#FF0000"></div></th>
          </tr>
					    <tr>
					      <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope='row'><div align="center">Dados do internamento </div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Médico solicitante: <br> &nbsp; <?php echo $solicitante; ?></div></th>
					      <th scope='col'><div align="left">CRM: <br> &nbsp; <?php echo $crm; ?></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Código do CID: <br> &nbsp; <?php echo  $cid; ?> </div></th>
					      <th scope='col'><div align="left">Descrição do CID: <br> &nbsp;<?php echo "&nbsp;&nbsp;".$cid_desc; ?></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Diárias: <br> &nbsp; <?php echo $dias; ?></div></th>
					      <th scope='col'><div align="left"></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Data de entrada: <br> &nbsp; <?php print date("j / n / Y \h\s H:i:s" );  ?></div></th>
					      <th scope='col'><div align="left">Previsão de  saída: <br> &nbsp;  <?php echo date('d / m / Y', strtotime($dat_entrada."+".$dias." days"));   ?> </div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Data de Saíde: <br> &nbsp; 
					      	<?php 
					      		
					      			if($dat_saida <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida));	
					      			} 
					      		 
					      	?> </div>
					      </th>
					      <th scope='col'><div align="left"></div> 
					      	<?php
								
								if(!empty($motivo)){

									echo "Motivo da prorogação do internamento: <br> &nbsp;"; 

					      			echo $motivo;
					      		}

					      	?>
					      </th>
				      </tr>
    				</table>
		 		</div>
				        <div align="center">
	        <p>
  <input class='btn btn-primary delete' type="button" value="Voltar" onClick="history.go(-1)">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input class='btn btn-primary delete'  name="button" type="button" onclick="window.print();" value="Imprimir" />
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
			©2017 
			- 
			Instituto de Assistência à Saúde dos Servidores do Estado de Alagoas 
			
			- 
			IPASEAL SAÚDE
			
		</p>
		
			<p>Prédio Sede - Rua Cincinato Pinto, Nº 226, 57020-050, Maceió-AL</p>
                        <p>Centro Clínico - Rua Ladislau Neto, esquina com a Rua Cincinato Pinto, s/nº - Centro</p>
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