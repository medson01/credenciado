		<div class="panel panel-primary" >
						  		<?php		
								if(isset($_GET['imagem']) && !empty($_GET['imagem'])){					
										include("sadt_formulario_imagem.php");
								}
								?>
			<div class="panel-heading" style="font-size: 10px; font-weight: bold;">JUSTIFICATIVA DA SOLICITAÇÃO</div>  
				                                  						
							<textarea id="motivo" class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%; text-align: justify; text-justify: inter-word;" form="motivo" <?php 				
                                        
											if($_SESSION["perfil"] == "callcenter" || !empty($motivo) ){
                                          		echo "disabled";
										  	}else{
												echo "";
											}
                           echo '/>';            

										if(isset($motivo)){
											if($motivo == "null"){
                                          		echo "";
										  	}else{
												echo ltrim($motivo);
											}
                                        }
                                        ?></textarea>						
																										
    
						



    </div> 

	<div class="panel panel-danger  " >
			<div class="panel-heading" style="font-size: 10px; font-weight: bold;">RETORNO SADT</div>    
			<textarea onclick="limpar()" id="motivo_retorno" class="form-control input-sm" name="motivo_retorno"  style="font-size:12px; margin: 0px; height: 100px; width: 100%; text-align: justify; text-justify: inter-word;" form="motivo_retorno" <?php 
						 if($_SESSION["perfil"] == "callcenter"){	
						  if(isset($motivo_retorno)){
								if($motivo_retorno == "null"){
								   echo "";
								}else{
								   echo "disabled";
								}
                         }
						}else{
								 echo "disabled";
						}
			?> 
			/><?php
                                        if(isset($motivo_retorno)){
											if($motivo_retorno == "null"){
                                          		echo "";
										  	}else{
												echo ltrim($motivo_retorno);
											}
                                        }
                                        ?></textarea>  
   </div>                                 
   
    <input name="id_usuario" type="hidden" value="<?php echo $_SESSION["id"]; ?>" size="44" />




      <table width="100% " border="0" align="center" > 
              <tr>
                         <td >&nbsp;</td>
                         <td>&nbsp;</td>
                         <td><div align="right"><strong>
                              <input name="id" type="hidden" value="<?php isset( $id ) ? $id : ''; ?>" />


                            
                              <?php 
							  			if($_SESSION["perfil"] == "callcenter"){
											//Fase 3, recevimento da solicitação por parte dos laboratórios e autorização dos procedimentos. Ultima fase.
											$w = 3;
										}else{
											//Fase 2 envio das informações para o callcenter
											$w = 2;
										}
							  
                                        if(isset($senha)){
                                            echo " <input name='submit' type='submit' value='Confirmar' class='btn btn-primary ' disabled />";

                                        }else{
										
									   // Botão de negação da gui quando a penas tiver 1 procedimento solicitado.		
										if($_SESSION["perfil"] == "callcenter"){	
									   echo '<button style="background-color: #b75233;" onclick="confirmar('.$guia.', 3, 0)" class="btn btn-primary">Não autorizar </button> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;';	
									   }
										// Botão confirmar e gerar a senha:										
                                            echo '<button onclick="confirmar(';
											  
											  if(isset($guia)){
											   echo $guia;
											   }else{
											   echo "";
											   }
											  
											echo', '.$w.', 1)" class="btn btn-primary"';
														
											//Bloqueio botão
											if($_SESSION["perfil"] == "callcenter"  &&   isset($status) && $status == 3){
													echo" disabled "; 
											}									
											if(isset($status)){
												if($status == 3 ){
													 echo" disabled "; 
												}
											
											
												if(  ($_SESSION["perfil"] <> "callcenter") && ($status == 2) ){			
													echo "disabled";			
												}
											}
												
												
											echo'>';
											
											if($_SESSION["perfil"] == "laboratorio" || $_SESSION["perfil"] == "clinica" || $_SESSION["perfil"] == "clin_lab"){				
																					
												if( !isset($status) ||  $status == 1  ){
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

	var id_especialidade = document.getElementById("id_especialidade").value;
	var cr = document.getElementById("cr").value;
	var lab = '<?php if(isset($_GET['lab'])){echo $_GET['lab'];} ?>' ;
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
				 window.location.href='lab_procedimento_cadastro.php?id='+id+'&status=2&motivo='+motivo+'&proc='+values+'&id_especialidade='+id_especialidade+'&cr='+cr+'&medico_solicitante='+medico_solicitante+'&codsig='+codsig+'&lab='+lab; 
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
					
					 window.location.href='lab_procedimento_cadastro.php?id='+id+'&status=2&motivo='+motivo+'&proc='+values+'&senha=0&n_autorizacao=0&cancelar=1&motivo_retorno='+motivo_retorno; 
			}
		}
		
	}
	
	
	
  }
	 
 
</script> 
