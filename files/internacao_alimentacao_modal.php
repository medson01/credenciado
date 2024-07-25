
<!-- Script calendario data -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<script src="../js/data.js"></script>	
	
<link rel="stylesheet" type="text/css" href="../css/modal.css"/>
<?php

// FORMATA A DATA QUE ESTÁ NO FORMATO ENG PARA BR NO BANCO
	require_once "../func/formatar_data_banco.php";
	
	
// CONTROLE DE EXIBIÇÃO DE FORMULARIOS
	if($_SESSION["perfil"] == 'medico'){
		$exibir_medico =  'style="display: block;;"';
	}else{
		$exibir_medico =  'style="display: none;"';
	}

?>

    <style>
        input.largerCheckbox {
            width: 40px;
            height: 20px;
        }
    .style13 {font-size: 10px}
    </style>
<!-- Modal -->

<div class="modal" id="aliModal" >
	<div class="modal-dialog" style="width:70%">	
	  <div class="modal-content" style="width:80%">
		<div class="modal-header">			 	 
			 <a onclick="fecharModal()"> <span class="close"> &times;</span> </a>			  	   
		</div>
		<div class="modal-body" >
        <form nome="internacao_alimentacao_cadastro" id="internacao_alimentacao_cadastro" action="internacao_alimentacao_cadastro.php" method="post" class="form-group" enctype="multipart/form-data">
              
                <div align="center">
                  <div class="form-group">


