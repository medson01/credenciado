
<style type="text/css">
<!--
.style3 {color: #000000}
.style5 {color: #000000; font-weight: bold; }
.style13 {font-size: 10px}
-->
                     </style>
                     <label> </label>
                      <div align="center">
					  
		   	<?php  
              if(!((isset($status)) && ($status == 2) )){
          
                   echo '<form name="prorrogacao" id="prorrogacao" action ="';  
                        if(!isset($medico_pro)){ 
                                 echo 'internacao_prorrogacao_cadastro.php'; }
                        else{ 
                                 echo 'internacao_prorrogacao_update.php'; 
                            } 
                                 echo '" method="post" data-parsley-validate class="form-horizontal form-label-left">';
					    }

				?>				
   		  
        <table width="100% " border="0" align="center">
                          
                            <tr>
                              <td colspan="3" bordercolor="#999999" bgcolor="#999999">
                                <div align="center" class="style5"> 
                              <div align="center">Dados da Solicitação de Prorrogação                              </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td ><span class="style13">Médico solicitante </span><br />
                              <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_pro)) { echo "value='".$medico_pro."' "; }   if(isset($desativar)){ echo $desativar;} ?> />

                              </span></td>
                            <td>&nbsp;</td>
                            <td><span class="style13">CRM </span><br />
                              <input name="crm" id ="crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($crm_pro)) { echo "value='".$crm_pro."' "; }  if(isset($desativar)){ echo $desativar;} ?>/>

                              </span></td>
                            </tr>
                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">
            Dias solicitados

                                   </span><br />

                        <select id='select' name='dias' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?>  >
							  	
                              <?php
                  								
                  								if(isset($dias_pro) ){ 
                                      echo "<option value='".$dias_pro."' >".$dias_pro."</option>"; 
                                  }else{
                                    for ($i=1; $i <= 3; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                  }

                                }
								               ?>
                        </select>                              </td>
                              <td>                              </td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" ><span class="style13">Justificativa da prorrogação
                                <textarea id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" placeholder="Entre com o texto aqui..." <?php if(isset($desativar)){ echo $desativar; } ?> />

                                        <?php
                                        if(isset($motivo_pro)){
                                          echo $motivo_pro;
                                        }
                                        ?>
                                          
                                        </textarea>
                              </span></td>
                          </tr>
                        <tr>
                          <td colspan="3" >                              </td>
          </tr>
                        <tr>
                          <td colspan="3" style="border-top:ridge">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
						  <td>&nbsp;</td>
                        </tr>
                        
       </table>

       <table width="100% " border="0" align="center" style="<?php if(isset($exibir)){ echo $exibir; }?>" >
                <!-- autorização do médico -->
                      <!-- Cabeçalho de autorização médica-->
                        <tr>
                          <td colspan="3" bordercolor="#999999" bgcolor="#999999">
                          <div align="center">Autorização Médica </div>                          </td>
                        </tr>
                        <tr>
                          <td width="49%">&nbsp;</td>
                          <td width="3%">&nbsp;</td>
                          <td width="48%">&nbsp;</td>
                        </tr>
                        <tr>  
                         <td>  
                             <span  id="t1"  class="style13"> Dias autorizados</span>
                                            <input name= 'dias_autorizados'  id ='dias_autorizados' type='text' class='form-control input-sm p' style='font-size: 10px; ' size='44'  />						  </td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
                        <tr>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
						 <td>&nbsp;</td>
                        </tr>           
                        <tr>
                         <td colspan="3" >
                             <span class="style13">Justificativa do médico</span>
                                <textarea id="motivo_medico" class="form-control input-sm" name="motivo_medico"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" placeholder="Entre com o texto aqui..." />
                                        <?php
                                        if(isset($motivo_medico)){
                                          echo $motivo_medico;
                                        }
                                        ?>                  
                                        </textarea>                         </td> 
                        </tr>
                                <input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" />

                        
                        <tr>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
						 <td>&nbsp;</td>
                        </tr>    
                         <tr>
                         <td colspan="3" bgcolor="#999999"><div align="center"><span style="font-weight:bold; font-size:10px;">                        </td>
                        </tr>
                        <tr>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                        </tr>
                       
                        </table>


      <table width="100% " border="0" align="center" > 
              <tr>
                         <td >&nbsp;</td>
                         <td>&nbsp;</td>
                         <td><div align="right"><strong>
                              <input name="id" type="hidden" value="<?php echo $id; ?>" />
                              <input name="id_imagem" type="hidden" value="<?php echo $id_imagem; ?>" />
                              <input name="id_prorrogacao" type="hidden" value="<?php echo $id_prorrogacao; ?>" />
                            
                              <?php 

                              
                             

                                 if(!((isset($status)) && ($status == 2) )){     

                                    if(isset($medico_pro)){ 

                                       echo " <input name='submit' type='submit' value='Prorrogar' class='btn btn-primary '/>";

                                    }else{

                                      echo " <input name='submit' type='submit' value='Solicitar' class='btn btn-primary '/>";

                                    }
                             
                                }



                              ?>

                              

                            </strong></div></td>
                          </tr>

</table>



                     </div>

                </form>


             
          
  