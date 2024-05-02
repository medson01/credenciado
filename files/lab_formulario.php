 <?php 
 /*	
 	Lançamentos dos Laboratórios:
 	- Apos a biometria ainda não tem status, pq eles são apenas do processo.
 	- Após o promeiro procedimento o status em $_session["status"] é 1.
	- Após solicitado pelo saloratório ele fica com status 2 no banco, porém no link ele não aparece, apartir da lista;
	- No formulário para o laboratório fica no campo autorizado em banco, porém no perfil callcenter fica com chekbox;
	
 
 */
 	// $_SESSION["status"]; 

 	
 ?>
<script>
function maiuscula() {
  let x = document.getElementById("medico_solicitante");
  let y = document.getElementById("codsig");
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
  window.location.href = "verficar_matricula.php?lab=1&matric="+matric;
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
  </p>
<?php  
	if($_SESSION["perfil"] <> "callcenter"){
 		echo '<a href="painel.php?lab=1&id=0"> 
				<button type="button" class="btn btn-primary" style="width:87px"> Novo </button>  
			  </a>';
		}
?>
  <br />
  <br />
  <div align="center">
					  
<?php  

 require_once "../func/calc_idade.php";

 if( !empty($_GET['id'])  ){
 
    $sql = "SELECT 
              sadt.status, sadt.id, sadt.id_credenciado, sadt.id_especialidade,sadt.id_profissional_saude,sadt.data_sadt, sadt.data_aut, sadt.medico_solicitante, sadt.cr, sadt.operador,sadt.codsig,
              sadt.senha,sadt.motivo,sadt.motivo_retorno,sadt.n_autorizacao,
              beneficiarios.nome, beneficiarios.matricula, beneficiarios.tipreg, beneficiarios.data_nascimento, beneficiarios.deficiente,  
              credenciado.codigo, credenciado.nome AS nome_cred, 
              usuarios.nome AS nome_usuario, usuarios.perfil
               FROM `sadt` 
                INNER JOIN beneficiarios on beneficiarios.id = sadt.id_beneficiario 
                INNER JOIN credenciado on credenciado.id = sadt.id_credenciado 
              INNER JOIN usuarios on usuarios.id = sadt.id_usuario
              LEFT  JOIN profissional_saude on profissional_saude.id = sadt.id_profissional_saude 
              WHERE sadt.id =".$_GET['id'];

	$stmt = $pdo->prepare($sql);
	
	$stmt->execute();
	 
	while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){  
			$_SESSION["guia"] = $registro["id"]; 					
            $_SESSION["matricula"] = $registro["matricula"];
			$_SESSION["nome"] = $registro["nome"];
			$_SESSION["data_nasc"]  = $registro["data_nascimento"];
			$_SESSION["deficiente"] = $registro["deficiente"];
			$_SESSION["nome_cred"] = $registro["nome_cred"];
			$_SESSION["data_sadt"] = $registro["data_sadt"];
			$_SESSION["operador"] = $registro["operador"];
			$_SESSION["senha"] = $registro["senha"];
			$_SESSION["status"] = $registro["status"];
			$_SESSION["tipreg"] = $registro["tipreg"];
			$_SESSION["motivo"] = $registro["motivo"];
			$_SESSION["motivo_retorno"] = $registro["motivo_retorno"];
      		$_SESSION["nome_usuario"] = $registro["nome_usuario"];		  
      		$_SESSION["perfil_bd"] = $registro["perfil"];  
      		$_SESSION["data_aut"] = $registro["data_aut"];  
      		$_SESSION["motivo"]  = $registro["motivo"];
      		$_SESSION["cr"] = $registro["cr"];
            $_SESSION["medico_solicitante"] = $registro["medico_solicitante"];
           	$_SESSION["id_especialidade"] = $registro["id_especialidade"];
           	$_SESSION["codsig"] = $registro["codsig"];  
            $_SESSION["n_autorizacao"] = $registro["n_autorizacao"];       
                    

								  								       				     		 
   		}
		
			if(!isset($_GET['cod_proc']) && (isset($_SESSION["matricula"])) ){
				$_SESSION["matricula"] = "0001.0001".$_SESSION["matricula"]; 
			}
		
	}else{

		if( (isset($_GET['matricula']) && ( $_GET['id'] == 0) )){
		
		  $matricula = $_GET['matricula'];
      $_SESSION["matricula"] = $matricula;

      $id_beneficiarios = $_GET['id_beneficiarios'];
      $_SESSION["id_beneficiarios"] = $id_beneficiarios;

			$nome =	$_GET['paciente'];
      $_SESSION["nome"] = $nome;

			$data_nasc= $_GET['data_nascimento'];
      $_SESSION["data_nasc"] = $data_nasc;

			$deficiente = $_GET['deficiente'];
      $_SESSION["deficiente"] = $deficiente;

     // $data_inclusao = $_GET['data_inclusao'];
     //$_SESSION["data_inclusao"] = $data_inclusao;

			$data_sadt = date('d / m / Y, H:i:s\h\s');
      $_SESSION["data_sadt"] = $data_sadt;

   $_SESSION["url"] = $_SERVER["REQUEST_URI"];
		}
	}
  


	  if(isset($_GET['medico_solicitante'])){
	 		 	$medico_solicitante = $_GET['medico_solicitante'];
      	$_SESSION["medico_solicitante"] = $medico_solicitante;
	  }
	  if(isset($_GET['cr'])){
	  $cr = $_GET['cr'];
      $_SESSION["cr"] = $cr;
    }
	  if(isset($_GET['codsig'])){
	  $codsig = $_GET['codsig'];
      $_SESSION["codsig"] = $codsig;
    }

    if(isset($_GET['id_especialidade'])){
	  $id_especialidade = $_GET['id_especialidade'];
      $_SESSION["id_especialidade"] = $id_especialidade;
    }

    if(isset($_GET['id_profissional_saude'])){
    $id_profissional_saude = $_GET['id_profissional_saude'];
    $_SESSION["id_profissional_saude"] = $id_profissional_saude;
    }

    if(isset($_GET['id'])){
    $guia = $_GET['id'];
    $_SESSION["guia"] = $guia;
    }


    if( empty($_GET['id']) &&  !isset($_GET['matricula']) ){

     unset($_SESSION["matricula"], $tipreg, $_SESSION["nome"],  $_SESSION["data_nasc"], $_SESSION["deficiente"],  $_SESSION["data_sadt"] , $_SESSION["status"], $_SESSION["senha"], $_SESSION["data_aut"], $_SESSION["perfil_bd"], $_SESSION["motivo"], $_SESSION["nome_cred"], $_SESSION["nome_usuario"],$_SESSION["operador"], $_SESSION["url"], $_SESSION["id_beneficiarios"] , $_SESSION['last_id'], $_SESSION["codsig"], $_SESSION["cr"] , $_SESSION["id_especialidade"],$_SESSION["medico_solicitante"], $_SESSION["guia"],$_SESSION["data_inclusao"],$_SESSION["n_autorizacao"], $registro["motivo_retorno"]);  
    }
    else{ 
      if( isset($_SESSION["matricula"])){
        $matricula = $_SESSION["matricula"];
      }

    }



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
														echo !empty($_SESSION["guia"]) ? $_SESSION["guia"]: null;  
														if(isset($desativar)){ 
															echo $desativar;
														} 
														if(!empty($_SESSION["guia"]) && $_SESSION["guia"]<> 1){
														
															 $_SESSION["url"] = $_SERVER["REQUEST_URI"];
														
														}
													
													
													?>													</strong>											     </div>
												 
												 <div style="float:right; width:50%;position:relative">
												 	<strong>Nº de autorização&nbsp; &nbsp;
														<?php 
															if (isset($_SESSION["n_autorizacao"])){ 
																	echo $_SESSION["n_autorizacao"]; 
															}
														?>
														  </strong>
														<span style="color:#FF0000">
									                		<strong>
															
																<?php 
																if (isset($_SESSION["senha"])){ 
																	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Senha &nbsp;&nbsp;&nbsp; ". $_SESSION["senha"]; 
																 } else {
																 echo '<div style="position: absolute; left: 130px; top: -8px;">
																 <input type="text" name="n_autorizacao" id="n_autorizacao" maxlength="32" class="form-control input-sm" style="font-size: 10px; width: 200px; text-align: right;"';
																 if($_SESSION["perfil"] == "laboratorio"){
																 	echo "readonly";
																 }
																 echo' ></span></strong></div>';
																 
																 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																 <strong><span style="color:#a94442">Senha</span></strong>
																 <div style="position: absolute; left: 410px; top: -8px;">
														<span style="color:#FF0000">
									                		<strong>
<input type="text" name="senha" id="senha" maxlength="32" class="form-control input-sm" style="font-size: 10px; width: 90px; text-align: right;"';
																 if($_SESSION["perfil"] == "laboratorio"){
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
							  <input type="text" name="matricula" id="matricula" minlength="16" class="form-control input-sm" style="font-size: 10px" size="44" required="required" onchange="pegarMatricula()"  <?php if (isset($_SESSION["matricula"])) { echo "value='".$_SESSION["matricula"]."' readonly"; }  ?>>
                              <!--    <input name="matricula1" id ="matricula" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" onchange="pegarMatricula()" <?php //if (isset($_SESSION["matricula"])) { echo "value='".$_SESSION["matricula"]."' "; }  ?>  /> -->
                                  </span></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Data do atendimento</span><br />
                              <input name="data_sadt2" id ="data_sadt2" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($_SESSION["data_sadt"])) { echo "value='".date('d / m / Y, H:i:s\h\s', strtotime($_SESSION["data_sadt"]))."'  "; }  ?> readonly /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td ><span class="style13">Nome do usuário</span> <br />
                                <input name="nome" id ="nome" type="text" class="form-control input-sm" style="font-size: 10px" required="required" <?php if (isset($_SESSION["nome"])) { echo "value='".$_SESSION["nome"]."' "; } ?> readonly />
                                </span></td>
								                              <td>&nbsp;</td>
                                                              <td><span class="style13">Deficiente</span> <br />
  &nbsp;
  <input type="checkbox" name="deficiente" id="deficiente" disabled="disabled"
								<?php
      									if (isset($_SESSION["deficiente"]) ) {
      										if( $_SESSION["deficiente"] == 1 ){
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
                                <input name="idade" id ="idade" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($_SESSION["data_nasc"])) { echo "value='".calc_idade($_SESSION["data_nasc"])."'  "; }  ?> readonly />
                                </span></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Credenciado</span><br />
                                <input name="nome_cred" id ="nome_cred" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($_SESSION["nome_cred"])) { echo "value='".$_SESSION["nome_cred"]."' readonly "; }else { echo "value='".$_SESSION["credenciado"]."' readonly ";} ?> readonly />
                                </span></td>
                              <td>&nbsp;</td>
                              <td><span class="style13">Atendente</span><br />
                                <input name="nome_usuario" id ="nome_usuario" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($_SESSION["nome_usuario"])) { echo "value='".$_SESSION["nome_usuario"]."'  "; }else{ echo "value='".$_SESSION["login"]."' readonly ";} ?> readonly />
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
     if( (!empty($_GET['id_especialidade']) &&  $registro["id"] == $_GET['id_especialidade']) || (isset($_SESSION["cr"]) && $_SESSION["id_especialidade"] == $registro["id"]) ){
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
                          <td><span class="style13">CR<br>
                          </span>
                            <span class="style13">
                            <input name="cr" id ="cr" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" onchange="pegarMedico()" <?php if (isset($_SESSION["cr"]) || !empty($_GET['cr']) ) { echo "value='".$_SESSION["cr"]."' readonly  "; }   if(isset($desativar)){ echo $desativar;}   if(!empty($_SESSION["senha"])){ echo "readonly"; } ?> />
                            </span></td>
                        </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">Médico solicitante</span><br />
                                  <input id="medico_solicitante"  name="medico_solicitante" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($_SESSION["medico_solicitante"]) &&  !empty($_SESSION["medico_solicitante"])) { echo "value='".$_SESSION["medico_solicitante"]."' readonly  "; }    ?>  onkeyup="maiuscula()"/>
                              <td>&nbsp;</td>
                              <td><span class="style13">Sigla CR </span><br />
                                  <input id="codsig"  name="codsig" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($_SESSION["codsig"]) &&  !empty($_SESSION["codsig"])) { echo "value='".$_SESSION["codsig"]."' readonly  "; }    ?>  onkeyup="maiuscula()"/></td>
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
   
  
      
  