﻿<?php 

// FORMATA A DATA QUE ESTÁ NO FORMATO ENG PARA BR NO BANCO
	require_once "../func/formatar_data_banco.php";


	if(isset($_GET['prorro']) && !empty($_GET['prorro']) ){
		$sql='SELECT prorrogacao.id as id_prorrogacao, prorrogacao.medico_solicitante,  prorrogacao.crm, prorrogacao.data_inicial, prorrogacao.data_final, prorrogacao.motivo, prorrogacao.motivo_medico, prorrogacao.dias_solicitados, prorrogacao.dias_autorizados, prorrogacao.qtd_motora, prorrogacao.qtd_respiratoria, data, prorrogacao.status, imagem.id as id_imagem, acomodacao.nome  as acomodacao 
		FROM prorrogacao 
		INNER JOIN acomodacao on acomodacao.id = prorrogacao.id_acomodacao 
		INNER JOIN imagem on imagem.id_prorrogacao = prorrogacao.id 
		WHERE prorrogacao.id='.$_GET['prorro'];
	
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		while($registro = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$medico_pro = $registro["medico_solicitante"];
			$crm_pro = $registro["crm"];
			$data_inicial = $registro["data_inicial"];
			$data_final = $registro["data_final"];
			$dias = $registro["dias_solicitados"];
			$acomodacao = utf8_encode($registro["acomodacao"]);
			$qtd_respiratoria = $registro["qtd_respiratoria"];
			$qtd_motora = $registro["qtd_motora"];
			$id_imagem  = $registro["id_imagem"];
			$motivo_pro = $registro["motivo"];
					
		}
		
	}
// CONTROLE DE EXIBIÇÃO DE FORMULARIOS
	if($_SESSION["perfil"] == 'medico'){
		$exibir_medico =  'style="display: block;;"';
	}else{
		$exibir_medico =  'style="display: none;"';
	}

?>

<!-- Script calendario data -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<script src="../js/data.js"></script>	
	
	
	<link rel="stylesheet" type="text/css" href="../css/modal.css"/>
	<style type="text/css">
	<!--
	.style1 {color: #FFFFFF}
	.style13 {font-size: 10px}
	-->
	</style>


<!-- Modal -->

<div class="modal" id="labModal">
	<div class="modal-dialog" style="margin-left:5%; width:100%">	
<div class="modal-content" style="width:50%">
		<div class="modal-header">			 	 
			  <span class="close" onclick="fecharProModal()" >&times;</span>			  	   
		</div>
		<div class="modal-body" >
        <form nome="internacao_prorrogacao_cadastro" id="internacao_prorrogacao_cadastro" action="internacao_prorrogacao_cadastro.php" method="post" class="form-group" enctype="multipart/form-data">
              
                <div align="center">
                  <div class="form-group">


<!-- FORMULÁRIO DE SOLICITAÇÃO DE PRORROGAÇÃO DE INTERNAMENTO -->
<table width="100%" border="0" align="center">
                          
                            <tr>
                              <td colspan="6" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              <div align="center">SOLICITAÇÃO DE PRORROGAÇÃO </div></td>
                            </tr>
                            <tr>
                              <td width="13%">&nbsp;</td>
                              <td width="34%">&nbsp;</td>
                              <td width="4%">&nbsp;</td>
                              <td width="10%">&nbsp;</td>
                              <td width="8%">&nbsp;</td>
                              <td width="31%">&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td colspan="6" ></td>
                            </tr>
                            <tr>
                              <td colspan="6" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="4"><span class="style13">Médico solicitante </span><br />
                                <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_pro)) { echo "value='".$medico_pro."' readonly"; }  ?> /></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">CRM </span><br />
                                <input name="crm" id ="crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($crm_pro)) { echo "value='".$crm_pro."' readonly"; }   ?>/></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2"><span class = 'style13'>Data Inicial </span> <br />
								<?php
									if(isset($data_inicial)){
									echo ' <input class="form-control" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required value="'.formatar_banco_data($data_inicial).'" readonly /> ';
									}else{
									echo ' <input id="data_inicial" name="data_inicial" class="form-control"   type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required   /> ';
									}
								?>
                                
								
								</td>
                              <td>&nbsp;</td>
                              <td colspan="3"><span class="style13">Data Final </span><br />
							  <?php
								if(isset($data_final)){
                                	echo ' <input class="form-control" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required value="'.formatar_banco_data($data_final).'" readonly /> ';
								}else{
									echo ' <input  id="data_final" name="data_final" onchange="calcularData()" class="form-control" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required  />';
									}
							  ?>
								</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>	
	                           <td colspan="2"><span class="style13">Qtd Diárias</span><br />
							   <?php
							if(isset($dias) ){
                             	echo ' <input type="text" class="form-control input-sm" style="font-size: 10px" size="44" value="'.$dias.'" readonly />';
							}else{
								echo ' <input name="dias" id ="dias" type="text" class="form-control input-sm" style="font-size: 10px" size="44" readonly />';
							}
							  ?>
							  </td>
                              <td>&nbsp;</td>
                              <td colspan="3" ><p id= "aviso1" > </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2"><span class="style13">Acomodação</span><br />
                                <select name='id_acomodacao' class='form-control input-sm' >
                                  <?php 
				   $sql = 'SELECT * FROM `acomodacao`';
				   $stmt1 = $pdo->prepare($sql);
				   $stmt1->execute();

                    while($registro = $stmt1->fetch(PDO::FETCH_ASSOC)){ 

                       echo '<option value="'.$registro["id"].'">'.utf8_encode($registro["nome"]).'</option>';
                                                                                              
                    }
                              
                  
                  ?>
                                </select></td>
                              <td></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>                              </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="6" bgcolor="#F1E07E"><div align="center">FISIOTERAPIAS</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td colspan="2"><span class = 'style13'>Qtd Respiratória </span> <br />
                                <input name="qtd_respiratoria1" id ="qtd_respiratoria1" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_respiratoria)) { echo "value='".$qtd_respiratoria."' readonly"; }   ?> /></td>
                              <td>&nbsp;</td>
                              <td colspan="3"><span class = 'style13'>Qtd Motora </span> <br />
                                <input name="qtd_motora1" id ="qtd_motora1" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_motora)) { echo "value='".$qtd_motora."' readonly"; }  ?> /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="6" bgcolor="#F1E07E"><div align="center">ARQUIVO</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="6">
								<?php
								
								if(isset($_GET['prorro']) && !empty($_GET['prorro']) ){	
								  	echo '<a class="hidden-print" href="imagem_exibir.php?id='.$id_imagem.'"  target="_blank">'.$id_imagem.'</a>'; 
								}else{
									echo '
									<span class = "style13">Anexar a imagem da solicitação </span> </span>
                                <br />
									
									<div class="mb-3">
											<input class="form-control form-control-sm" id="formFileSm" type="file" name="imagem" required >
										  </div>';
								}
									
								  ?>
							 </td>
                            </tr>
                            <tr>
                              <td colspan="6">							  </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="6" bgcolor="#F1E07E"><div align="center">&nbsp;</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td colspan="6" ><span class="style13">Justificativa da prorrogação
                                <textarea minlength="5" required id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="internacao_prorrogacao_cadastro" <?php if (isset($medico_pro)) { echo "readonly"; }  ?> /><?php
                                        if(isset($motivo_pro)){
                                          echo $motivo_pro;
                                        }
                                        ?></textarea>
                              </span></td>
                          </tr>
                        <tr>
                          <td colspan="6" >                              </td>
          </tr>
