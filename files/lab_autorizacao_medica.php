<!--- Script Editor Tyni 
<script src="https://cdn.tiny.cloud/1/g6yfrv8h3mboxcs64w2fsjcq5zepdftkos7l8j14s4u9d339/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
<?php
/*
  if(!empty($_SESSION["senha"])){ 
    echo '<script src="../js/editortyni_readonly.js"></script>';
  }else{
     echo '<script src="../js/editortyni_read.js"></script>';
  }
*/
?>

<!-- Remove os espaços no textarea -->
<script>
	$(function () {
	  $('#motivo_retorno').on('input', function () {
		var texto = $(this).val();
		texto = texto.replace(/^\s+|\s+$/g,"");
		
		$('#motivo_retorno').val(texto);
	  });
	});
	
	$(function () {
	  $('#motivo').on('input', function () {
		var texto = $(this).val();
		texto = texto.replace(/^\s+|\s+$/g,"");
		
		$('#motivo').val(texto);
	  });
	});
</script>


<!-- Editor Tyni -- FIM --> 
<table width="100% " border="0" align="center" style="<?php if(isset($exibir)){ echo $exibir; }?>" >


<!-- ############     autorização do médico ##############-->
                      <!-- Cabeçalho de autorização médica-->


                        <tr>
                          <td colspan="3" bgcolor="#CCCCCC">

                          <div align="center"><strong>Justificativa da solicitação</strong></div>                          </td>
                        </tr>
                        <tr>
                          <td width="49%">&nbsp;</td>
                          <td width="3%">&nbsp;</td>
                          <td width="48%">&nbsp;</td>
                        </tr>          
                        <tr>

                          <td colspan="3" ><textarea id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="motivo" <?php 				
                                        if(isset($_SESSION["motivo"])){
											if($_SESSION["motivo"] == "null"){
                                          		echo "";
										  	}else{
												echo "disabled";
											}
                                        }
			?> 
			/>
										<?php
                                        if(isset($_SESSION["motivo"])){
											if($_SESSION["motivo"] == "null"){
                                          		echo "";
										  	}else{
												echo ltrim($_SESSION["motivo"]);
											}
                                        }
                                        ?>                  
                                </textarea>                          </td> 
                        </tr>
                                <input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" />

                        
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

       <table width="100% " border="0" align="center" style="<?php if(isset($exibir)){ echo $exibir; }?>" >


<!-- ############     autorização do médico ##############-->
                      <!-- Cabeçalho de autorização médica-->


                        <tr>
                          <td colspan="3" bgcolor="#CCCCCC">

                          <div align="center"><strong>Retono SADT</strong></div>                          </td>
                        </tr>
                        <tr>
                          <td width="49%">&nbsp;</td>
                          <td width="3%">&nbsp;</td>
                          <td width="48%">&nbsp;</td>
                        </tr>          
                        <tr>
					
						
                          <td colspan="3" ><textarea id="motivo_retorno" class="form-control input-sm" name="motivo_retorno"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="sadt" <?php 
						 if($_SESSION["perfil"] == "callcenter"){	
						  if(isset($_SESSION["motivo_retorno"])){
								if($_SESSION["motivo_retorno"] == "null"){
								   echo "";
								}else{
								   echo "disabled";
								}
                         }
						}else{
								 echo "disabled";
						}
			?> 
			/>
										<?php
                                        if(isset($_SESSION["motivo_retorno"])){
											if($_SESSION["motivo_retorno"] == "null"){
                                          		echo "";
										  	}else{
												echo ltrim($_SESSION["motivo_retorno"]);
											}
                                        }
                                        ?>                  
                                </textarea>                          </td> 
                        </tr>
                                <input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" />

                        
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
                              <input name="id" type="hidden" value="<?php isset( $id ) ? $id : ''; ?>" />
                            <!--  <input name="id_imagem" type="hidden" value="<?php //echo $id_imagem; ?>" /> -->
                            <!--  <input name="id_prorrogacao" type="hidden" value="<?php //echo $id_prorrogacao; ?>" /> -->

                            
                              <?php 
							  			if($_SESSION["perfil"] == "callcenter"){
											//Fase 3, recevimento da solicitação por parte dos laboratórios e autorização dos procedimentos. Ultima fase.
											$w = 3;
										}else{
											//Fase 2 envio das informações para o callcenter
											$w = 2;
										}
							  
                                        if(isset($_SESSION['senha'])){
                                            echo " <input name='submit' type='submit' value='Confirmar' class='btn btn-primary ' disabled />";

                                        }else{
										
									   // Botão de negação da gui quando a penas tiver 1 procedimento solicitado.		
										if($_SESSION["perfil"] == "callcenter"){	
									   echo '<button style="background-color: #b75233;" onclick="confirmar('.$_SESSION["guia"].', 3, 0)" class="btn btn-primary">Não autorizar </button> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;';	
									   }
										// Botão confirmar e gerar a senha:										
                                            echo '<button onclick="confirmar(';
											  
											  if(isset($_SESSION["guia"])){
											   echo $_SESSION["guia"];
											   }else{
											   echo "";
											   }
											  
											echo', '.$w.', 1)" class="btn btn-primary"';
														
											//Bloqueio botão
											if($_SESSION["perfil"] == "callcenter"  &&   isset($_SESSION["status"]) && $_SESSION["status"] == 3){
													echo" disabled "; 
											}									
											if(isset($_SESSION["status"])){
												if($_SESSION["status"] == 3 ){
													 echo" disabled "; 
												}
											
											
												if(  ($_SESSION["perfil"] <> "callcenter") && ($_SESSION["status"] == 2) ){			
													echo "disabled";			
												}
											}
												
												
											echo'>';
											
											if($_SESSION["perfil"] == "laboratorio"){				
																					
												if( !isset($_SESSION["status"]) ||  $_SESSION["status"] == 1  ){
													echo "Solicitar";
												}else{
												    echo "Solicitado";
												}
												
												
											}	

											if($_SESSION["perfil"] == "callcenter"){
												   		echo "Autorizar";
											}
												
												
											echo'</button>';   
										
                                        }

                               


                              ?>

                              

                            </strong></div></td>
        </tr>

