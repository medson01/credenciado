<!-- controle de permissão de página -->
<script src="../js/permissao.js"></script>
                  
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
                          

                              <td colspan="3" bordercolor="#999999" bgcolor="#999999"><div align="center" class="style5">Prorrogar Internação</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td ><span class="style13">Médico solicitante </span><br />
                              <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" />

                              </span></td>
                            <td>&nbsp;</td>
                            <td><span class="style13">CRM </span><br />
                              <input name="crm" id ="crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required"  />

                              </span></td>
                            </tr>
                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">
                  <?php 

                        
                              if((isset($status)) && ($status == 2) ){ 

                                     echo "Dias solicitados ";

                                     echo " </span><br />

                                            <select name='dias' class='form-control input-sm' disabled>"; 



                                }else{


                                  if( (isset($medico_pro)) ){ 
                                     echo "Dias solicitados ";

                                     echo " </span><br />

                                            <select name='dias' class='form-control input-sm'  readonly='true'>"; 


                                  }else{

                                    // Perfil usuários
                                     echo "Dias solicitados";

                                     echo " </span><br />

                                            <select name='dias' class='form-control input-sm'   disabled>"; 
                                  }
							  	
                              
                									if(isset($dias_pro) ){ 
                											echo "<option value='".$dias_pro."' >".$dias_pro."</option>"; 
                									}else{
                										for ($i=1; $i <= 3; $i++) {
                    										echo "<option value='".$i."'>".$i."</option>";
                										}
                									}
                                } 

                         
									
								  ?>

                        </select>                
                              </td>
                              <td>                              </td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" ><span class="style13">Justificativa da prorrogação
                                <textarea class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" placeholder="Entre com o texto aqui..."  readonly='true'
                                        <?php 
                                       if((isset($status)) && ($status == 2) ){
                                           echo "value='' readonly='true' "; 
                                         }else{ 
                                            if(isset($motivo_pro) ){
                                           echo "value='".$motivo_pro."'  readonly='true'  ";
                                         } 
                                       }    ?> />

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
                              <td>

							  </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><?php 


                                  if((isset($status)) && ($status == 2) ){
/*echo "<span class='style13'> Dias autorizados</span>
                                            <input name= 'dias_autorizados' id ='dias_autorizado' type='text' class='form-control input-sm' style='font-size: 10px' size='44' required='required' readonly='true'  />";
*/
                                  }

                ?>    

                             <span  id="t1"  class="style13"> Dias autorizados</span>
                                            <input name= 'dias_autorizados'  id ='dias_autorizados' type='text' class='form-control input-sm p' style='font-size: 10px' size='44' />
                                    
                                  

								
								
								
                                <input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" /></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>&nbsp;</td>
                              <td></td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>
                            <tr>
                            
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="3">&nbsp;</td>
                          </tr>
                            
                            <tr>
                            
                            <td></td>
                          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" bgcolor="#999999"><div align="center"><span style="font-weight:bold; font-size:10px;">
                                  <div align="center">Atenção</br>
                                  </div>
                                  <div style="text-align: justify;">
                                    <div align="center">Caro credenciado, a solicitação será encamihada ao setor responsável do plano para análise. . <br />
                                    </div>
                              </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><div align="right"><strong>

                              <input name="id" type="hidden" value="<?php echo $id; ?>" />
                              <input name="id_prorrogacao" type="hidden" value="<?php echo $id_prorrogacao; ?>" />
                            
                              <?php 

                              
                             

                                 if(!((isset($status)) && ($status == 2) )){     

                                    if(isset($medico_pro)){ 

                                       echo " <input name='submit' type='submit' value='Prorrogar' class='btn btn-primary '/>";

                                    }else{

                                      echo " <input name='submit' type='submit' value='Enviar' class='btn btn-primary '/>";

                                    }
                             
                                }



                              ?>

                              

                            </strong></div></td>
                          </tr>
                        </table>
                     </div>

                </form>

                <?php
                                  // Controle de permissões de página
                                  // Chama a função permissao() em permissao.js
                                  echo '<script>';
                                  echo "permissao('".$_SESSION["perfil"]."');";  
                                  echo '</script>';
                
                ?>
             
          
  