<!-- FORMULÁRIO DE SOLICITAÇÃO DE PRORROGAÇÃO DE INTERNAMENTO -->
<table width="100%" <?php if(isset($a)){ echo $a; } ?> border="0" align="center">
                          
                            <tr>
                              <td colspan="10" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              <div align="center">ALIMENTA&Ccedil;&Atilde;O</div></td>
                            </tr>
                            <tr>
                              <td width="22%">&nbsp;</td>
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
                              <td colspan="5" ><span class="style13">Nome m&eacute;dico solicitante </span><br />
                                  <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_solicitante)) { echo "value='".$medico_solicitante."' "; }   if(isset($desativar)){ echo $desativar;} ?> /></td>
                              <td>&nbsp;</td>
                              <td colspan="4"><span class="style13">CRM </span><br />
                                  <input name="ali_crm" id ="ali_crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($ali_crm)) { echo "value='".$ali_crm."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
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
                            </tr>
                            <tr>
                              <td colspan="5" ><span class="style13">Nome médico Nutrólogo </span><br />
                                  <input id="nutrologo"  name="nutrologo" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($nutrologo)) { echo "value='".$nutrologo."' "; }   if(isset($desativar)){ echo $desativar;} ?> />
                                  </span></td>
                              <td>&nbsp;</td>
                              <td colspan="4"><span class="style13"> CRM/RQE </span><br />
                                  <input name="crm_rqe" id ="crm_rqe" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($crm_rqe)) { echo "value='".$crm_rqe."' "; }  if(isset($desativar)){ echo $desativar;} ?>/>
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
                            </tr>
                            <tr>
                              <td colspan="10" bgcolor="#F1E07E"><div align="center">PERÍODO DA PRORROGAÇÃO  </div></td>
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
                            </tr>
                            <tr bgcolor="#999999">
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
                            <tr bgcolor="#999999">
                              <td colspan="2"><span class = 'style13' style="padding-left: 60px;">Data Inicial </span> <br />
                                  <?php
									if(isset($_GET['data_inicial'])){
									echo ' <input class="form-control" style="margin-left: 60px;" name="data_inicial" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required value="'.formatar_banco_data($_GET['data_inicial']).'" readonly /> ';
									}
								?></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="3"><span class="style13">Data Final </span><br />
                                  <?php
								if(isset($_GET['data_final'])){
                                	echo ' <input class="form-control" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required value="'.formatar_banco_data($_GET['data_final']).'" readonly /> ';
								}
							  ?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr bgcolor="#999999">
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr bgcolor="#999999">
                              <td colspan="2"><span class="style13" style="padding-left: 60px;">Qtd Diárias</span><br />
                                  <?php
							if(isset($_GET['dias_autorizados']) ){
                             	echo ' <input  style="margin-left: 60px;" name="dias_autorizados" type="text" class="form-control input-sm" style="font-size: 10px" size="44" value="'.$_GET['dias_autorizados'].'"readonly />';
								
							}
							  ?></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr bgcolor="#999999">
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
                              <td width="6%">&nbsp;</td>
                              <td width="3%">&nbsp;</td>
                              <td width="10%">&nbsp;</td>
                              <td width="12%">&nbsp;</td>
                              <td width="7%">&nbsp;</td>
                              <td width="11%">&nbsp;</td>
                              <td width="1%">&nbsp;</td>
                              <td width="11%">&nbsp;</td>
                              <td width="17%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center"><span>QUANTIDADE  DE DIÁRIAS </span></div></td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center">
                                <select id='qtd_diarias' name='qtd_diarias' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" style="width:50px">
                                  <?php
                  				     for ($i=0; $i <= $_GET['dias_autorizados']; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                     }
								   ?>
                                </select>
                              </div></td>
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
                            </tr>
                            <tr>
                              <td colspan="10" bgcolor="#F1E07E"><div align="center">TERAPIA NUTRICIONAL </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4">&nbsp;</td>
                              <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Terapia Nutricional </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4">Enteral </td>
                              <td colspan="3">Parenteral</td>
                            </tr>
                            <tr>
                              <td><div class="form-check">
                                <input name="vias" type="radio" class="largerCheckbox" id="checkbox" value="TNO" required="required"/>
                                <span > Via Oral (TNO) </span> </div></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4"><div class="form-check">
                                <div class="form-check">
                                  <input name="vias" type="radio" class="largerCheckbox" id="radio" value="SNE" />
                                <span > Via Sonda Nasoenteral (SNE) </span> </div></td>
                              <td colspan="3"><div class="form-check">
                                <div class="form-check">
                                  <input name="vias" type="radio" class="largerCheckbox" id="radio2" value="NPP" />
                                <span > Via Periférica (NPP) </span> </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center"><span>QUANTIDADE  <span>DE ALIMENTAÇÃO</span> POR DIA  </span></div></td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center">
                                <select onchange="totalAlimentacao()" id='por_dia' name='por_dia' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" style="width:50px" >
                                  <?php
                  				    for ($i=0; $i <= 4; $i++) {
                                        echo "<option value='".$i."'>".$i."</option>";
                                     }
									?>
                                </select>
                              </div></td>
                            </tr>
                            <tr>
                              <td colspan="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="10"  bgcolor="#F1E07E"><div align="center">TOTAL DE ALIMENTAÇÕES </div></td>
                            </tr>
                            <tr>
                              <td colspan="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center">
                                <input   style="text-align:center; font-size: large; color:#FF0000; font-weight: bolder;" id="total_alimentacao" name="total_alimentacao" type="text" class="form-control input-sm" size="44" readonly />
							  
							  
							  </div></td>
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
                            </tr>
                            <tr>
                              <td colspan="10" bgcolor="#F1E07E"><div align="center">ARQUIVO</div></td>
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
                            </tr>
                            <tr>
                              <td colspan="10"><span class = 'style13'>Anexar a imagem da solicitação </span> </span>
                                <br />
						<div class="mb-3">
  							
						  		<input class="form-control form-control-sm" id="formFileSm" type="file" name="imagem" required >
						</div>								 </td>
                            </tr>
                            <tr>
                              <td colspan="10">							  </td>
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
                            </tr>

                            <tr>
                              <td colspan="10" class="style13" >Justificativa da prorrogação
                                <textarea minlength="5" required id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="internacao_alimentacao_cadastro" <?php if(isset($desativar)){ echo $desativar; } ?> /><?php
                                        if(isset($motivo_pro)){
                                          echo $motivo_pro;
                                        }
                                        ?></textarea>                              </td>
                          </tr>
                        <tr>
                          <td colspan="10" >                              </td>
          </tr>
</table>


<!-- ################################################################################################################################# -->

