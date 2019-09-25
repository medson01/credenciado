        
<?php 

      include 'cabecalho.php';

                  $query1 = mysqli_query($conn,"SELECT * FROM usuarios order by nome") or die("erro ao carregar os usuários");
                  $query2 = mysqli_query($conn,"SELECT avisos.id, avisos.titulo, avisos.conteudo, usuarios.login FROM `avisos` INNER JOIN usuarios ON usuarios.id = avisos.id_usuarios") or die("erro ao carregar os usuários");

                  
                  $z = 0;
                  while($row = mysqli_fetch_assoc($query2)){
                        
                          $id[$z] = $row["id"];
                          $titulo[$z] = $row["titulo"];
                          $conteudo[$z] = $row["conteudo"];
                          $login2[$z] = $row["login"];

                          $z++;
                   }

  

                  $i = 0;
                  while($registro = mysqli_fetch_assoc($query1)){
                        
                          $login1[$i] = $registro["login"];
                          $id_usuarios[$i] = $registro["id"];
                          $i++;
                   }        





                  mysqli_close($conn);   
              
 ?>

<!-- Conteudo -->
	       
            <td width="898" id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading">Cadastro de aviso </h1>
                     			
								</div>
                    </div>

 
                    <p><br />
					</p>

         <!-- Formulario -->
					<div>
					  <form action ="cadastroAviso.php"method="post"class="form-group">
           
        <div align="center">             
          <div>
              <div class="panel panel-default">
                  <div class="panel-heading">
                          <p>&nbsp;</p>
                          <table width="400"border="0"align="center">
                            <tr>
                              <td>Login</td>
                              <td>
                                <select class="form-matric" style="background:#faffbd;" id="login" name="id" required="required" style="width:100%" style="background:#faffbd;">
                                      
                                  <?php 
                                     for ($x=0; $x <= $i; $x++) { 
                                        echo "
                                            <option  value=".$id_usuarios[$x].">".$login1[$x]."</option>
                                            
                                        ";
                                     }

                                  ?>
                              </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Título</td>
                              <td><input type="text" class="form-matric" style="background:#faffbd;"name="titulo" id="titulo" /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>
                                Aviso:
                                  <textarea rows="4" style="background:#faffbd;"cols="50" name="conteudo" placeholder="Digite o texto aqui..."> 
                                  </textarea>                              </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><div align="right">
                                <input style="background:#CCCCCC; font-weight: bold; height: 35px; width:90px;" class="btn btn-default"type="submit" value="Cadastrar" id="entrar" name="entrar"  />
                              </div></td>
                            </tr>
                          </table>
                </div>  
              </div>
                          <br />
          </div>
         </div>
                        </fieldset>
                      </div>
          </form>
				  </div>

        <!--/ Formulario --> 
                    <div class="x"></div>
			<div id="feature"></div>
  </div>		
					
              </p>
              </div>

       <!-- Tabela de avisos -->         
           <table class="table table-striped" width="709" align="center">
               <tr>
                 <td colspan="4" style="text-align: center; text-decoration-style: solid;"> <strong>Avisos cadastrados</strong></td>
               </tr>
               <tr>
                  <td width="257"><div align="center">Login</div></td>
                  <td width="202"><div align="center">Titulo</div></td>
                  <td width="202"><div align="center">Aviso</div></td>
               </tr>
                            
              <?php

                  
                  
                  for ($i=0; $i < $z; $i++) { 
                
                         print "  <tr>
                                    <td><div align='center'>".$login2[$i]."</div></td>
                                    <td><div align='center'>".$titulo[$i]."</div></td>
                                    <td><div align='center'>".$conteudo[$i]."</div></td>
                                    <td><div align='center'><a class='btn btn-primary delete' href=deleta_aviso.php?id=".$id[$i].">Excluir</a></div></td>
                                  </tr>";
                   }

                   
              ?>              
            
        </table>     


              
            <td width="6" id="portal-column-two">&nbsp;</td>
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
			<img src="../imagem/telefone.gif" alt="Telefone" width="28" height="25">
			Telefone: 
			0800-082-8182 
			
			
			<img src="../imagem/email.gif" alt="E-mail" width="28" height="25">
			ascom@ipaseal.al.gov.br		</div>
	</div>
	<div id="itec"></div>
	<div class="visualClear"></div>
</div>


      

      <div class="visualClear"><!-- --></div>
    </div>
<div id="kss-spinner"></div>



<div id="fancy_overlay"></div><div id="fancy_wrap"><div class="fancy_loading" id="fancy_loading"><div></div></div><div id="fancy_outer"><div id="fancy_inner"><div id="fancy_close"></div><div id="fancy_bg"><div class="fancy_bg fancy_bg_n"></div><div class="fancy_bg fancy_bg_ne"></div><div class="fancy_bg fancy_bg_e"></div><div class="fancy_bg fancy_bg_se"></div><div class="fancy_bg fancy_bg_s"></div><div class="fancy_bg fancy_bg_sw"></div><div class="fancy_bg fancy_bg_w"></div><div class="fancy_bg fancy_bg_nw"></div></div><a href="javascript:;" id="fancy_left"><span class="fancy_ico" id="fancy_left_ico"></span></a><a href="javascript:;" id="fancy_right"><span class="fancy_ico" id="fancy_right_ico"></span></a><div id="fancy_content"></div><div id="fancy_title"></div>
</div></div></div><div id="fancy_overlay"></div><div id="fancy_wrap"><div class="fancy_loading" id="fancy_loading"><div></div></div><div id="fancy_outer"><div id="fancy_inner"><div id="fancy_close"></div><div id="fancy_bg"><div class="fancy_bg fancy_bg_n"></div><div class="fancy_bg fancy_bg_ne"></div><div class="fancy_bg fancy_bg_e"></div><div class="fancy_bg fancy_bg_se"></div><div class="fancy_bg fancy_bg_s"></div><div class="fancy_bg fancy_bg_sw"></div><div class="fancy_bg fancy_bg_w"></div><div class="fancy_bg fancy_bg_nw"></div></div><a href="javascript:;" id="fancy_left"><span class="fancy_ico" id="fancy_left_ico"></span></a><a href="javascript:;" id="fancy_right"><span class="fancy_ico" id="fancy_right_ico"></span></a><div id="fancy_content"></div><div id="fancy_title"></div></div></div></div>

<!-- java script bootstrap-->
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

</body></html>