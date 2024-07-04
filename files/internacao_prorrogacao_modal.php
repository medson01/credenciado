
<link rel="stylesheet" type="text/css" href="../css/modal.css"/>

<script type='text/javascript' src='../js/modal_sair.js'></script>

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>


<?php
// CONTROLE DE EXIBIÇÃO DE FORMULARIOS
	if($_SESSION["perfil"] == 'medico'){
		$a =  'style="display: none;"';
	}else{
		$b =  'style="display: none;"';
	}

?>


<!-- Modal -->

<div class="modal" id="labModal">
	<div class="modal-dialog" style="margin-left:5%; width:100%">	
	  <div class="modal-content">
		<div class="modal-header">			 	 
			  <span class="close" id="fechar">&times;</span>			  	   
		</div>
		<div class="modal-body" >
        <form nome="internacao_prorrogacao_cadastro2" id="internacao_prorrogacao_cadastro2" action="internacao_prorrogacao_cadastro2.php" method="post" class="form-group" enctype="multipart/form-data">
              
                <div align="center">
                  <div class="form-group">

<table width="100%" <?php if(isset($a)){ echo $a; } ?> border="0" align="center">
                          
                            <tr>
                              <td colspan="3" bgcolor="#CCCCCC">
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
                            <td><span class="style13"> CRM </span><br />
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

                        <select id='select' name='dias' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required >
							  	
                              <?php
                  								
                  								if(isset($dias_pro) ){ 
                                      echo "<option value='".$dias_pro."' >".$dias_pro."</option>"; 
                                  }else{
                                    for ($i=1; $i <= 5; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                  }

                                }
								               ?>
                        </select>                              </td>
                              <td>                              </td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>
							  	<span class = 'style13'> Qtd Fisioterapia Respiratória </span> 
                                 </span> <br />
											 <input name="qtd_respiratoria" id ="qtd_respiratoria1" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_respiratoria)) { echo "value='".$qtd_respiratoria."' "; }  if(isset($desativar)){ echo $desativar;} ?> />							  </td>
                              <td>&nbsp;</td>
                              <td><span class = 'style13'>Qtd Fisioterapia Motora </span> </span><br />		 
                              <input name="qtd_motora" id ="qtd_motora1" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_motora)) { echo "value='".$qtd_motora."' "; }  if(isset($desativar)){ echo $desativar;} ?> /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3"><span class = 'style13'>Anexar a imagem da solicitação </span> </span>
                                <br />
						<div class="mb-3">
  							
						  		<input class="form-control form-control-sm" id="formFileSm" type="file" name="imagem" required >
						</div>								 </td>
                            </tr>
                            <tr>
                              <td colspan="3">							  </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td colspan="3" ><span class="style13">Justificativa da prorrogação
                                <textarea minlength="5" required id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" <?php if(isset($desativar)){ echo $desativar; } ?> /><?php
                                        if(isset($motivo_pro)){
                                          echo $motivo_pro;
                                        }
                                        ?></textarea>
                              </span></td>
                          </tr>
                        <tr>
                          <td colspan="3" >                              </td>
          </tr>
</table>

 <table width="100%" <?php if(isset($b)){ echo $b; } ?> border="0" align="center">
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
                          <td><span  id="t1"  class="style13"> Diárias</span> <br />
                          <input name="dias_autorizados" id ="dias_autorizados" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($dias_autorizados)) { echo "value='".$dias_autorizados."' "; } ?>/></td><td>&nbsp;</td>
						  <td><span class = 'style13'>Quantidade de Alimentações Parenteral</span><br />
                            <input name="qtd_alimentacao_parenteral" id ="qtd_alimentacao_parenteral" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_alimentacao_parenteral)) { echo "value='".$qtd_alimentacao_parenteral."' "; } ?>/></td>
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
                              <td>
							  	<span class = 'style13'> Qtd Fisioterapia Respiratória </span> 
                                 </span> <br />
											 <input name="qtd_respiratoria" id ="qtd_respiratoria2" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_respiratoria)) { echo "value='".$qtd_respiratoria."' "; } ?>/>							  </td>
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
                                <textarea id="motivo_medico" class="form-control input-sm" name="motivo_medico"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" placeholder="Entre com o texto aqui..." />
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
                              <input name="id" type="hidden" value="<?php echo $id; ?>" />
                              <input name="id_imagem" type="hidden" value="<?php echo $id_imagem; ?>" />
                              <input name="id_prorrogacao" type="hidden" value="<?php echo $id_prorrogacao; ?>" />
                            
                             <input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" />                             

                            </strong></div></td>
        </tr>

</table>
		<!-- DADOS DE ENVIO PRORROGAÇÃO -->
			<!-- IMAGEM -->
			<input type="hidden" name="id"            value="<?php echo $_GET['id']; ?>" /> 
          	<input type="hidden" name="evento"        value="int" /> 
			<input type="hidden" name="descricao"     value="Solicitação médica de prorrogação" />  
          	<input type="hidden" name="MAX_FILE_SIZE" value="99999999" />  
			<input type="hidden" name="url"           value="<?php echo $_SERVER['REQUEST_URI']; ?>" /> 
        		    
                </div>
                </div>
        	     <!-- /Conteúdo Modal -->
			  
				 
        		 </div>
				  <div class="modal-footer" style="background-color: red;">
            <button id="cancelar" type="button" class="btn btn-default" data-dismiss="modal" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" >
        		 		Cancelar 
        		</button>
        		<button type="submit" class="btn btn-default" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" /> Incluir 
            </button>
        	</div>	
      </div>
      ...
</div>
</form> 
				
<!-- Script de controle da modal -->
<!-- Ele tem que vir depois da página onde é criados os objetos -->				
<script>
// Cria os obejetos do modal e close
	//variável modal
	var labModal = document.getElementById("labModal");
	//variável do botão abrir modal
	var btn = document.getElementById("incluir");
	//variável span fechar modal
	var fechar = document.getElementById("fechar");
	var cancelar = document.getElementById("cancelar");
	
// Fucnção abrir modal
  btn.onclick = function() {
	  labModal.style.display = "block";
 }
 
 // Função fechar modal
  fechar.onclick = function() {
	 labModal.style.display = "none";
 }

 // Função fechar modal
  cancelar.onclick = function() {
	 labModal.style.display = "none";
 }
</script>   				
				