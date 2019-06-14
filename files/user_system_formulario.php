        
<?php 


             # Corrige o erro de acentuação no banco
        // mysqli_query($conn,"SET NAMES 'utf8'");
    
   

      $sql = mysqli_query($conn,"SELECT id, nome FROM credenciado") or die("erro ao carregar os usuários");
      

    
                  
 ?>

       <!-- Formulario -->
      
    <form action ="user_system_cadastrar.php"method="post"class="form-group">
           
        <div align="center">             
          <div>
              <div class="panel panel-default">
                  <div class="panel-heading">
                          <p>&nbsp;</p>
                          <table border="0"align="center">
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
                                  <option  value="medico">Médico</option>
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
                </select>               </td>
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
          
          
          
       <table class="table table-striped" align="center">
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
                  <td><div align='center'>".utf8_encode($registro["credenciado"])."</div></td>
                
                                    <td><div align='center'><a class='btn btn-primary delete' href=user_system_deletar.php?id=".$registro["id"].">Excluir</a></div></td>
                                  </tr>";
                   }

                 
              ?>              
            
        </table>
        
        <!--/ Formulario --> 		       
					
					
					
					
 