</table>
<div> <br /></div>

<!-- ################################################################################################################################# -->

<!-- FORMULÁRIO DE AUTORIZAÇÃO DA PRORROGAÇÃO DE INTERNAMENTO  -->
<div class="alert alert-danger"  <?php echo $exibir_medico; ?> >
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
		<!-- DADOS DE ENVIO PRORROGAÇÃO -->
			<!-- IMAGEM -->
			<input type="hidden" name="id"            value="<?php echo $_GET['id']; ?>" /> 
          	<input type="hidden" name="evento"        value="int" /> 
			<input type="hidden" name="descricao"     value="Solicitação médica de prorrogação" />  
          	<input type="hidden" name="MAX_FILE_SIZE" value="99999999" />  
			<input type="hidden" name="url"           value="<?php echo $_SERVER['REQUEST_URI']; ?>" /> 
        	<input type="hidden" name="status"           value="<?php if(isset($exibir_credenciado)){ echo 1;}else{ echo 2; } ?>" /> 	    
                </div>
                </div>
        	     <!-- /Conteúdo Modal -->
			  
				 
        		 </div>
				  <div class="modal-footer" style="background-color: red;">
            <button id="cancelar" onclick="fecharProModal()" type="button" class="btn btn-default" data-dismiss="modal" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" >
        		 		Cancelar 
        		</button>
        		<button type="submit" class="btn btn-default" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" /> Incluir 
            </button>
        	</div>	
      </div>
      ...
</div>
</form> 

				
<!-- SCRIPT DE CONTROLE DO MODAL -->			
<script>
	function abrirProModal() {
	   document.getElementById('labModal').style.display = "block";
	}
	function fecharProModal() {
	   document.getElementById('labModal').style.display = "none";
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
<?php				
		if(isset($_GET['prorro']) ){
			if($_GET['prorro'] >= 0 && $_GET['prorro'] <> 'x' && !isset($_GET['pagina']) ){	
				echo "
					<script>
						document.getElementById('labModal').style.display = 'block';
					</script>
					";
			}
		
		}
?>		