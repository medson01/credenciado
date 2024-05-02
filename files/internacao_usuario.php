<!-- CSS para impressão -->
<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />

<?php

  
	if(!empty($_GET["id"])){


  		      # Corrige o erro de acentuação no banco
				//mysqli_query($conn,"SET NAMES 'utf8'");

		$res = $_GET["id"];
		

		
		
			if(!empty($_GET["prorro"])){

			// echo "opção 1";	

			  $query = mysqli_query($conn,"SELECT internamento.nome as paciente, internamento.matricula as matricula, prorrogacao.medico_solicitante as solicitante, prorrogacao.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida_int, cid.cid , cid.descricao as descricao ,usuarios.nome as atendente, internamento.dias as dias, internamento.internacao_numero_totvs, prorrogacao.motivo as motivo, prorrogacao.data_prorrogacao as data_prorrogacao, prorrogacao.dias_autorizados as prorrogacao_dias, pronto_atendimento.dat_saida as dat_saida_pa, beneficiarios.data_nascimento , beneficiarios.deficiente , internamento.qtd_respiratoria , internamento.qtd_motora, acomodacao.nome as acomodacao, credenciado.nome as credenciado, (SELECT usuarios.nome FROM usuarios WHERE usuarios.id = internamento.id_usuario_out) as aten_int_saida
			 FROM `internamento` 
			 INNER JOIN usuarios on usuarios.id = internamento.id_usuario
			 INNER JOIN cid on cid.id = internamento.id_cid 
			 INNER JOIN beneficiarios on beneficiarios.id = internamento.id_beneficiarios
			 INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id 
			 INNER JOIN alocacao on alocacao.id = internamento.id_alocacao
             INNER JOIN acomodacao on acomodacao.id = alocacao.id_acomodacao
             INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado
			 LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa 
			 WHERE internamento.id =".$res) or die("erro ao carregar consulta");


						
	                    while($registro = mysqli_fetch_row($query)){

                        $nome = $registro[0];
                        $matricula = $registro[1];
                        $solicitante = $registro[2];
                        $crm = $registro[3];
                        $dat_entrada = $registro[4];
                        $dat_saida_int = $registro[5];
                        $cid = $registro[6];
                        $cid_desc = $registro[7];
                        $atendente = $registro[8];
                        $dias = $registro[9];
                        $motivo = $registro[10];
                        $data_prorrogacao = $registro[11];
                        $prorrogacao_dias = $registro[12];
                        $dat_saida_pa = $registro[13];
                        $data_nascimento = $registro[14];
						$deficiente = $registro[15];
						$qtd_respiratoria = $registro[16];
						$qtd_motora = $registro[17];
                        $acomodacao = $registro[18];
                        $credenciado = $registro[19];
						$aten_int_saida = $registro[20];
                        $internacao_numero_totvs = $registro[21];
                   }
			
			
			}else{

				//echo "opção 2";	

			  $query = mysqli_query($conn,"SELECT internamento.nome as nome, internamento.matricula as matricula, internamento.solicitante as solicitante, 
			  			internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida_int, internamento.motivo as motivo,
			  	  		internamento.prorrogacao as prorrogacao,
			  	  		cid.cid , cid.descricao as descricao , internamento.dias as dias,
			  	  		(SELECT usuarios.nome FROM usuarios WHERE usuarios.id = internamento.id_usuario) as aten_int_entrada,   
			  	  		pronto_atendimento.dat_saida as dat_saida_pa,
			  	  		beneficiarios.data_nascimento , beneficiarios.deficiente,
			  	  		acomodacao.nome as acomodacao,
			  	  		credenciado.nome as credenciado, 
			  	  		(SELECT usuarios.nome FROM usuarios WHERE usuarios.id = internamento.id_usuario_out) as aten_int_saida, internacao_numero_totvs, internacao_senha_totvs
							 FROM `internamento` 
							 INNER JOIN usuarios on usuarios.id = internamento.id_usuario 
							 INNER JOIN cid on cid.id = internamento.id_cid
							 INNER JOIN beneficiarios on beneficiarios.id = internamento.id_beneficiarios
							 INNER JOIN alocacao on alocacao.id = internamento.id_alocacao
                    		 INNER JOIN acomodacao on acomodacao.id = alocacao.id_acomodacao	
                    		 INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado		 
							 LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa 
							 WHERE internamento.id =".$res) or die("erro ao carregar consulta");


						
	                    while($registro = mysqli_fetch_row($query)){

                        $nome = $registro[0];
                        $matricula = $registro[1];
                        $solicitante = $registro[2];
                        $crm = $registro[3];
                        $dat_entrada = $registro[4];
                        $dat_saida_int = $registro[5];
                        $motivo = $registro[6];
                        $prorrogacao = $registro[7];
                        $cid = $registro[8];
                        $cid_desc = $registro[9];
                        $dias = $registro[10];
                        $aten_int_entrada = $registro[11];
                        $dat_saida_pa = $registro[12];
						$data_nascimento = $registro[13];
						$deficiente = $registro[14];
						$acomodacao = $registro[15];
						$credenciado = $registro[16];
						$aten_int_saida = $registro[17];
						$internacao_numero_totvs = $registro[18];
						$internacao_senha_totvs = $registro[19];
						
                         
                   }

				}
	}else{
	 		 
			//echo "opção 3";	
			
			 $sql1 = "SELECT internamento.dat_saida as dat_saida_int , usuarios.nome as atendente , internamento.dat_entrada as dat_entrada,  beneficiarios.data_nascimento , beneficiarios.deficiente, acomodacao.nome, credenciado.nome as credenciado, (SELECT usuarios.nome FROM usuarios WHERE usuarios.id = internamento.id_usuario_out) as aten_int_saida, internacao_numero_totvs
	 		 		FROM `internamento` 
	 		 		INNER JOIN usuarios on usuarios.id = internamento.id_usuario  
	 		 		INNER JOIN beneficiarios on beneficiarios.id = internamento.id_beneficiarios 
	 		 		INNER JOIN alocacao on alocacao.id = internamento.id_alocacao
                    INNER JOIN acomodacao on acomodacao.id = alocacao.id_acomodacao
                    INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado
	 		 		WHERE internamento.id =".$res;
					
	 		 $query = mysqli_query($conn,$sql1) or die("erro ao carregar consulta");
	

	  					
	                    while($registro = mysqli_fetch_row($query)){
                        
                        $dat_saida_int = $registro[0];
                        $atendente = $registro[1];
                        $dat_entrada = $registro[2];
                        $data_nascimento = $registro[3];
                        $deficiente = $registro[4];
                        $acomodacao = $registro[5];
                        $credenciado = $registro[6];
                        $aten_int_saida = $registro[17];
						$internacao_numero_totvs = $registro[9];
                        
                   }
 
	 } 

if(!empty($_GET["id_pa"])){


			//echo "opção 4";	

			$query_pa = mysqli_query($conn,"SELECT  pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida_pa, usuarios.nome as aten_pa_entrada, pronto_atendimento.medico as medico, pronto_atendimento.motivo as motivo, credenciado.nome as credenciado, (SELECT usuarios.nome FROM usuarios WHERE usuarios.id = pronto_atendimento.id_usuario_out) as aten_pa_saida 
								 FROM `pronto_atendimento`
								 INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario
								 INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado
								 WHERE pronto_atendimento.id =".$_GET["id_pa"]) or die("erro ao carregar consulta");


									
				                    while($registro = mysqli_fetch_row($query_pa)){
			   
			                        $entrada_pa = $registro[0];
			                        $saida_pa = $registro[1];
			                        $atendente = $registro[2];
			                        $medico_pa = $registro[3];
									$motivo_pa = $registro[4];
									$aten_pa_entrada = $registro[5];
									$aten_pa_saida = $registro[6];
			                        

			                         
			                   }


				}







?>

<style type="text/css">
<!--
.style7 {color: #FF0000}
-->
</style>
<table width="100%" class="table" style="font-size: 10px";>	
						
						<tr>
						  <th colspan="2" bgcolor="#CCCCCC" style="font-weight:bold; font-size:14px;" scope="col">
						    <div align="center"><?php echo "Número da Guia: ".$res; ?></div>
						    <div align="center"></div><div align="center"></div></th></tr>
						<tr>
							<th width='48%' scope='col'><div align="left">Nome do paciente: <br> &nbsp; <?php echo $nome; ?></div></th>
			 
							<th width="52%" scope='col'><div align="left">Matricula: <br> &nbsp; <?php echo $matricula; ?></div></th>
		              	</tr>
						 <tr>
						   <th scope="row"><div align="left">Data Nascimento: <br />
  &nbsp;
  <?php 	if(isset($_POST["data_nascimento"])){
  						echo $_POST["data_nascimento"];
				}else{
						echo date("d/m/Y", strtotime($data_nascimento));
				}
		 ?>
					       </div></th>
						   <th><div align="left">Idade: <br />
  &nbsp;
  <?php 
  				if(isset($_POST["idade"])){
  					echo $_POST["idade"]; 
			    }else{
					echo calc_idade($data_nascimento);
				}				
					
		?>
					       </div></th>
	      </tr>
						 <tr>
						   <th scope="row"><div align="left">Deficiente: <br />
  &nbsp;
  <?php 
  											
  											
												if($deficiente <> 0){
													echo "Sim"; 
												}else{
													echo "Não";
												}
											
										?>
										
					       </div></th>
						   <th>&nbsp;</th>
	      </tr>
						 <tr>
								<th scope="row"><div align='left'>
							    <div align="left">Data de Emissão: <br> &nbsp; <?php print date("j / n / Y"); ?></div></th>
								<th> <div align="left">Hora: <br> &nbsp; <?php print date("H:i:s"); ?></div></th>
						</tr>
			
						 <tr>
						   <th scope="row"><div align="left">Usuário de sistema: <br> &nbsp; <?php echo utf8_encode($_SESSION['login']);  ?> </div></th>
						   <th scope="col"><div align="left">Credenciado: <br />
&nbsp; <?php echo 	utf8_encode($credenciado); ?></div></th>
	      </tr>
		  
		<?php  
			
			if(!empty($_GET["id_pa"])){

				echo	'    <tr>
                          <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope="row"><div align="center">Dados do Pronto Atendimento </div></th>
				      </tr>
					    <tr>
                          <th scope="row"><div align="left">
                              <div align="left">Médico atendente<br />
                                &nbsp; ';
                               
								
								if(!empty($medico_pa)){

					      			echo $medico_pa;
					      		}

				echo '	      	
                              </div>
                            <div align="left"> <br />
                              </div>
                            <div align="left"></div></th>
					      <th scope="col"><div align="left">
                              <div align="left">Motivo do atendimento <br />
                                &nbsp; ';
                                
								
								if(!empty($motivo_pa)){

					      			echo utf8_encode($motivo_pa);
					      		}

				echo '	      	
                              </div>
					        <div align="left"> </div></th>
				      </tr>
					    <tr>
                          <th scope="row"><div align="left">Atendente da entrada: <br />
                            &nbsp;';

                              echo $aten_pa_entrada; 

                echo'               </div></th>
					      <th scope="col"><div align="left">Data e Hora da entrada: <br />
					        &nbsp; ';

					         print date('j / n / Y, H:i:s', strtotime($dat_entrada));  

				echo'	         <br />
					        &nbsp;</div></th>
				      </tr>
					    <tr>
					      <th scope="row"><div align="left">Data de Saíde: <br />  &nbsp;';
  
					      		
					      			if($dat_saida_pa <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida_pa));	
					      			} 
					      		 
				echo'	      	
                          </div></th>
					      <th scope="col"><div align="left">Permanência: <br /> &nbsp;';
  
								
								if(!empty($dat_saida_pa)){	
										
										 $date_time  = new DateTime($dat_entrada);
										 $diff       = $date_time->diff( new DateTime($dat_saida_pa));
										 echo $diff->format('%H hora(s), %i minuto(s) e %s segundo(s)');

					      		}

				echo'	      	
                          </div></th>
				      </tr>';

			}	      

		?>			    
					    <tr>
					      <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope="row"><div align="center">Dados do internamento </div></th>
				      </tr>
					    <tr>
					      <th scope="row"><div align="left">Médico solicitante: <br> &nbsp; <?php echo $solicitante; ?></div></th>
					      <th scope="col"><div align="left">CRM: <br> &nbsp; <?php echo $crm; ?></div></th>
				      </tr>
					    <tr>
					      <th scope="row"><div align="left">Código do CID: <br> &nbsp; <?php echo  $cid; ?> </div></th>
					      <th scope="col"><div align="left">Descrição do CID: <br> &nbsp;<?php echo "&nbsp;&nbsp;". $cid_desc ; ?></div></th>
				      </tr>
					    <tr>
					      <th scope="row"><div align="left">Diárias: <br> &nbsp; <?php echo $dias; ?></div></th>
					      <th scope="col"><div align="left">Acomodação: <br /> &nbsp; <?php echo $acomodacao; ?></div></th>
				      </tr>
				      <tr>
				        <th scope="row"><div align="left">Atendente: <br> &nbsp; <?php echo $aten_int_entrada; ?></div></th>
					      <th scope="col"><div align='left'><span class="style7">Autorização de Internamento: </span><br />
  &nbsp;
  <?php  echo isset($internacao_numero_totvs) ? $internacao_numero_totvs." - ".$internacao_senha_totvs : '';  ?>
				          </div></th>
				      </tr>
					    <tr>
					      <th scope="row"><div align="left">Data de entrada: <br> &nbsp; <?php print date('d / m / Y ', strtotime($dat_entrada));  ?></div></th>
					      <th scope="col"><div align="left">Previsão de  saída: <br> &nbsp;  <?php echo date('d / m / Y', strtotime($dat_entrada."+".$dias." days"));   ?> </div></th>
				      </tr>
					    <tr>
					      <th colspan="2" scope='row'><div align="left">
					      	<?php
								
								if(!empty($motivo)){

									echo "Motivo do internamento: <br> &nbsp;";	 

					      			echo $motivo;
					      		}

					      	?> </div>					        <div align="left"></div></th>
				      </tr>
				        <tr>
				          <th scope="row"><div align="left">Data de Saída: <br />
  &nbsp;
  <?php 
					      		
					      			if(!empty($dat_saida_int) <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida_int));	
					      			} 
					      		 
					      	?>
                          </div></th>
				          <th scope='col'><div align="left">Atendente saída: <br />
  &nbsp; <?php echo $aten_pa_saida; ?></div></th>
  </tr>
			           <tr>
					      <th scope="row"><div align="left">
					        <?php
								/*
								if(!empty($prorrogacao)){

									echo "Motivo da Prorrogação: <br> &nbsp;";	 

					      			echo $prorrogacao;
					      		}
								*/
					      	?>
					      </div></th>
					      <th scope='col'>&nbsp;</th>
				      </tr>
					  <?php
					  
					  	if(!empty($_GET["prorro"])){
					  		require_once("internacao_prorrogacao_relatorio_item.php");
						
						}
						
					  ?>
</table>
			<div class="hidden-print">  		
		 		
                <div align="center">
                  
                    <!-- Remover o sublinhado -->
                    <style type="text/css">
					a:link {
					text-decoration:none;
					}
					a:visited {
					text-decoration:none;
					}
					a:hover {
					text-decoration:underline;
					}
				</style>
                    <?php 
      if(!empty($_GET["prorro"])){
	  
	  	echo " <br>
				<br><br>
				<br><br>
				<br><br>
				<br><br>
				<br><br>
				<br><br>
				<br><br>
				<br><br>
				<br>";
	  
	  }else{
	  
	  	echo " ";
	  }
	?>
	             
						
						<button class="btn btn-default glyphicon glyphicon-print hidden-print" onclick="javascript:print();"> Imprimir</button>
					         
                  </p>
                  <p><br />
                  </p>
                </div>
    </div>