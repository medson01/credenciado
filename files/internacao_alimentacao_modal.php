<?php

// FORMATA A DATA QUE ESTÁ NO FORMATO ENG PARA BR NO BANCO
	require_once "../func/formatar_data_banco.php";
	
	if(isset($_GET['ali'])){	
	 $sql="SELECT prorrogacao.id as id_prorrogacao, prorrogacao.data_inicial_aut,prorrogacao.data_final_aut,prorrogacao.dias_autorizados, 
  imagem.id as id_imagem, imagem.nome, imagem , 
  alimentacao.id AS id_alimentacao, alimentacao.medico_solicitante,alimentacao.crm, alimentacao.nutrologo, alimentacao.crm_rqe, alimentacao.qtd_diarias, alimentacao.terapia_nutricial,alimentacao.por_dia, alimentacao.motivo_solicitacao, alimentacao.data_inicial, alimentacao.data_final,alimentacao.data_sol_alimentacao,  alimentacao.medico_aut, alimentacao.motivo_autorizacao ,alimentacao.status 
  FROM alimentacao 
  INNER JOIN prorrogacao ON prorrogacao.id = alimentacao.id_prorro
  INNER JOIN imagem on imagem.id_prorrogacao = prorrogacao.id 
  WHERE alimentacao.id =".$_GET['ali'];
	
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		while($registro = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$id_prorrogacao = $registro["id_prorrogacao"];
			$medico_solicitante = $registro["medico_solicitante"];
			$ali_crm = $registro["crm"];
			$nutrologo = $registro["nutrologo"];
			$crm_rqe = $registro["crm_rqe"];
			$data_inicial_aut = $registro["data_inicial_aut"];
			$data_final_aut = $registro["data_final_aut"];
			$dias_autorizados = $registro["dias_autorizados"];			
			$qtd_diarias = $registro["qtd_diarias"];		
			$terapia_nutricial = utf8_encode($registro["terapia_nutricial"]);			
			$por_dia =  $registro["por_dia"];
			$id_imagem  = $registro["id_imagem"];
			$motivo_solicitacao = $registro["motivo_solicitacao"];
			$motivo_autorizacao = $registro["motivo_autorizacao"];
			$status = $registro["status"];
			
					
		}	
	}else{

		if(isset($_GET['id_prorro'])){
			echo $sql="SELECT 
			  id_prorro, SUM(qtd_diarias_aut) AS qtd_diarias_aut
			FROM alimentacao 
			WHERE alimentacao.id_prorro  =".$_GET['id_prorro'];
	
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			while($registro = $stmt->fetch(PDO::FETCH_ASSOC)) { 
				$qtd_diarias_aut = $registro["qtd_diarias_aut"];
		
			}
		
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


    <style>
        input.largerCheckbox {
            width: 40px;
            height: 20px;
        }
    .style13 {font-size: 10px}
    .style14 {color: #FFFFFF}
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
                              <div align="center">ALIMENTA&Ccedil;&Atilde;O Nº <?php if(isset($_GET['ali'])){ echo $_GET['ali']; } ?></div></td>
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
                                  <input id="medico_solicitante_ali"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_solicitante)) { echo "value='".$medico_solicitante."' readonly"; }   if(isset($desativar)){ echo $desativar;} ?> /></td>
                              <td>&nbsp;</td>
                              <td colspan="4"><span class="style13">CRM </span><br />
                                  <input name="ali_crm" id ="ali_crm" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($ali_crm)) { echo "value='".$ali_crm."' readonly"; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
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
                                  <input id="nutrologo"  name="nutrologo" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($nutrologo)) { echo "value='".$nutrologo."' readonly"; }   if(isset($desativar)){ echo $desativar;} ?> />
                                  </span></td>
                              <td>&nbsp;</td>
                              <td colspan="4"><span class="style13"> CRM/RQE </span><br />
                                  <input name="crm_rqe" id ="crm_rqe" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($crm_rqe)) { echo "value='".$crm_rqe."' readonly"; }  if(isset($desativar)){ echo $desativar;} ?>/>
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
											$data1 = formatar_banco_data($_GET['data_inicial']);
											$data2 = formatar_banco_data($_GET['data_final']);
										}else{
											$data1 = formatar_banco_data($data_inicial_aut);
											$data2 = formatar_banco_data($data_final_aut);
										}									
									echo ' <input class="form-control" style="margin-left: 60px;" name="data_inicial" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required value="'.$data1.'" readonly /> ';
									
								?></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="3"><span class="style13">Data Final </span><br />
                                  <?php
								
                                	echo ' <input class="form-control" type="text"  data-date-format="mm/dd/yyyy" maxlength="10"size="10" required value="'.$data2.'" readonly /> ';
							
							  		?>									</td>
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
							
                             	echo ' <input  style="margin-left: 60px;" name="dias_autorizados" type="text" class="form-control input-sm" style="font-size: 10px" size="44" ';
								if (isset($qtd_diarias)) {
									echo "value='".$dias_autorizados."' "; 
							   	}else{
									echo "value='".$_GET['dias_autorizados']."' ";
								}
								echo '" readonly />';	
							
							  ?></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Prorrogação Nº </span><br /> <?php if(isset($id_prorrogacao)){ echo $id_prorrogacao; }else{ echo $_GET['id_prorro']; }?></td>
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
                              <td colspan="10" bgcolor="#F1E07E"><div align="center"><span>DIÁRIAS </span>DE ALIMENTAÇÃO </div></td>
                            </tr>
                            <tr>
                              <td colspan="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center">
                                <select id='qtd_diarias' name='qtd_diarias' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" style="width:50px">
                                  <?php
								    $dias_autorizados = $_GET['dias_autorizados']; // QTD AUTORIDADO NA PRORROGAÇÃO
									
								  	if(!isset($_GET['dias_autorizados'])){
										// VALOR JÁ AUTORIZADO
										echo "<option value='".$qtd_diarias."'>".$qtd_diarias."</option>";
									}else{
										// VALOR PARA AUTORIZAR
										if(isset($qtd_diarias_aut) && empty($qtd_diarias_aut)){//QTD AUTORIZADO DENTRO DA ALIMENTAÇÃO
											$dias_autorizados = $dias_autorizados - $qtd_diarias_aut;
										}  
										
										 for ($i=0; $i <= $dias_autorizados; $i++) {
											echo "<option value='".$i."'>".$i."</option>";
										 }
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
					
							  	

                                <input name="vias" type="radio" class="largerCheckbox" id="checkbox" value="Nutricional, TNO" required="required" <?php if(isset($terapia_nutricial) && $terapia_nutricial == "Nutricional, TNO"){ echo ' checked disabled'; } ?> />
                                <span > Via Oral (TNO) </span> </div></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="4"><div class="form-check">
                                <div class="form-check">
                                  <input name="vias" type="radio" class="largerCheckbox" id="radio" value="Enteral,  SNE" <?php if(isset($terapia_nutricial) && $terapia_nutricial == "Enteral,  SNE"){ echo ' checked disabled'; } ?> />
                                <span > Via Sonda Nasoenteral (SNE) </span> </div></td>
                              <td colspan="3"><div class="form-check">
                                <div class="form-check">
                                  <input name="vias" type="radio" class="largerCheckbox" id="radio2" value="Periférica,  NPP" <?php if(isset($terapia_nutricial) && $terapia_nutricial == "Parenteral,  NPP"){ echo ' checked disabled'; } ?>/>
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
                              <td colspan="10" bgcolor="#F1E07E"><div align="center"><span>QUANTIDADE  <span>DE ALIMENTAÇÃO</span> POR DIA  </span></div></td>
                            </tr>
                            <tr>
                              <td colspan="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="10"><div align="center">
                                <select onchange="totalAlimentacao()" id='por_dia' name='por_dia' class='form-control input-sm' <?php if(isset($desativar)){ echo $desativar;} ?> required="required" style="width:50px" >
                                  <?php
								  	if(isset($por_dia)){
										echo "<option value='".$por_dia."'>".$por_dia."</option>";
									}else{
										for ($i=0; $i <= 4; $i++) {
											echo "<option value='".$i."'>".$i."</option>";
										 }
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
                                <input   style="text-align:center; font-size: large; color:#FF0000; font-weight: bolder;" id="total_alimentacao" name="total_alimentacao" type="text" class="form-control input-sm" size="44" readonly <?php if(isset($por_dia)){ $w = $por_dia*$dias_autorizados; echo 'value="'.$w.'"'; } ?> />
							  
							  
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
								
								<div align="center">
								  <?php
								
								if(isset($_GET['ali']) && !empty($_GET['ali']) ){	
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
						         </div>												 </td>
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
                              <td colspan="10" class="style13" >Justificativa da alimentação
                                <textarea minlength="5" required id="motivo_ali" class="form-control input-sm" name="motivo_ali"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;"  <?php if (isset($motivo_solicitacao) ) { echo "readonly"; }  ?> /><?php
                                        if(isset($motivo_solicitacao)){
                                          echo $motivo_solicitacao;
                                        }
                                        ?></textarea>                              </td>
                          </tr>
                            <tr>
                              <td colspan="10">&nbsp;</td>
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
                          <td colspan="3" bordercolor="#999999" bgcolor="#999999">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3" bordercolor="#999999" bgcolor="#999999">
                          <div align="center" style="width:100%">Autorização Médica </div>                          </td>
                        </tr>
                        <tr>
                          <td width="49%">&nbsp;</td>
                          <td width="3%">&nbsp;</td>
                          <td width="48%">&nbsp;</td>
                        </tr>
                        <tr>  
                          <td><span  id="t1"  class="style13"> Diárias</span> <br />
                          <input name="dias_autorizados" id ="dias_autorizados" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($dias_autorizados)) { echo "value='".$dias_autorizados."' readonly"; } ?>/></td><td>&nbsp;</td>
						  <td><span class = 'style13'>Qtd de Alimentações por Dia </span><br />
                          <input name="por_dia_aut" id ="por_dia_aut" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($por_dia_aut)) { echo "value='".$por_dia_aut."' readonly "; }else{ echo "value='".$por_dia."'  "; } ?>/></td>
          <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
          </tr>          
                        <tr>
                         <td colspan="3" >
                             <span class="style13">Justificativa do médico</span>
                                <textarea id="medico_aut" class="form-control input-sm" name="medico_aut"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;"   /><?php
                                        if(isset($motivo_autorizacao)){
                                          echo $motivo_autorizacao;
                                        }
                                        ?></textarea>                         </td> 
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
                         <td></td>
        </tr>

</table>
		<!-- DADOS DE ENVIO ALIMENTAÇÃO -->
			<!-- IMAGEM --> 
			<input type="hidden" name="id_usuario"    value="<?php echo $_SESSION["id"]; ?>" />	
			<input type="hidden" name="id"            value="<?php echo $_GET['id']; ?>" /> 
			<input type="hidden" name="id_prorro"     value="<?php echo $_GET['id_prorro']; ?>" />    
      <input type="hidden" name="id_ali"     value="<?php echo $_GET['ali']; ?>" /> 		
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
				<a onclick="naoAutorizar(<?php echo $_GET['id'].",".$_GET['ali'];?>)">
				<span  class="btn btn-default" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb; <?php if( $_SESSION['perfil'] <> 'medico') { echo 'display:none;';} ?> " /> 
						Não autorizar 
				</span></a>
        		<button type="submit" class="btn btn-default" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb; <?php if( (isset($_GET['ali']) && $_SESSION['perfil'] == 'alimentacao') || $status == 2 ) { echo 'display:none;';} ?> " /> 
				<?php if($_SESSION['perfil'] == 'medico'){ echo 'Autorizar'; }else{echo 'Solicitar';} ?> 
				</button>
        	</div>	
      </div>
      ...
</div>
</form>

<!-- NEGAR AUTORIZAÇÃO -->
<script>
function naoAutorizar(id_internacao, id_ali ) {
	var motivo_autorizacao = document.getElementById("medico_aut").value;
	if (confirm("Você deseja realmente negar a solicitação?")) {
	  window.location.href="internacao_prorrogacao_cadastro.php?negar=1&id_internacao="+id_internacao+"&id_ali="+id_ali+"&motivo_autorizacao="+motivo_autorizacao; 
	}   
}
</script>

<!-- LETRAS MAÚSCULAS --> 
 <script type="text/javascript">
$("#medico_solicitante_ali").on("input", function(){
	$(this).val($(this).val().toUpperCase());
}); 
$("#nutrologo").on("input", function(){
	$(this).val($(this).val().toUpperCase());
});
$("#medico_aut").on("input", function(){
	$(this).val($(this).val().toUpperCase());
});
$("#motivo_ali").on("input", function(){
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
				
<!-- SCRIPT DE CONTROLE DE MODAL -->			
<script>
document.onload(funcaoPaginaCarregada());

function funcaoPaginaCarregada() {
	const urlParams = new URLSearchParams(window.location.search);
	const alimentacao1 = urlParams.get("id_prorro") 
	const alimentacao2 = urlParams.get("ali") 
		if(alimentacao1 > 0 || alimentacao2 > 0){
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