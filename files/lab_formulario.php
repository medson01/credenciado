 <?php 
 /*	
 	Lançamentos dos Laboratórios:
 	- Apos a biometria ainda não tem status, pq eles são apenas do processo.
 	- Após o promeiro procedimento o status em $_session["status"] é 1.
	- Após solicitado pelo saloratório ele fica com status 2 no banco, porém no link ele não aparece, apartir da lista;
	- No formulário para o laboratório fica no campo autorizado em banco, porém no perfil callcenter fica com chekbox;
	
 
 */ 


 ?>
<script>
function maiuscula() {
  let x = document.getElementById("medico_solicitante");
  let y = document.getElementById("codsig");
  
  // SÓ PERMITE LETRAS NO CAMPO codsig
  y.addEventListener("keypress", function(e) {
    var keyCode = (e.keyCode ? e.keyCode : e.which);
	  if (keyCode > 47 && keyCode < 58) {
		e.preventDefault();
	  }
	});
	
  x.value = x.value.toUpperCase();
  y.value = y.value.toUpperCase();
}
</script> 
 
<script>
function pegarMedico() {
  var id_especialidade = document.getElementById("id_especialidade").value;
  var cr = document.getElementById("cr").value;
	window.location.href = "verificar_medico.php?id_especialidade="+id_especialidade+"&cr="+cr;
}
</script>
	
<script type="text/javascript">
  $("#matricula1").mask("00000000.000000-00");
  $("#matricula2").mask("00000000.000000-00");
  $("#cod_procedimento").mask("00000000");
  $("#quantidade").mask("00");
</script>

<script>
function pegarMatricula() {
  var matric = document.getElementById("matricula").value;
  window.location.href = "verficar_matricula.php?lab=<?php echo $_GET['lab']; ?>&matric="+matric;
}
</script>



<div class="hidden-print">
  <p>
    <style type="text/css">
