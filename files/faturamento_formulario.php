<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
  
  # Corrige o erro de acentuação no banco
	mysqli_query($conn,"SET NAMES 'utf8'");
	
	
	
 
 
   $sql = "SELECT `id`,`nome_fantasia`,`cpf_cnpj`, `codigo`, `telefone`, `celular`, `email`, `endereco`,`numero`,`bairro`,`cep`, `cidade`, `estado` FROM `credenciado` WHERE id = '".$_SESSION["id_credenciado"]."'";

   
     $query = mysqli_query($conn,$sql) or die("erro ao carregar consulta");
  


               while($registro = mysqli_fetch_row($query)){

                                  $id = $registro[0];
                                  $nome_fantasia = $registro[1];
                                  $cpf_cnpj = $registro[2];
                                  $codigo = $registro[3];
                                  $telefone = $registro[4];
                                  $celular = $registro[5];
                                  $email = $registro[6];
                                  $_SESSION["endereco"] = $registro[7];
                                  $_SESSION["numero"] = $registro[8];
                                  $_SESSION["bairro"] = $registro[9];
                                  $_SESSION["cep"] = $registro[10];
                                  $_SESSION["cidade"]= $registro[11];
                                  $_SESSION["estado"]= $registro[12];

                                   
               }
              
  
 ?>


    <!-- Mascara campos -->
    <script src="../js/mascara_campos.js"></script>


<style type="text/css">
<!--
.style3 {font-size: 10px}
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.style8 {font-size: 9px}
-->
</style>
        
            <td width="898" id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
           			  <div>

						   <h1 class="documentFirstHeading">Envio Faturamento </h1>
							    </div>
                    </div>

 
                    <form action="faturamento_relatorio.php" method="POST" class="form-group" enctype="multipart/form-data">

					
                      <div align="center">
					   <div class="form-group">
                         <p>&nbsp;</p>
                              <table width="712"border="0"align="center">
                                <tr>
                                  <td colspan="11">Dados do Credenciado</td>
                                </tr>
                                <tr>
                                  <td colspan="11" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <td width="92"><font>
                                    <span class="style8">Código</span><br />
                                    <input name="codigo" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $codigo;  ?>" size="12" />
                                  </font></td>
                                  <td width="1">&nbsp;</td>
                                  <td colspan="3"><font>
                                    <span class="style8">Credenciado<br />
