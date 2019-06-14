
<?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];

    if($_GET["valor"] == 0){

          $query = mysqli_query($conn,"SELECT internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante,
                     internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, cid.cid , cid.descricao as 
                     descricao ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo, internamento.prorrogacao as prorrogacao
                     FROM `internamento` 
                     INNER JOIN usuarios on usuarios.id = internamento.id_usuario 
                     INNER JOIN cid on cid.id = internamento.id_cid
                     LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa 
              
                     WHERE internamento.id =".$id) or die("erro ao carregar consulta");


                      
                                while($registro = mysqli_fetch_row($query)){

                                  $nome = $registro[0];
                                  $matricula = $registro[1];
                                  $solicitante = $registro[2];
                                  $crm = $registro[3];
                                  $dat_entrada = $registro[4];
                                  $dat_saida = $registro[5];
                                  $cid = $registro[6];
                                  $cid_desc = $registro[7];
                                  $credenciado = $registro[8];
                                  $dias = $registro[9];
                                  $motivo = $registro[10];
                                  $prorrogacao = $registro[11];

                                   
                             }
    }else{


          $query = mysqli_query($conn,"SELECT internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante,
                     internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, cid.cid , cid.descricao as 
                     descricao ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo, internamento.prorrogacao as prorrogacao, prorrogacao.medico_solicitante as medico_pro, prorrogacao.crm as crm_pro, prorrogacao.dias as dias_pro, prorrogacao.motivo as motivo_pro, prorrogacao.id as id_prorrogacao
                     FROM `internamento` 
                     INNER JOIN usuarios on usuarios.id = internamento.id_usuario 
                     INNER JOIN cid on cid.id = internamento.id_cid
                     LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa 
                     INNER JOIN prorrogacao on prorrogacao.id = internamento.id_prorrogacao 
                     WHERE internamento.id =".$id) or die("erro ao carregar consulta");


                      
                                while($registro = mysqli_fetch_row($query)){

                                  $nome = $registro[0];
                                  $matricula = $registro[1];
                                  $solicitante = $registro[2];
                                  $crm = $registro[3];
                                  $dat_entrada = $registro[4];
                                  $dat_saida = $registro[5];
                                  $cid = $registro[6];
                                  $cid_desc = $registro[7];
                                  $credenciado = $registro[8];
                                  $dias = $registro[9];
                                  $motivo = $registro[10];
                                  $prorrogacao = $registro[11];
                                  $medico_pro = $registro[12];
                                  $crm_pro = $registro[13];
                                  $dias_pro = $registro[14];
                                  $motivo_pro = $registro[15];
                                  $id_prorrogacao = $registro[16];
                                 


                                   
                             }
  }

?>               

                  
<style type="text/css">
<!--
.style3 {color: #000000}
.style5 {color: #000000; font-weight: bold; }
.style13 {font-size: 10px}
-->
                     </style>
                     <label> </label>
                      <div align="center">
					  
		<form name="prorrogacao" id="prorrogacao" action ="internacao_prorrogacao_cadastro.php" method="post" data-parsley-validate class="form-horizontal form-label-left">			  
                        <table width="799" border="0" align="center">
                          <tr>
                            <td colspan="3" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">GUIA DE SOLICITAÇÃO 
                            DE PRORROGAÇÃO DE INTERNAÇÃO</div></td>
                          </tr>
                          <tr>
                         <td colspan="3" bgcolor="#999999" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">
					      <?php echo "Número da Guia: ".$id; ?></div>
						  <input type="hidden" name="id" <?php echo "value='".$id."'"; ?>  />						  </td>
                          </tr>
                          
                          <tr>
                            <td width="380" ><span class="style13">Matrícula</span><br />
                                <input name="credenciado" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $matricula; ?>" size="44" />
                            </span></td>
                            <td width="7">&nbsp;</td>
                            <td width="398"><span class="style13">Data do internamento </span><br />
                              <input name="data_entrada" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo date('d / m / Y ', strtotime($dat_entrada));  echo " às ".date('H:i:s', strtotime($dat_entrada)); ?>" size="44" /></td>
                          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" ><span class="style13">Nome do beneficiário </span><br />
                                <input name="credenciado2" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $nome; ?>" size="44" /></td>
                            </tr>
                            <tr>
                            <td class="style3">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td ><span class="style13">Código C.I.D</span><br />
                                <input name="cid" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $cid; ?>" size="44" /></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Idade</span><br />
                                <input name="data_entrada2" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="
								<?php 
								
										echo date('d / m / Y ', strtotime($dat_entrada));  echo " às ".date('H:i:s', strtotime($dat_entrada)); ?>
								
								" size="44" /></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" ><span class="style13">Descrição do C.I.D </span><br />
                                <input name="cid_desc" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $cid_desc; ?>" size="44" /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" bordercolor="#999999" bgcolor="#999999"><div align="center" class="style5">Prorogação</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td ><span class="style13">Médico solicitante </span><br />
                              <input name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if(isset($medico_pro)){ echo "value='".$medico_pro."' readonly='true' ";}?> />
                              </span></td>
                            <td>&nbsp;</td>
                            <td><span class="style13">CRM </span><br />
                              <input name="crm" id ="crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if(isset($crm_pro)){ echo "value='".$crm_pro."' readonly='true'  ";}?>/>
                              </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Quantidade de días adicionais </span><br />
                                <input name="dias" id="dias" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if(isset($dias_pro)){ echo "value='".$dias_pro."' readonly='true'  ";}?>/>
                                </span></td>
                              <td>&nbsp;</td>
                              <td><input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" /></td>
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
                            <td colspan="3"><span class="style13">Justificativa da prorrogação </span></td>
                          </tr>
                            <td colspan="3" >
                            <textarea class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" placeholder="Entre com o texto aqui..."  <?php if(isset($motivo_pro)){ echo "value='".$motivo_pro."'  readonly='true'  ";}?>> 

                               

                              </textarea>                            </td>
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

                             
                            
                              <?php if(isset($medico_pro)){ 

                                echo " <a class='btn btn-primary '  href='internacao_prorrogacao_update.php?id_prorrogacao=".$id_prorrogacao."' > Prorrogar  </a>";

                              }else{

                                echo " <input name='submit' type='submit' value='Enviar' class='btn btn-primary '/>";

                              }


                              ?>

                            </strong></div></td>
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
                   

             
          
  