<!-- FORMULÁRIO DE AUTORIZAÇÃO DA ALIMENTAÇÃO DA PRORROGAÇÃO DO INTERNAMENTO  -->
<div class="alert alert-danger"  <?php echo $exibir_medico; ?> >
 <table width="100%" border="0" align="center"  <?php echo $exibir_medico; ?> >
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
                                                          

                            </strong></div></td>
        </tr>

</table>
		<!-- DADOS DE ENVIO PRORROGAÇÃO -->
			<!-- IMAGEM --> 
			<input type="hidden" name="id_usuario"    value="<?php echo $_SESSION["id"]; ?>" />	
			<input type="hidden" name="id"            value="<?php echo $_GET['id']; ?>" /> 
			<input type="hidden" name="id_prorro"     value="<?php echo $_GET['id_prorro']; ?>" />    		
          	<input type="hidden" name="evento"        value="ali" /> 
			<input type="hidden" name="descricao"     value="Solicitação médica de alimentação" />  
          	<input type="hidden" name="MAX_FILE_SIZE" value="99999999" />  
			<input type="hidden" name="url"           value="<?php echo $_SERVER['REQUEST_URI']; ?>" /> 
           	<input type="hidden" name="data_inicial"  value="<?php echo formatar_banco_data($_GET['data_inicial']); ?>" /> 
			<input type="hidden" name="data_final"    value="<?php echo formatar_banco_data($_GET['data_final']); ?>" /> 
			<input type="hidden" name="status"           value="<?php if($_SESSION["perfil"] == 'medico'){ echo 2;}else{ echo 1; } ?>" /> 		    
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

<!-- LETRAS MAÚSCULAS --> 
 <script type="text/javascript">
$("#motivo_medico").on("input", function(){
	$(this).val($(this).val().toUpperCase());
}); 
$("#motivo").on("input", function(){
	$(this).val($(this).val().toUpperCase());
});
</script> 

<!-- TOTAL ALIMENTAÇÃO-->
<script>
	function totalAlimentacao() {
		var qtd_diarias = document.getElementById("qtd_diarias").value;
		var qtd_tno = document.getElementById("por_dia").value;

		var total = 0;
		
		total = qtd_diarias * qtd_tno;
		document.getElementById("total_alimentacao").value = total;
		
	}
</script>
				
<!-- Script de controle da modal -->			
<script>
document.onload(funcaoPaginaCarregada());

function funcaoPaginaCarregada() {
	const urlParams = new URLSearchParams(window.location.search);
	const alimentacao = urlParams.get("id_prorro") 
		if(alimentacao > 0){
			document.getElementById('aliModal').style.display = "block";
		}
}
function abrirModal() {
   		document.getElementById('aliModal').style.display = "block";
}
function fecharModal() {
   document.getElementById('aliModal').style.display = "none";
}
</script>  	


<!-- CALCULA A QUANTIDADE DE DIAS DE UMA DATA PARA OUTRA  -->	
<script>
			function calcularData() {	
				// Converte o padrão BR para ENG 
				function FormataStringData(data) {
				  var dia  = data.split("/")[0];
				  var mes  = data.split("/")[1];
				  var ano  = data.split("/")[2];
				
				  return ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
				  // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
				}
				
				var d1 = document.getElementById("data_inicial").value;
				var d2 = document.getElementById("data_final").value
				
				var date1 = new Date(FormataStringData(d1));
				var date2 = new Date(FormataStringData(d2));
		
				var timeDiff = Math.abs(date2 - date1);
				var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
				
				if(diffDays > 5){
					document.getElementById("aviso1").innerHTML = '<div style="font-size: x-small; font-family: system-ui; font-weight: 400;" class="alert alert-danger" role="alert">Périodo exede ao máximo de diárias permitida que é 5 diárias!</div>';
					document.getElementById("aviso2").innerHTML = '<div style="font-size: x-small; font-family: system-ui; font-weight: 400;" class="alert alert-info" role="alert">Périodo exede ao máximo de diárias permitida que é 5 diárias!</div>';
				}else{
					document.getElementById("aviso1").innerHTML = '';
					document.getElementById("aviso2").innerHTML = '';
				}
				document.getElementById("dias").value = diffDays;
				diffDays = 0;
			}
</script>	