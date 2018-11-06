
		<?php 

     
                  $query = mysqli_query($conn,"SELECT * FROM usuarios order by nome") or die("erro ao carregar os usuários");
                 

                  $i = 0;
                  while($registro = mysqli_fetch_assoc($query)){
                        
                          $login1[$i] = $registro["login"];
                          $id_usuarios[$i] = $registro["id"];
                          $i++;
                   }        





                  
              
 ?>
    <form action ="aviso_cadastro.php"method="post"class="form-group">
           
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
                       
                      </div>
          </form>
				

        