</table>


<!-- Confirma a solicitação ao callcenter do laboratório e SADT-->
<script>

//alert("Hello! I am an alert box!!");
  
  function confirmar(id, status,autorizar) {
    //var medico_solicitante = document.getElementById('medico_solicitante').value;
    //var cr = document.getElementById("cr").value;
    //var motivo = tinyMCE.get('motivo').getContent();
	
	var id_especialidade = document.getElementById("id_especialidade").value;
	var cr = document.getElementById("cr").value;
	var medico_solicitante = document.getElementById("medico_solicitante").value;
	var n_autorizacao = document.getElementById("n_autorizacao").value;
	var codsig = document.getElementById("codsig").value;	
	var motivo = document.getElementById("motivo").value;
    var motivo_retorno = document.getElementById("motivo_retorno").value;
	var senha = document.getElementById("senha").value;
	
	var procedimento = document.querySelectorAll('[name=procedimento]:checked');
  	var values = [];

	if(status == 2){
	var resposta = confirm("Deseja confimar a solicita\u00e7\u00e3o?");
				if (resposta == true) {	
					 for (var i = 0; i < procedimento.length; i++) {
						// utilize o valor aqui, adicionei ao array para exemplo
						values.push(procedimento[i].value);
					 }
				 window.location.href='lab_procedimento_cadastro.php?id='+id+'&status=2&motivo='+motivo+'&proc='+values+'&id_especialidade='+id_especialidade+'&cr='+cr+'&medico_solicitante='+medico_solicitante+'&codsig='+codsig; 
				}
	}
	
	
	if(status == 3){
		if(autorizar == 1){
		var resposta = confirm("Deseja confimar a solicita\u00e7\u00e3o?");
			if(n_autorizacao == ""){
				alert("Favor informar a n\u00famero de autoriza\u00e7\u00e3o!");
			}else if (senha == ""){
				alert("Favor informar a senha!");
			}else{
					if (resposta == true) {	
						 for (var i = 0; i < procedimento.length; i++) {
							// utilize o valor aqui, adicionei ao array para exemplo
							values.push(procedimento[i].value);
						 }
					 window.location.href='lab_procedimento_cadastro.php?id='+id+'&status=2&motivo='+motivo+'&proc='+values+'&senha='+senha+'&n_autorizacao='+n_autorizacao+'&motivo_retorno='+motivo_retorno; 
					}
			}
		}else{
			var resposta = confirm("Deseja negar a solicita\u00e7\u00e3o?");
			if (resposta == true) {	
						 for (var i = 0; i < procedimento.length; i++) {
							// utilize o valor aqui, adicionei ao array para exemplo
							values.push(procedimento[i].value);
						 }
					
					 window.location.href='lab_procedimento_cadastro.php?id='+id+'&status=2&motivo='+motivo+'&proc='+values+'&senha=0&n_autorizacao=0&cancelar=1'; 
			}
		}
		
	}
	
	
	
  }
	 
 
</script> 
