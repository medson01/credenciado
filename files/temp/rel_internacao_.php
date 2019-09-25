<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
  
 




 ?>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-style: italic;
}
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
                    <p>&nbsp;</p>
                    <p><br />
                    </p>
                    <!--  Conteudo -->	
  
		<table width="100%" class='table' style='font-size: 12px';>	
						<tr>
						  <th colspan="2" scope='col' style="font-weight:bold; font-size:14px;"><?php echo "Número da Guia: ".$res;?></th>
		  </tr>
						<tr>
							<th width='70%' scope='col'><div align='left'>Nome do paciente:&nbsp; <?php echo $nome; ?></div></th>
			 
							<th scope='col'><div align='left'>Matricula: &nbsp; <?php echo $matricula; ?>"</div></th>
		              	</tr>
						 <tr>
								<th scope='row'><div align='left'>
							    <div align="left">Médico s olicitante:&nbsp; <?php echo $solicitante; ?></div></th>
								<th> <div align="left">CRM: <?php echo $crm; ?></div></th>
						</tr>
			
						 <tr>
						   <th scope='row'><div align="left">Data de Emissão:&nbsp;<?php print date("j / n / Y"); ?></div></th>
						   <th scope='col'><div align="left">Hora: <?php print date("H:i:s"); ?></div></th>
	      </tr>
					    <tr>
								<th scope='row'><div align='left'>Dias: </div></th>
								<th scope='col'><div align='left' style="color:#FF0000"><?php echo $dias; ?> </div></th>
          </tr>
    </table>
		 
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