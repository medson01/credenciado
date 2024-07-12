
<link rel="stylesheet" type="text/css" href="../css/modal.css"/>
<?php
// CONTROLE DE EXIBIÇÃO DE FORMULARIOS
	if($_SESSION["perfil"] == 'medico'){
		$a =  'style="display: none;"';
	}else{
		$b =  'style="display: none;"';
	}

?>

    <style>
        input.largerCheckbox {
            width: 40px;
            height: 20px;
        }
    </style>
<!-- Modal -->

<div class="modal" id="aliModal" >
	<div class="modal-dialog" style="width:100%">	
	  <div class="modal-content" style="width:80%">
		<div class="modal-header">			 	 
			 <a onclick="fecharModal()"> <span class="close"> &times;</span> </a>			  	   
		</div>
		<div class="modal-body" >
        <form nome="internacao_prorrogacao_cadastro2" id="internacao_prorrogacao_cadastro2" action="internacao_prorrogacao_cadastro2.php" method="post" class="form-group" enctype="multipart/form-data">
              
                <div align="center">
                  <div class="form-group">


<!-- FORMULÁRIO DE SOLICITAÇÃO DE PRORROGAÇÃO DE INTERNAMENTO -->
<table width="92%" <?php if(isset($a)){ echo $a; } ?> border="0" align="center">
                          
                            <tr>
                              <td colspan="11" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              <div align="center">ALIMENTA&Ccedil;&Atilde;O</div></td>
                            </tr>
                            <tr>
                              <td width="8%">&nbsp;</td>
                              <td width="6%">&nbsp;</td>
                              <td width="8%">&nbsp;</td>
                              <td width="15%">&nbsp;</td>
                              <td width="5%">&nbsp;</td>
                              <td width="16%">&nbsp;</td>
                              <td width="6%">&nbsp;</td>
                              <td width="8%">&nbsp;</td>
                              <td width="4%">&nbsp;</td>
                              <td width="13%">&nbsp;</td>
                              <td width="11%">&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td colspan="6" ><span class="style13">Nome m&eacute;dico solicitante </span><br />
                                <input id="medico_solicitante2"  name="medico_solicitante2" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_pro)) { echo "value='".$medico_pro."' "; }   if(isset($desativar)){ echo $desativar;} ?> /></td>
                              <td>&nbsp;</td>
                              <td colspan="4"><span class="style13">CRM </span><br />
                                <input name="crm2" id ="crm2" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($crm_pro)) { echo "value='".$crm_pro."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td colspan="6" ><span class="style13">Nome médico Nutrólogo </span><br />
                              <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_pro)) { echo "value='".$medico_pro."' "; }   if(isset($desativar)){ echo $desativar;} ?> />

                              </span></td>
                            <td>&nbsp;</td>
                            <td colspan="4"><span class="style13"> CRM/RQE </span><br />
                              <input name="crm" id ="crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($crm_pro)) { echo "value='".$crm_pro."' "; }  if(isset($desativar)){ echo $desativar;} ?>/>

                              </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Qtd Diárias</span><br />
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
                                </select></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="11" bgcolor="#F1E07E"><div align="center">TERAPIA NUTRICIONAL </div></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4">&nbsp;</td>
                              <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2">Terapia Nutricional </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4">Enteral </td>
                              <td colspan="3">Parenteral</td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4"><div class="form-check"></td>
                              <td colspan="3"><div class="form-check"></td>
                            </tr>
                            <tr>
                              <td colspan="2"><div class="form-check">
                                <input name="checkbox" type="checkbox" class="largerCheckbox" id="checkbox" value="" />
                                <span class="style13"> Via Oral (TNO) </span> </div></td>
                              <td><span class="style13">Qtd  p/ dia </span><br />
                                <select id='select3' name='select2' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" >
                                  <?php
                  								
                  								if(isset($dias_pro) ){ 
                                      echo "<option value='".$dias_pro."' >".$dias_pro."</option>"; 
                                  }else{
                                    for ($i=0; $i <= 5; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                  }

                                }
								               ?>
                                </select></td>
                              <td>&nbsp;</td>
                              <td colspan="2"><div class="form-check">
                                <input class="largerCheckbox" type="checkbox" name="enteral_sne" value="enteral_sne" />
                                <span class="style13"> Via Sonda Nasoenteral (SNE) </span> </div></td>
                              <td><span class="style13">Qtd  p/ dia </span><br />
                                <select id='select4' name='select3' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" >
                                  <?php
                  								
                  								if(isset($dias_pro) ){ 
                                      echo "<option value='".$dias_pro."' >".$dias_pro."</option>"; 
                                  }else{
                                    for ($i=0; $i <= 5; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                  }

                                }
								               ?>
                                </select></td>
                              <td>&nbsp;</td>
                              <td colspan="2"><div class="form-check">
                                <input class="largerCheckbox" type="checkbox" name="parenteral_npp" value="parenteral_npp" />
                                <span class="style13"> Via Periférica (NPP) </span> </div></td>
                              <td><span class="style13">Qtd  p/ dia </span><br />
                                  <select id='select2' name='select' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" >
                                    <?php
                  								
                  								if(isset($dias_pro) ){ 
                                      echo "<option value='".$dias_pro."' >".$dias_pro."</option>"; 
                                  }else{
                                    for ($i=0; $i <= 5; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                  }

                                }
								               ?>
                                </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="11" bgcolor="#F1E07E"><div align="center">ARQUIVO</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="11"><span class = 'style13'>Anexar a imagem da solicitação </span> </span>
                                <br />
						<div class="mb-3">
  							
						  		<input class="form-control form-control-sm" id="formFileSm" type="file" name="imagem" required >
						</div>								 </td>
                            </tr>
                            <tr>
                              <td colspan="11">							  </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr bgcolor="#F1E07E">
                              <td colspan="11">&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td colspan="11" class="style13" >Justificativa da prorrogação
                                <textarea minlength="5" required id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="prorrogacao" <?php if(isset($desativar)){ echo $desativar; } ?> /><?php
                                        if(isset($motivo_pro)){
                                          echo $motivo_pro;
                                        }
                                        ?></textarea>                              </td>
                          </tr>
                        <tr>
                          <td colspan="11" >                              </td>
          </tr>
</table>


<!-- ################################################################################################################################# -->

<!-- FORMULÁRIO DE AUTORIZAÇÃO DA PRORROGAÇÃO DE INTERNAMENTO  -->

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
						  <td><span class = 'style13'>Qtd de Alimentações Parenteral</span><br />
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
            <button id="cancelar" onclick="fecharModal()" type="button" class="btn btn-default" data-dismiss="modal" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" >
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
<script>
function abrirModal() {
   document.getElementById('aliModal').style.display = "block";
}
function fecharModal() {
   document.getElementById('aliModal').style.display = "none";
}
</script>  	