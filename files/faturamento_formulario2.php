<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
	

 ?>
 
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
   									 <p class="documentFirstHeading">&nbsp;</p>
                      			</div>
                    </div>

 
                    <form action="faturamento_envio.php" method="post" class="form-group" enctype="multipart/form-data">
                      <div align="center">
					   <div class="form-group">
                         <p>&nbsp;</p>
                              <table width="712"border="0"align="center">
                                <tr>
                                  <td colspan="7">Dados do Credenciado</td>
                                </tr>
                                <tr>
                                  <td colspan="7" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                
                                <tr>
                                  <td width="80"><font>
                                    <span class="style8">Código</span><br />
                                    <input name="text22" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $_SESSION["credenciado"]; ?>" size="10" />
                                  </font></td>
                                  <td width="1">&nbsp;</td>
                                  <td width="344"><font>
                                    <span class="style8">Credenciado<br />
</span>
                                    <input name="text2" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $_SESSION["credenciado"]; ?>" size="43" />
                                  </font></td>
                                  
                                  <td width="1">&nbsp;</td>
                                  <td width="149"><font><span class="style8">Competência</span></font><br />
                                  <select name="prod_ano" class="form-control" required="required" >
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
								  <td width="106"><span class="style8">.</span><br />
								    <select name="prod_ano" class="form-control" required="required" >
								    <option  value="" > ... </option>
								    <option  value="2019">2019 </option>
								    <option  value="2018">2018 </option>
								    </select>							      </td>
                                </tr>
                                <tr>
                                  <td colspan="7">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="7"><font>
                                    <input class="form-matric" style="background:#faffbd;" readonly="true" type="hidden" name="id2" id="id2" size="50" value="<?php echo $_SESSION["id"]; ?>" />
                                  </font></td>
                                </tr>
						 </table>
							  <table width="712"border="0"align="center">
                                <tr>
                                  <td width="72"><font> <span class="style8">CPF / CNPJ<br />
                                    </span>
                                        <input name="text222" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $_SESSION["credenciado"]; ?>" size="12" />
                                  </font></td>
                                  <td width="2">&nbsp;</td>
                                  <td width="82"><font> <span class="style8">Fone Comercial<br />
                                    </span>
                                        <input name="text23" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $_SESSION["credenciado"]; ?>" size="12" />
                                  </font></td>
                                  <td width="2">&nbsp;</td>
                                  <td width="76"><font> <span class="style8">Celular</span><br />
                                        <input name="text243" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $_SESSION["credenciado"]; ?>" size="12" />
                                  </font></td>
                                  <td width="1">&nbsp;</td>
                                  <td width="402"><font><span class="style8"><font> 
                                    E-mail<br />
                                  <input name="text2422" type="text" class="form-matric" style="background:#faffbd;" readonly="true" value="<?php echo $_SESSION["credenciado"]; ?>" size="32" />
                                  <br />
                                  </font></span></font></td>
                                 

                         </table>
							  <p>&nbsp;</p>
							  <table width="712"border="0"align="center">
                                <tr>
                                  <td width="270">Consultas</td>
                                  <td width="120"><div align="right"><span class="style8">Quantidade</span></div></td>
                                  <td width="80">&nbsp;</td>
                                  <td colspan="2"><span class="style8">Faturado</span></td>
                                </tr>
                                <tr>
                                  <td colspan="5" style="border-top:ridge">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><span class="style5">Eletivas</span></td>
                                  <td width="120"><div align="right">
                                    <input class="form-control form-control-sm" type="text" name="qtd_lote22" id="qtd_lote22"  maxlength="3"  size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td width="73"><div align="left">
                                    <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
                                  </div></td>
                                  <td width="147">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><span class="style5">Emergências</span></td>
                                  <td width="120"><div align="right">
                                    <input class="form-control form-control-sm" type="text" name="qtd_lote222" id="qtd_lote222"  maxlength="3"  size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
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
                                  <td width="120"><div align="right">
                                    <input class="form-control form-control-sm" type="text" name="qtd_lote2223" id="qtd_lote2223"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
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
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote22" id="qtd_lote22"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
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
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote22" id="qtd_lote22"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
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
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote22" id="qtd_lote22"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
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
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote22" id="qtd_lote22"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
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
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote2" id="qtd_lote2"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left">
                                      <input class="form-control form-control-sm" type="text" name="qtd_lote223" id="qtd_lote223"  maxlength="3" size="10" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="2"><div align="right"><span class="style8">Quantidade</span></div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="right"><span class="style8">Faturado</span></div></td>
                                </tr>
                                <tr>
                                  <td><strong>Total R$ </strong></td>
                                  <td colspan="2"><div align="right">
                                    <input class="form-matric" type="text" style="background:#faffbd;" name="valor2" id="valor2"  size="16" required="required" />
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><input class="form-matric" type="text" style="background:#faffbd;" name="valor" id="valor"  size="16" required="required" /></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
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