<!--
.style3 {color: #000000}
.style5 {color: #000000; font-weight: bold; }
.style13 {font-size: 10px}

input[type=checkbox]
{
  /* Tamanho checkbox */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 8px;
}

-->
                     </style>

  <div >
					  
<?php  

 require_once "../func/calc_idade.php";

 if( !empty($_GET['id'])  ){
 
    $sql = "SELECT 
              sadt.status, sadt.id, sadt.id_credenciado, sadt.id_especialidade,sadt.id_profissional_saude,sadt.data_sadt, sadt.data_aut, sadt.medico_solicitante, sadt.cr, sadt.operador,sadt.codsig,
              sadt.senha,sadt.motivo,sadt.motivo_retorno,sadt.n_autorizacao,
              beneficiarios.nome, beneficiarios.matricula, beneficiarios.tipreg, beneficiarios.data_nascimento, beneficiarios.deficiente,  beneficiarios.data_inclusao,
              credenciado.codigo, credenciado.nome as nome_cred, 
              usuarios.nome AS nome_usuario, usuarios.perfil
               FROM `sadt` 
              INNER JOIN beneficiarios on beneficiarios.id = sadt.id_beneficiario 
              LEFT JOIN credenciado on credenciado.id = sadt.id_credenciado 
              INNER JOIN usuarios on usuarios.id = sadt.id_usuario
              LEFT  JOIN profissional_saude on profissional_saude.id = sadt.id_profissional_saude 
              WHERE sadt.id =".$_GET['id'];

	$stmt = $pdo->prepare($sql);
	
	$stmt->execute();
	 
	while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){  
			$guia = $registro["id"]; 					
            $matricula = $registro["matricula"];
			$nome = $registro["nome"];
			$data_nasc  = $registro["data_nascimento"];
			$data_inclusao  = $registro["data_inclusao"];
			$deficiente = $registro["deficiente"];
			$nome_cred = $registro["nome_cred"];
			$data_sadt = $registro["data_sadt"];
			$operador = $registro["operador"];
			$senha = $registro["senha"];
			$status = $registro["status"];
			$tipreg = $registro["tipreg"];
			$motivo = $registro["motivo"];
			$motivo_retorno = $registro["motivo_retorno"];
      		$nome_usuario = $registro["nome_usuario"];		  
      		$perfil_bd = $registro["perfil"];  
      		$data_aut = $registro["data_aut"];  
      		$motivo  = $registro["motivo"];
      		$cr = $registro["cr"];
            $medico_solicitante = $registro["medico_solicitante"];
           	$id_especialidade = $registro["id_especialidade"];
           	$codsig = $registro["codsig"];  
            $n_autorizacao = $registro["n_autorizacao"];       
                    

								  								       				     		 
   		}
	// JUNTAR AS MATRÍCULAS COM O CODIGO DA FAMIILIA
			$matricula = "00010001".$matricula."-".$tipreg; 
			
		
	}else{

	// VARIÁVEIS VINDA DO ARQUIVO verificar_matricuala.php. 
		if( (isset($_GET['matricula']) && ( $_GET['id'] == 0) )){

		  	$matricula = isset($_GET['matricula'])? $_GET['matricula'] : '';
			$id_beneficiarios = isset($_GET['id_beneficiarios'])? $_GET['id_beneficiarios'] : '';
			$nome =	isset($_GET['paciente'])? $_GET['paciente'] : '';
			$data_nasc= isset($_GET['data_nascimento'])? $_GET['data_nascimento'] : '';
			$deficiente = isset($_GET['deficiente'])? $_GET['deficiente'] : '';
      		$data_sadt = date('d / m / Y, H:i:s\h\s');
			$data_inclusao =  date('d / m / Y',strtotime($_GET['data_inclusao']));
			//$_SESSION["data_inclusao"] = $data_inclusao;

  			$_SESSION["url"] = $_SERVER["REQUEST_URI"];
		}		
	}
  

	// VARIÁVEIS VINDA DO ARQUIVO verificar_medico.php
	  if(isset($_GET['medico_solicitante'])){
	 		$medico_solicitante = isset($_GET['medico_solicitante'])? $_GET['medico_solicitante'] : '';
			$cr = isset($_GET['cr'])? $_GET['cr'] : '';
			$codsig = isset($_GET['codsig'])? $_GET['codsig'] : '';
			$id_especialidade = isset($_GET['id_especialidade'])? $_GET['id_especialidade'] : '';
			$id_profissional_saude = isset($_GET['id_profissional_saude'])? $_GET['id_profissional_saude'] : '';
			$guia = isset($_GET['id'])? $_GET['id'] : '';
	  }


				
	// MENSAGEM AGUARDANDO RESPOSTA DO CALLCENTER /
				if(isset($status) && $status == 2){
				
					echo '<div class="alert alert-success" role="alert" style="text-align:center; font-size: 14px; font-style: oblique;">
                                    Autorização solicitada! <br /> 
									Aguadando retorno do callcenter.             
                		  </div>';
				}
				if(empty($n_autorizacao) && isset($status) && $status == 3 ){
							echo '<div class="alert alert-danger " role="alert" style="text-align:center; font-size: 14px; font-style: oblique;">
											Guia negada ou cancelada! <br />
								  </div>';
				}
				
				
				
	if($_SESSION["perfil"] <> "callcenter"){
 		echo '
			<p />
			<a href="painel.php?lab='.$_GET['lab'].'&id=0"> 
				<button type="button" class="btn btn-primary" style="width:87px"> Novo </button>  
			  </a>
	        <br />
  			';
			// APAGA AS VARIAVEIS DE SESSÃO E CONTROLE PARA INSERÇÃO DE DADOS NO BANDO.
			if(empty($_GET["id"])){
				unset($_SESSION['ultimo_proc_id'], $_SESSION['last_id'], $_SESSION['last_id']);
			}
		}
		
/*		
		// TESTE DE FUNÇÃO
	require_once "../func/consulta_dia.php";
	$consulta_dia = consulta_dia(22, 29, 1, 1779 , $pdo);
		if(!empty($consulta_dia["msg"])){
			echo $consulta_dia["msg"];
			exit();
		}
*/		
		
		
		
		
			?>
   		  
        <table width="100% " border="0" align="center">
		
		                    <tr>
                              <td colspan="3" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              <div align="center"> Informações </div></td>
                            </tr>
                            <tr>
                              <td width="50%">&nbsp;</td>
                              <td width="1%">&nbsp;</td>
                              <td width="49%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3">
							  <div class="panel with panel-danger class "  >
											   <div class="panel-heading" style="width:100%; height:35px"> 
											     <div style="float:left">
												 	<strong>Número da Guia &nbsp;&nbsp;&nbsp;</strong>
											      	<strong> 


													<?php 
														echo !empty($guia) ? $guia: null;  
														if(isset($desativar)){ 
															echo $desativar;
														} 
														if(!empty($guia) && $guia<> 1){									
															 $_SESSION["url"] = $_SERVER["REQUEST_URI"];
														
														}
													
													
													?>													</strong>											     </div>
												 
												 <div style="float:right; width:50%;position:relative">
												 	<strong>Nº de autorização&nbsp; &nbsp;
														<?php 
															if (isset($n_autorizacao)){ 
																	echo $n_autorizacao; 
															}
														?>
														  </strong>
														<span style="color:#FF0000">
									                		<strong>
															
																<?php 
																if (isset($senha)){ 
																	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Senha &nbsp;&nbsp;&nbsp; ". $senha; 
																 } else {
																 echo '<div style="position: absolute; left: 130px; top: -8px;">
																 <input type="text" name="n_autorizacao" id="n_autorizacao" maxlength="32" class="form-control input-sm" style="font-size: 10px; width: 200px; text-align: right;"';
																 if($_SESSION["perfil"] == "laboratorio" || $_SESSION["perfil"] == "clinica"){
																 	echo "readonly";
																 }
																 echo' ></span></strong></div>';
																 
																 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																 <strong><span style="color:#a94442">Senha</span></strong>
																 <div style="position: absolute; left: 410px; top: -8px;">
														<span style="color:#FF0000">
									                		<strong>
<input type="text" name="senha" id="senha" maxlength="32" class="form-control input-sm" style="font-size: 10px; width: 90px; text-align: right;"';
																 if($_SESSION["perfil"] == "laboratorio" || $_SESSION["perfil"] == "clinica"){
																 	echo "readonly";
																 }
																 echo' ></div>';
																 } 
																?>
															</strong>														</span>									             </div>
						   	    </div> 
								</div>
							  </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              <div align="center"> Atendimento </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Matrícula</span><br />
							  <input type="text" name="matricula" id="matricula" minlength="16" class="form-control input-sm" style="font-size: 10px" size="44" required="required" onchange="pegarMatricula()"  <?php if (isset($matricula)) { echo "value='".$matricula."' readonly"; }  ?>>
                              <!--    <input name="matricula1" id ="matricula" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" onchange="pegarMatricula()" <?php //if (isset($_SESSION["matricula"])) { echo "value='".$_SESSION["matricula"]."' "; }  ?>  /> -->
                                  </span></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Data do atendimento</span><br />
                              <input name="data_sadt2" id ="data_sadt2" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($data_sadt)) { echo "value='".date('d / m / Y, H:i:s\h\s')."'  "; }  ?> readonly /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td ><span class="style13">Nome do usuário</span> <br />
                                <input name="nome" id ="nome" type="text" class="form-control input-sm" style="font-size: 10px" required="required" <?php if (isset($nome)) { echo "value='".$nome."' "; } ?> readonly />
                                </span></td>
								                              <td>&nbsp;</td>
                                                              <td><span class="style13">Deficiente</span> <br />
  &nbsp;
  <input type="checkbox" name="deficiente" id="deficiente" disabled="disabled"
								<?php
      									if (isset($deficiente) ) {
      										if( $deficiente == 1 ){
      											echo " value='1' checked ";
      										}else{ echo " disabled"; }
      									}
								?>>
  <br />
  </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Idade</span><br />
                                <input name="idade" id ="idade" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($data_nasc)) { echo "value='".calc_idade($data_nasc)."'  "; }  ?> readonly />
                                </span></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Data de Inclusão</span> <br />
                                <input name="data_inclusao" id ="data_inclusao" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($data_inclusao)) { echo "value='".$data_inclusao."'  "; }  ?> readonly="readonly" />
                              </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Credenciado</span><br />
                                <input name="nome_cred" id ="nome_cred" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($nome_cred)) { echo "value='".$nome_cred."' readonly "; }else { echo "value='".$_SESSION["credenciado"]."' readonly ";} ?> readonly />
                                </span></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Atendente</span><br />
                                <input name="nome_usuario" id ="nome_usuario" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($nome_usuario)) { echo "value='".$nome_usuario."'  "; }else{ echo "value='".$_SESSION["login"]."' readonly ";} ?> readonly />
                                </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
