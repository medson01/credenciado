<?php 
	
	//Arquivo de configuração
	include "cabecalho.php";

	

  


	$query = mysqli_query($conn,"SELECT avisos.titulo, avisos.conteudo, MAX(data) as data FROM avisos INNER JOIN usuarios ON usuarios.id = avisos.id_usuarios WHERE usuarios.id = ".$_SESSION['id']."") or die("erro ao carregar os usuários");
                  

                  $z = 0;
                  while($row = mysqli_fetch_assoc($query)){
                        
                         $titulo = $row["titulo"];
                         $conteudo = $row["conteudo"];
                         $data = $row["data"];


                          $z++;
                   }
                   

 ?>
    <!-- Conteudo -->        
            
            <td width="898" id="portal-column-content"> <!-- tag conteudo -->

              
              <div>
                  	<div id="region-content" class="documentContent">
                    

	                    <p align="center"><strong><img src="../imagem/inicial.jpg" width="762" height="312" /></strong><br />
				          <br />
						</p>
                    
						<div class="x"></div>
						<div id="feature"></div>
  				    </div>		
                      
                      <center>
                        <img src="../imagem/avisos.jpg" width="91" height="71" border="0" />
                      </center>
					  <p>
					  
					  <div align="center">
	                        <span class="titulo" align="center">
										<p>					  
							<!-- Titulo do aviso -->								  
															  <?php
																	echo $titulo;							  
															  
															  ?>
							<!--/ Titulo do aviso -->
										</p>
                       		</span>
	                      
	</div>					  
					  
                      <div>
                        <div align="center"><span align="center" class="conteudo">
                          
                          
                            <!-- Titulo do aviso -->								  
                          <?php
																	echo $conteudo;							  
															  
															  ?>
                            <!--/ Titulo do aviso -->
                          
                        </span>
                        </div>
                        <div align="right"></div>
						
						 </p>
                        <div align="right">
                         <font size="1px">
                          <?php 
								echo "Puplicado em ".date("d/m/Y", strtotime($data));

						  ?>
                         </font>  
                                </div>
                </div>
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
			<a id="iframe" href="http://www.ipasealsaude.al.gov.br/mapa">Ver localizaÃ§Ã£o no mapa</a> 
			<script type="text/javascript">
				jq(document).ready(function() {
					jq("a#iframe").fancybox();
				})
			</script>
		
		<div id="contato">
			<img alt="Telefone" src="../imagem/telefone.gif">
			Telefone: 
			0800-082-8182 
			
			
			<img alt="E-mail" src="../imagem/email.gif">
			ascom@ipaseal.al.gov.br
			
		</div>
	</div>
	<div id="itec"></div>
	<div class="visualClear"></div>
</div>

     

      <div class="visualClear"><!-- --></div>
    </div>
<div id="kss-spinner"></div>



<div id="fancy_overlay"></div><div id="fancy_wrap"><div class="fancy_loading" id="fancy_loading"><div></div></div><div id="fancy_outer"><div id="fancy_inner"><div id="fancy_close"></div><div id="fancy_bg"><div class="fancy_bg fancy_bg_n"></div><div class="fancy_bg fancy_bg_ne"></div><div class="fancy_bg fancy_bg_e"></div><div class="fancy_bg fancy_bg_se"></div><div class="fancy_bg fancy_bg_s"></div><div class="fancy_bg fancy_bg_sw"></div><div class="fancy_bg fancy_bg_w"></div><div class="fancy_bg fancy_bg_nw"></div></div><a href="javascript:;" id="fancy_left"><span class="fancy_ico" id="fancy_left_ico"></span></a><a href="javascript:;" id="fancy_right"><span class="fancy_ico" id="fancy_right_ico"></span></a><div id="fancy_content"></div><div id="fancy_title"><table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="fancy_title" id="fancy_title_left"></td><td class="fancy_title" id="fancy_title_main"><div></div></td><td class="fancy_title" id="fancy_title_right"></td></tr></tbody></table><table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="fancy_title" id="fancy_title_left"></td><td class="fancy_title" id="fancy_title_main"><div></div></td><td class="fancy_title" id="fancy_title_right"></td></tr></tbody></table></div></div></div></div><div id="fancy_overlay"></div><div id="fancy_wrap"><div class="fancy_loading" id="fancy_loading"><div></div></div><div id="fancy_outer"><div id="fancy_inner"><div id="fancy_close"></div><div id="fancy_bg"><div class="fancy_bg fancy_bg_n"></div><div class="fancy_bg fancy_bg_ne"></div><div class="fancy_bg fancy_bg_e"></div><div class="fancy_bg fancy_bg_se"></div><div class="fancy_bg fancy_bg_s"></div><div class="fancy_bg fancy_bg_sw"></div><div class="fancy_bg fancy_bg_w"></div><div class="fancy_bg fancy_bg_nw"></div></div><a href="javascript:;" id="fancy_left"><span class="fancy_ico" id="fancy_left_ico"></span></a><a href="javascript:;" id="fancy_right"><span class="fancy_ico" id="fancy_right_ico"></span></a><div id="fancy_content"></div><div id="fancy_title"></div></div></div></div>

<!-- java script bootstrap-->
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

</body></html>