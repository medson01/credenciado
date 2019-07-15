
<?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];

    

          $query = mysqli_query($conn,"SELECT internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante,
                     internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, cid.cid , cid.descricao as 
                     descricao ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo, internamento.prorrogacao as prorrogacao, acomodacao.id as id_acomodacao, acomodacao.nome as acomodacao
                     FROM `internamento` 
                     INNER JOIN usuarios on usuarios.id = internamento.id_usuario 
                     INNER JOIN cid on cid.id = internamento.id_cid
                     INNER JOIN alocacao on alocacao.id = internamento.id_alocacao 
                     INNER JOIN acomodacao on acomodacao.id = alocacao.id_acomodacao 
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
                                  $id_acomodacao = $registro[12];
                                  $acomodacao = $registro[13];

                                   
                             }

       $query = mysqli_query($conn,"SELECT * FROM acomodacao order by id") or die("erro ao carregar consulta");
	   					


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
					  
		
          
          <form name="acomodacao" id="acomodacao" action ="internacao_acomodacao_update.php" method="post" data-parsley-validate class="form-horizontal form-label-left">
   		  
                        <table width="799" border="0" align="center">
                          <tr>
                            <td colspan="3" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">ALTERAÇÃO DE ACOMODAÇÃO</div></td>
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
                    

                              <td colspan="3" bordercolor="#999999" bgcolor="#999999"><div align="center" class="style5">Acomodação</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td ><span class="style13"> Acomodação atual </span><br />
                              <input name="atual_acomodacao" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php echo "value='".$acomodacao."' readonly='true'  "; ?> />
                              </span></td>
                            <td>&nbsp;</td>
                            <td><span class="style13">Alterar para:</span><br />
                               <select name='id_acomodacao' class='form-control input-sm' >
                  <?php 


                   while($registro = mysqli_fetch_assoc($query)){

                       echo '<option value="'.$registro["id"].'">'.$registro["nome"].'</option>';
                                                                                              
                    }
                              
                  
                  ?>
                                </select> </td>
                            </tr>

                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" ><span class="style13">Justificativa da prorrogação 
                                <textarea class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="acomodacao" placeholder="Entre com o texto aqui..."> 

                               

                                </textarea>
                              </span></td>
                            </tr>

                                                        <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">                                           <div align="right">

                             <a href="painel.php?pa=1" >
                            
                                <input name="button" type="button" class='btn btn-primary delete' value="Voltar" />
                            
                              </a>
                            </div></td>
                              <td>                              </td>
                              <td>
                                <div align="left">

                                  <input name="id_internamento" type="hidden" value="<?php echo $id; ?>" />  

                                  <input name="submit" type="Submit" value=" Aplicar " class="btn btn-primary "/>  


                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="3" >&nbsp;</td>
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
                            <td >&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><div align="right"><strong>

                             

                            </strong></div></td>
                          </tr>
                        </table>
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
                

             
          
  