</span>
                                    <input name="credenciado" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $nome_fantasia; ?>" size="44" />
									<input name="id" id="id"   type="hidden" class="form-matric" style="background:#faffbd;" size="50" value="<?php echo $_SESSION["id"]; ?>" />
                                  </font></td>
                                  
                                  <td width="1">&nbsp;</td>
                                  <td width="172"><font><span class="style8">Competência</span></font><br />
                                  <select name="prod_mes" class="form-control" required="required" >
                                    <option  value="" >... </option>
                                      <option  value="01">Janeiro </option>
                                      <option  value="02">Fevereiro</option>
                                      <option  value="03">Março</option>
                                      <option  value="04">abril</option>
                                      <option  value="05">Maio</option>
                                      <option  value="06">Junho</option>
                                      <option  value="07">Julho</option>
                                      <option  value="08">Agosto</option>
                                      <option  value="09">Setembro</option>
                                      <option  value="10">Outubro</option>
                                      <option  value="11">Novembro</option>
                                      <option  value="12">dezembro</option>
                                    </select></td>
                                
								  <td width="1">&nbsp;</td>
								  <td width="136"><font><span class="style8">.</span></font><br />
								    <select name="prod_ano" class="form-control" required="required" >
                                    <option  value="" > ... </option>
                                    <option  value="2019">2019 </option>
                                    <option  value="2018">2018 </option>
                                  </select></td>
								  
                                </tr>
                                <tr>
                                  <td colspan="11">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="11"><font>
                                 
                                  </font></td>
                                </tr>
                                <tr>
                                  <td><font><span class="style8">CPF / CNPJ<br />
                                  </span>
                                      <input name="cpf_cnpj" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $cpf_cnpj; ?>" size="12" />
                                  </font></td>
                                  <td>&nbsp;</td>
                                  <td width="144"><font><span class="style8">Fone Comercial<br />
                                  </span>
                                      <input name="telefone" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $telefone; ?>" size="18" />
                                  </font></td>
                                  <td width="1">&nbsp;</td>
                                  <td width="126"><font><span class="style8">Celular</span><br />
                                      <input name="celular" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $celular; ?>" size="18" />
                                  </font></td>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><font><span class="style8"><font><font>E-mail<br />
                                  </font>
                                          <input name="email" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $email; ?>" size="30" />
                                  </font></span></font></td>
          
                                </tr>
						 </table>

							  <p>&nbsp;</p>
							  <table width="712"border="0"align="center">
                                <tr>
                                  <td width="218">Consultas</td>
                                  <td width="135"><div align="right"><span class="style8">Quantidade</span></div></td>
                                  <td width="72">&nbsp;</td>
                                  <td colspan="2"><span class="style8">Faturado</span></td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><span class="style5">Eletivas</span></td>
                                  <td width="135">
                                    <div align="right">
                                      <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_eletivas" id="qtd_eletivas"   size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td width="145">
                                    <input  class="form-control form-control-sm" type="text" name="val_eletivas" id="val_eletivas" size="20" onblur="calcular()"/>                                  </td>
                                  <td width="120">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><span class="style5">Emergências</span></td>
                                  <td width="135"><div align="right">
                                    <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_emergencias" id="qtd_emergencias"  size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="val_emergencias" id="val_emergencias" size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><span class="style5">Visita Hospitalar<br />
                                  <br />
                                  </span></td>
                                  <td width="135"><div align="right">
                                    <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_visitas" id="qtd_visitas"   size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="val_visitas" id="val_visitas"   size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">Exames / Raio X </td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><div align="right">
                                      <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_raix" id="qtd_raix"   size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="val_raix" id="val_raix"  size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">Exames prévios </td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><div align="right">
                                      <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_previos" id="qtd_previos"  size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="val_previos" id="val_previos" size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">Procedimentos</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><div align="right">
                                      <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_procedimento" id="qtd_procedimento"   size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="val_procedimento" id="val_procedimento" size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">Pronto Atendimento - <span class="style3">P.A.</span> </td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><div align="right">
                                      <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_pa" id="qtd_pa"   size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="val_pa" id="val_pa"  size="20" onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">Auditoria</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><div align="right">
                                      <input style="text-align:right" class="form-control form-control-sm" type="text" name="qtd_auditoria" size="20" id="qtd_auditoria"  onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" size="20" name="val_auditoria" id="val_auditoria"  onblur="calcular()"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2"><div align="right"></div></td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><div align="right"><span class="style8">Quantidade</span></div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left"><span class="style8">Faturado</span></div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><strong>Total R$</strong></td>
                                  <td><div align="right">
                                    <input style="text-align:right; background:#faffbd" class="form-matric" type="text" name="quantidade" id="quantidade"  size="20" readonly/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                    <input class="form-matric" style="background:#faffbd;" type="text" name="valor" id="valor"  size="20" required="required" readonly />
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">Arquivos</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <td colspan="5"><div align="right">
                                    <p align="center"><input type="file" name="arquivo[]" /></p>
									<p align="center"><input type="file" name="arquivo[]" /></p>
									<p align="center"><input type="file" name="arquivo[]" /></p>
									<p align="center"><input type="file" name="arquivo[]" /></p>
									<p align="center"><input type="file" name="arquivo[]" /></p>
                                  </div></td>
                                </tr>
                                
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="4"></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="4"><div align="right">
                                      <input class="btn btn-primary delete" type="submit" value="Cadastrar" id="entrar" name="entrar">
                                  </div></td>
                                </tr>
                        </table>
						      <table width="349"border="0"align="center">
                                <tr>
                                  <td>&nbsp;</td>
                                  <td width="137">&nbsp;</td>
                                  <td width="20">&nbsp;</td>
                                  <td width="96">&nbsp;</td>
                                </tr>
                              </table>
					   </div>
                      </div>
                      </form>
                    <p><br />
		            </p>
                     <div class="x"></div>
			<div id="feature"></div>
  </div>		
<!-- Conteudo -->
					
			       
					
					
					
					
<!--/ Coonteudo -->                      
                      </p>
              </div>
           
          </tr>
        </tbody>
    </table>

</div>
  
  
 <?php
 
 	  include "rodape.php";
 ?>     