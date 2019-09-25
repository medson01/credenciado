<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
	

 ?>
 
<style type="text/css">
<!--
.style3 {font-size: 10px}
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

 
                    <form action ="faturamento_envio.php"method="post"class="form-group" enctype="multipart/form-data">
                      <div align="center">
                              <p><br />
                              </p>
                              <table width="572"border="0"align="center">
                                <tr>
                                  <td width="250"><font>Credenciado</font> </td>
                                  <td colspan="3"><div align="left">
                                      <input class="form-matric" style="background:#faffbd;" type="text" size="50" value="<?php echo $_SESSION["credenciado"]; ?>" />
									  <input class="form-matric" style="background:#faffbd;" type="hidden" name="id" id="id" size="50" value="<?php echo $_SESSION["id"]; ?>" />
                                  </div></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><div align="right"></div></td>
                                </tr>
                                <tr>
                                  <td>Produção</td>
                                  <td width="96"><div align="left">
                                      <span class="style3">Mês</span> 
                                      <br />
                                      <select name="prod_mes" class="form-control" required="required" style="background:#faffbd;">
									<option  value="" > ... </option>
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
								  </select>
                                  </div></td>
                                  <td width="114">&nbsp;</td>
                                  <td width="94"><span class="style3">Ano<br />
                                  </span>
                                    <select name="prod_ano" class="form-control" required="required" style="background:#faffbd;">
                                    <option  value="" > ... </option>
                                    <option  value="2019">2019 </option>
                                    <option  value="2018">2018 </option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><p>Quantidade de lotes </p></td>
                                  <td colspan="3"><input class="form-matric" style="background:#faffbd;" type="text" name="qtd_lote" id="qtd_lote"  maxlength="3" required="required" size="16" />								  </td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>Total R$ </td>
                                  <td colspan="3"><input class="form-matric" type="text" style="background:#faffbd;" name="valor" id="valor"  size="16" required="required" /></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>Enviar arquivo de produção </td>
                                  <td colspan="3"><div align="right">
                                    <input name="fileUpload" type="file"   />
                                  </div></td>
                                </tr>
                                
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3"></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><div align="right">
                                      <input class="btn btn-primary delete" type="submit" value="Cadastrar" id="entrar" name="entrar">
                                  </div></td>
                                </tr>
                        </table>

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