<tr>
                          <td><span class="style13">Especialidade<br>
                          </span>
  <select class="form-control input-sm" id="id_especialidade" nome="id_especialidade" required="required"  <?php  if( isset($_SESSION["status"]) || $_SESSION["status"] == 3){ echo "readonly disabled";}?> >
<?php 

  $sql = "SELECT * FROM `especialidade` ORDER BY `especialidade`.`nome` ASC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){  
     echo' <option value="'.$registro["id"].'"';
     if( (!empty($_GET['id_especialidade']) &&  $registro["id"] == $_GET['id_especialidade']) || (isset($cr) && $id_especialidade == $registro["id"]) ){
       echo 'selected'; 
      /* if(!isset($_SESSION["id_especialidade"])){
         $_SESSION["id_especialidade"] = $_GET['id_especialidade'];
         $_SESSION["medico_solicitante"] = $_GET['medico_solicitante'];
         $_SESSION["cr"] = $_GET['cr'];
         $_SESSION["codsig"] = $_GET['codsig'];
       }
	   */
     } 
     echo '>';
     echo $registro["nome"].'</option>';

     
    }
$data_aut  = isset($_POST["data_aut"]) ? $_POST["data_aut"]: 'null';
?>
  </select>						  </td>
                          <td>&nbsp; </td>
                          <td><span class="style13">CR médico solicitante<br>
                          </span>
                            <span class="style13">
                            <input name="cr" id ="cr" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" onchange="pegarMedico()" <?php if (isset($cr) || !empty($_GET['cr']) ) { echo "value='".$cr."' readonly  "; }   if(isset($desativar)){ echo $desativar;}   if(!empty($senha)){ echo "readonly"; } ?> />
        </span></td>
          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Médico solicitante</span><br />
                                  <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($medico_solicitante) &&  !empty($medico_solicitante)) { echo "value='".$medico_solicitante."' readonly  "; }    ?>  onkeyup="maiuscula()"/>
                              <td>&nbsp;</td>
                              <td><span class="style13">Sigla CR </span><br />
                                  <input id="codsig"  name="codsig" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($codsig) &&  !empty($codsig)) { echo "value='".$codsig."' readonly  "; }    ?>  onkeyup="maiuscula()" onkeypress="return numeros()" /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                        <tr>
                          <td colspan="3" >                              </td>
          </tr>
       </table>
  </div>   

    
<?php 


// GUARDA A URL NA SESSÃO POIS É DIFERENTE DO FORMULÁRIO CADASTRO
// $_SESSION["url"] = $_SERVER["REQUEST_URI"];


// PAGIAN LISTA DE PROCEDIMENTOS AUTORIZADOS 			   
         include("lab_procedimento_lista.php"); 
  
// PÁGIAN PARA AUTORIZAR PROCEDIMENTOS 

          include("lab_autorizacao_medica.php");

     
?>


  </div></div>

                </form>
				
	
				
<?php 

  //  Acesso só Modal Biometria
   if( isset($_GET['matricula']) && !isset($_GET['cod_proc']) && !isset($_GET['id_profissional_saude'])){
     include("modal_biometria.php");
   }

   echo "</div>";
 //  Acesso Modal Procedimentos
  include("lab_modal_procedimento.php"); 
 
 //  Evita que abra os dois modais só Modal Procedomento
   if(isset($_GET['cod_proc']) ){
     echo '
	   <script>
			  labModal.style.display = "block";
	   </script>
     ';
   }
?>
   
  
      
  