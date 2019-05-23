
<?php 

# Corrige o erro de acentuaÃ§Ã£o no banco
mysqli_query($conn,"SET NAMES 'utf8'");


 
   $query = mysqli_query($conn,"SELECT * FROM cid order by cid") or die("erro ao carregar consulta");
                  $i = 1;
                  while($registro = mysqli_fetch_assoc($query)){
                        
                        $id[$i] = $registro["id"];
                        $cid[$i] = $registro["cid"];
                        $descricao[$i] = $registro["descricao"];
                        $dias[$i] = $registro["dias"];
                        $i++; 
                   }
                   
                    
                  ?>
                  <!--FunÃ§Ã£o para autopreenchimento -->
                      <script>
                      function adicionar() {
                          switch (document.getElementById("id_cid").selectedIndex) {

                                  <?php     

                                              for ($x=1; $x < $i ; $x++) {

                                                 echo' case '.$x.':
                                                          document.getElementById("dias").value = "'.$dias[$x].'"
                                                          document.getElementById("cid").value = "'.$cid[$x].'"
                                                          document.getElementById("cid_desc").value = "'.$descricao[$x].'"
                                                          break;
                                                      ';
                                              }
                                  ?>

                                  default:
                                      document.getElementById("dias").value = "";
                                          }
                                      }
                      </script>    


                  <!-- função pegar nome de matricula -->            
                      <script>
                      function pegarMatricula() {

                        var matric = document.getElementById("matricula").value;
                        var int = 1;

                        window.location.href = "verficar_matricula.php?int="+int+"&matric="+matric;

                        //alert("The input value has changed. The new value is: " + matric);
                      }
                      </script>                     
                  
                     <form name="internamento" id="internamento" action ="internacao_cadastro.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <label> </label>
                      <div align="center">
                        </p>
                        <table width="549" border="0" align="center">
                          <tr>
                            <td width="179" >Matr&iacute;cula</td>
                            <td width="360">
                            <input required="required" type="text" name="matricula" minlength="16" class="form-matric" id="matricula" size="20" maxlength="16"placeholder="00000000.000000.00"  onchange="pegarMatricula()" <?php if(isset($_GET['matricula'])){ echo "value=".$_GET['matricula'];} ?> /></td>
                          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Nome</td>
                              <td><input  minlength="4" id="nome" name="nome" readonly="readonly" class="form-control col-md-7 col-xs-12" required="required"  size="60" <?php if(isset($_GET['paciente'])){ echo "value='".$_GET['paciente']."'";} ?> /></td>
                            </tr>
                            <tr>
                            <td class="style3">&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td >Código do C.I.D.</td>
                              <td>
                               <select id="id_cid"  name="id_cid" class="form-control" required="required"  onchange= "adicionar()"> 
                                                            <option value="0">*** Digite ou selecio o CID ***</option> 
                                              <?php 

                                                  for ($x=1; $x < $i ; $x++) { 
                                                      echo '<option value="'.$id[$x].'">'.$cid[$x].'-'.$descricao[$x].'</option>
                                                      ';
                                                                                              
                                                    }
                          



                                               ?>
                                  </select> 

                              </td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td><div align="right"><span class="style1"><a href="https://www.cid10.com.br/" target="_blank"> Consulte aqui o CID <img src="../imagem/busca.png" width="18" height="17" /></a><a href="https://www.cid10.com.br/"></a></span></div></td>
                            </tr>
                            <tr>
                              <td >Dias</td>
                              <td> 
                                <input type="number" id="dias" readonly="readonly" name="dias" required="required" style="font-weight: bold" class="form-control col-md-7 col-xs-12">
                              </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td >Médico solicitante</td>
                            <td><input  type="text" minlength="4"  name="solicitante" class="form-matric" id="solicitante" size="60" required="required"/></td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>
                            <td >CRM</td>
                            <td><input  class="form-matric" minlength="4" name="crm" type="text"id="crm"size="8"maxlength="8" required="required"/></td>
                            </tr>
                            <tr>
                            
                            <td></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <td >Motivo do internamento</td>
                            <td>
                              <textarea class="form-matric" name="motivo"  style="margin: 0px; height: 100px; width: 100%;" form="internamento" placeholder="Entre com o texto aqui..."> </textarea>
                              
                            </td>
                            </tr>
                            <tr>
                            
                            <td></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td><div align="right" class="style3">
                              <div align="right">
                                <strong>
                                  <?php 
                                    
                                    if(isset($_GET['id'])){
                                        $id_pa = $_GET['id'];
                                        echo "<input type='hidden' id='id_pa' name='id_pa' value='".$id_pa."'>";
                                    }else{
                                        $id_pa = false;
                                        echo "<input type='hidden' id='id_pa' name='id_pa' value='".$id_pa."'>";
                                    }


                                  ?>
                                  <input type="hidden" id="cid" name="cid">
                                  <input type="hidden" id="cid_desc" name="cid_desc">

                                <input name="submit" type="Submit" value="Cadastrar" class="btn btn-primary "/> </strong>                              </div>
                            </div></td>
                          </tr>
                        </table>
                      </div>
  
                        <br />
                        <br /> 
                      
                      <div align="center"><br />
                        <br />
                        <br />
                        <br />
                      
                        <br />
                        <br />
                        <br />
                      </div>
                    </form>
                   

             
          
  