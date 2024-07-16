
<!-- FORMULÁRIO DE AUTORIZAÇÃO DA PRORROGAÇÃO DE INTERNAMENTO  -->
<div class="alert alert-danger"  >
 <table width="100%" border="0" align="center"  >
                <!-- autorização do médico -->
                      <!-- Cabeçalho de autorização médica-->
                        <tr>
                          <td colspan="3" bgcolor="#CCCCCC">
                          <div align="center" style="color: black;">Autorização Médica </div>                          </td>
                        </tr>
                        <tr>
                          <td width="49%">&nbsp;</td>
                          <td width="3%">&nbsp;</td>
                          <td width="48%">&nbsp;</td>
                        </tr>
                        <tr>  
                          <td><span class = 'style13'>Data Inicial </span> <br />
                          <input class="form-control"name="data_inicial"type="text" id="data_inicial" data-date-format="mm/dd/yyyy" maxlength="10"size="10" required="required" <?php if (isset($data_inicial)) { echo "value='".formatar_banco_data($data_inicial)."' "; }   ?>  /></td><td>&nbsp;</td>
						  <td><br />
						    <span class="style13">Data Final </span><br />
                            <input  onchange="calcularData()" class="form-control"name="data_final"type="text" id="data_final" data-date-format="mm/dd/yyyy" maxlength="10"size="10" required="required" <?php if (isset($data_final)) { echo "value='".formatar_banco_data($data_final)."' "; }   ?>></td>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><span class="style13">Qtd Diárias</span><br />
                            <input name="dias" id ="dias" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($dias)) { echo "value='".$dias."' readonly"; }  ?> readonly="readonly" /></td>
                          <td>&nbsp;</td>
                          <td><p id= "aviso2" ></td>
                        </tr>
                        <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
        </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class = 'style13'>Qtd Respiratória </span> <br />
                                <input name="qtd_respiratoria2" id ="qtd_respiratoria2" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_respiratoria)) { echo "value='".$qtd_respiratoria."' "; }  if(isset($desativar)){ echo $desativar;} ?> /></td>
                              <td>&nbsp;</td>
                              <td><span class = 'style13'>Qtd Fisioterapia Motora </span> </span><br />		 
                              <input name="qtd_motora" id ="qtd_motora2" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_motora)) { echo "value='".$qtd_motora."' "; }?>/></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>          
                        <tr>
                         <td colspan="3" >
                             <span class="style13">Justificativa do médico</span>
                                <textarea id="motivo_medico" class="form-control input-sm" name="motivo_medico"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="internacao_prorrogacao_cadastro" placeholder="Entre com o texto aqui..." />
                                        <?php
                                        if(isset($motivo_medico)){
                                          echo $motivo_medico;
                                        }
                                        ?>                  
                                        </textarea>                         </td> 
                        </tr>
                                

                        
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
                            </strong></div></td>
        </tr>

</table>
</div>