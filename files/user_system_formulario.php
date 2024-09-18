        
<?php 


             # Corrige o erro de acentuação no banco
        // mysqli_query($conn,"SET NAMES 'utf8'");
    
   

      $sql = mysqli_query($conn,"SELECT id, nome FROM credenciado") or die("erro ao carregar os usuários");
      

    
                  
 ?>

       <!-- Formulario -->
       <style type="text/css">
<!--
.style1 {font-size: 10px}
-->
       </style>
       
      
    <form action ="user_system_cadastrar.php"method="post"class="form-group">
           
        <div align="center">             
          <div>
              <div class="panel panel-default">
                  <div class="panel-heading">
                          <p>&nbsp;</p>
                          <table border="0"align="center">
                            <tr>
                              <td width="125"><font>Nome&nbsp;</font></td>
                              <td width="10">&nbsp;</td>
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
                              <td width="125"><font>Sobre nome Nome&nbsp;</font></td>
                              <td width="10">&nbsp;</td>
                              <td width="385">
                                <div align="left">
                                  <input name="sobre_nome" type="text" class="form-matric" id="sobre_nome" style="background:#faffbd;" size="60" required="required" />
                              </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Cpf</td>
                              <td>&nbsp;</td>
                              <td><input class="form-matric" style="background:#faffbd;" type="text" name="login" id="cpf"  required="required" size="60"/></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Perfil</td>
                              <td>&nbsp;</td>
                              <td><select class="form-matric" style="background:#faffbd; width:100%;" id="perfil" name="perfil" required="required" >
                                  <option  value="administrador">Administrador </option>
								  <option  value="auditor">Auditor </option>
								  <option  value="alimentacao">Alimentação </option>
								  <option  value="callcenter">Callcenter</option>
                                  <option  value="clinica">Clinica</option>
								  <option  value="clin_lab">Clínica e Laboratório </option> 
								  <option  value="faturamento">Faturamento </option>
								  <option  value="internacao">Internação </option>
								  <option  value="laboratorio">Laboratório </option>		  
                                  <option  value="medico">Médico </option>
								  <option  value="pa">Pronto Atendimento </option>                                   
                                  <option  value="usuario">Usuario </option>
                                 
                                  <option  value="aut_internacao">Autorização internacao</option>

                              </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Senha&nbsp;</td>
                              <td><p>&nbsp;</p>                              </td>
                              <td><input class="form-matric" style="background:#faffbd;" type="password" name="senha"  required="required" size="60px"/></td>
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
                
                <select class="form-matric" style="background:#faffbd; width:100%;" id="empresa" name="empresa" required="required">
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
                 <td colspan="6" style="text-align: center; text-decoration-style: solid;"> <strong>Usuários cadastrados</strong></td>
               </tr>
               <tr>
                  <td width="236"><div align="center">Nome</div></td>
                  <td width="257"><div align="center">Login</div></td>
                  <td width="202"><div align="center">Perfil</div></td><br />
                  <td width="202"><div align="center">Empresa</div></td>
                  <td width="202"><div align="center">Último Logon</div></td>
                  <td width="202"><div align="center"></div></td>
               </tr>
                            
              <?php

                  $verifica = mysqli_query($conn,"SELECT (usuarios.id) as id, (usuarios.nome) as nome, (usuarios.login) as login, (usuarios.perfil) as perfil, (credenciado.nome) as credenciado, (usuarios.ultimo_logon) as ultimo_logon FROM usuarios INNER JOIN credenciado ON credenciado.id = usuarios.id_credenciado order by  credenciado, perfil, usuarios.nome") or die("erro ao carregar os usuários");
                  
                  while($registro = mysqli_fetch_assoc($verifica)){
                         print "  <tr>
                                    <td><div align='center'>".utf8_decode($registro["nome"])."</div></td>
                                    <td><div align='center'>".$registro["login"]."</div></td>
                                    <td><div align='center'>".$registro["perfil"]."</div></td>
                  <td><div align='center'>".$registro["credenciado"]."</div></td>
                                    <td style='font-size: 10px;'><div align='center'>";

                                    if($registro["ultimo_logon"] == "0000-00-00 00:00:00"){
                                       echo ""; 
                                    }else{
                                     
                                       echo date("d/m/Y <\b\\r> H:i:s",strtotime($registro["ultimo_logon"]));
                                    }

                                     echo "</div></td>
                                    <td><div align='center'><a class='btn btn-primary delete  btn-xs' href=user_system_deletar.php?id=".$registro["id"].">Excluir</a></div></td>
                                  </tr>";
                   }

                 
              ?>              
            
        </table>
        
        <!--/ Formulario --> 		       
					
					
					
					
 