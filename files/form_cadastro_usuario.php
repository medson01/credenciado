        
<?php 

      include 'cabecalho.php';

             # Corrige o erro de acentuação no banco
         mysqli_query($conn,"SET NAMES 'utf8'");
	  
	 

      $sql = mysqli_query($conn,"SELECT id, nome FROM credenciado") or die("erro ao carregar os usuários");
      

	  
                  
 ?>

<!-- Conteudo -->
	       
            <td width="898" id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading">Cadastro de usuários </h1>
                     			
								</div>
                    </div>

 
                    <p><br />
					</p>

         <!-- Formulario -->
					<div>
					  <form action ="cadastro.php"method="post"class="form-group">
           
        <div align="center">             
          <div>
              <div class="panel panel-default">
                  <div class="panel-heading">
                          <p>&nbsp;</p>
                          <table width="460"border="0"align="center">
                            <tr>
                              <td width="77"><font>Nome&nbsp;</font></td>
                              <td width="36">&nbsp;</td>
                              <td width="385">
                                <div align="left">
                                  <input name="nome" type="text" class="form-matric" id="nome" style="background:#faffbd;" size="60" required="required" />
                              </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Perfil</td>
                              <td>&nbsp;</td>
                              <td><select class="form-matric" style="background:#faffbd;" id="perfil" name="perfil" required="required">
                                  <option  value="administrador">Administrador</option>
                                  <option  value="auditor">Auditor</option>
                                  <option  value="usuario">Usuario</option>
								  <option  value="faturamento">Faturamento</option>
                              </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Login&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>
                                <div align="left">
                                  <input class="form-matric" style="background:#faffbd;" type="text" name="login" id="login"  required="required" />
                                </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Senha&nbsp;</td>
                              <td><p>&nbsp;</p>                              </td>
                              <td><input class="form-matric" style="background:#faffbd;" type="password" name="senha" id="senha"  required="required" /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Empresa</td>
                              <td>&nbsp;</td>
                              <td>
							  
							  <select class="form-matric" style="background:#faffbd;" id="empresa" name="empresa" required="required">
                                <option  value="...">...</option>
                                <?php
								
								while($registro = mysqli_fetch_row($sql)){
									echo "<option  value=".$registro[0].">".utf8_encode($registro[1])."</option>";        
                   				}
								
								?>
							  </select>							  </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><div align="right">
                                <input class="btn btn-primary delete" type="submit" value="Cadastrar" id="entrar" name="entrar"  />
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
					
					
					
		   <table class="table table-striped" width="709" align="center">
               <tr>
                 <td colspan="5" style="text-align: center; text-decoration-style: solid;"> <strong>Usuários cadastrados</strong></td>
               </tr>
               <tr>
                  <td width="236"><div align="center">Nome</div></td>
                  <td width="257"><div align="center">Login</div></td>
                  <td width="202"><div align="center">Perfil</div></td><br />
 				  <td width="202"><div align="center">Empresa</div></td>
                  <td width="202"><div align="center"></div></td>
               </tr>
                         		
              <?php

                  $verifica = mysqli_query($conn,"SELECT (usuarios.id) as id, (usuarios.nome) as nome, (usuarios.login) as login, (usuarios.perfil) as perfil, (credenciado.nome) as credenciado FROM usuarios INNER JOIN credenciado ON credenciado.id = usuarios.id_credenciado") or die("erro ao carregar os usuários");
                  
                  while($registro = mysqli_fetch_assoc($verifica)){
                         print "  <tr>
                                    <td><div align='center'>".$registro["nome"]."</div></td>
                                    <td><div align='center'>".$registro["login"]."</div></td>
                                    <td><div align='center'>".$registro["perfil"]."</div></td>
									<td><div align='center'>".$registro["credenciado"]."</div></td>
								
                                    <td><div align='center'><a class='btn btn-primary delete' href=deleta_inscricoes.php?id=".$registro["id"].">Excluir</a></div></td>
                                  </tr>";
                   }

                  mysqli_close($conn);   
              ?>              
   					
  			</table>
        
        <!--/ Formulario --> 
                    <div class="x"></div>
			<div id="feature"></div>
  </div>		
					
              </p>
              </div>
                

              
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