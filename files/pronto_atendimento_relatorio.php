<?php

  
	if(!empty($_GET["id_pronto_atendimento"])){

		  //Arquivo de configuração
  		  include "cabecalho.php";

  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");
	

		$res = $_GET["id_pronto_atendimento"];

		//JOIN beneficiarios on concat(beneficiarios.matricula, beneficiarios.tipreg) = SUBSTRING(pronto_atendimento.matricula, 9,8) 

			$query = mysqli_query($conn,"SELECT pronto_atendimento.nome as paciente, pronto_atendimento.matricula as matricula, pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida, usuarios.nome as credenciado, pronto_atendimento.medico as medico, pronto_atendimento.motivo as motivo, pronto_atendimento.prorrogacao as prorrogacao, beneficiarios.data_nascimento, beneficiarios.deficiente FROM `pronto_atendimento` INNER JOIN beneficiarios on beneficiarios.id = pronto_atendimento.id_beneficiarios INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario WHERE pronto_atendimento.id =".$res) or die("erro ao carregar consulta");


						
	                    while($registro = mysqli_fetch_row($query)){

                        $nome = $registro[0];
                        $matricula = $registro[1];
                        $dat_entrada = $registro[2];
                        $dat_saida = $registro[3];
                        $credenciado = $registro[4];
                        $medico = $registro[5];
						$motivo = $registro[6];
                        $prorrogacao = $registro[7];
						$data_nascimento = $registro[8];
						$deficiente = $registro[9];

                         
                   }


	}else{
	 		 $query = mysqli_query($conn,"SELECT pronto_atendimento.dat_saida as dat_saida , usuarios.nome as credenciado , pronto_atendimento.dat_entrada as dat_entrada, beneficiarios.data_nascimento, beneficiarios.deficiente  FROM `pronto_atendimento` INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario INNER JOIN beneficiarios on concat(beneficiarios.matricula, beneficiarios.tipreg) = SUBSTRING(pronto_atendimento.matricula, 9,8) WHERE pronto_atendimento.id =".$res) or die("erro ao carregar consulta");
	

	  					
	                    while($registro = mysqli_fetch_row($query)){
                        
                        $dat_saida = $registro[0];
                        $credenciado = $registro[1];
                        $dat_entrada = $registro[2];
						$data_nascimento =  $registro[3];
						$deficiente = $registro[4];
                        

                        
                   }
 
	 } 
	 
	 
 function calc_idade($nascimento) {
            $nascimento = date("d/m/Y", strtotime($nascimento));
            $nascimento=date($nascimento);
            $nascimento=explode('/',$nascimento); //Cria um array com os campos da data de nascimento  
            $data=date('d/m/Y'); 
            $data=explode('/',$data); //Cria um array com os campos da data atual 
            $anos=$data[2]-$nascimento[2]; //ano atual - ano de nascimento 
            if($nascimento[1] > $data[1]){
               return $anos-1;
            } //Se o mês de nascimento for maior que o mês atual, diminui um ano 
            if($nascimento[1] == $data[1]){ 
            //se o mês de nascimento for igual ao mês atual, precisamos ver os dias 
                  if($nascimento[0] <= $data[0]) {
                      return $anos; 
                  }else{
                      return $anos-1; 
                  }
            }
              
          return $anos; 
        
}
	 
?>
<style type="text/css">
<!--
.style2 {font-size: 24px}
.style6 {font-size: 18px}
-->
</style>
        
            <td width="898" id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

  	<!-- Título da página -->                  
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading"> Relatório de Pronto Atendimento </h1>
								</div>
                    </div>

  	<!-- / Título da página --> 
                    <div id="div">
                      <div>
                        <h1 class="documentFirstHeading"><br />
                          </p>
                          <!--  Conteudo --></h1>
                        <div id="div2" style="position:relative; height:100px; margin-left:40px; top:-20px" >
                          <div>
                            <div style="width:70px; position:relative" >
								<span class="documentFirstHeading">
									<span class="style2">
										<img src="../imagem/logo_ipaseal.png" width="71" height="97" />									</span>								</span>							</div>
							<div style="width:40px; position:relative; left:80px; width:500px; top:-60px">
							  <div align="center"><span class="documentFirstHeading"><span class="style2">Instituto de Assistência à Saúde dos Servidores do Estado de Alagoas</span></span></div>
							</div>
                          </div>
                        </div>
                      </div>
                    </div>
				<div style="height:550px">
                    <table width="100%" class='table' style='font-size: 10px';>	
						
						<tr>
						  <th colspan="2" bgcolor="#CCCCCC" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">
					      <?php echo "Número da Guia: ".$res; ?></div></th>
		  </tr>
						<tr>
							<th width='48%' scope='col'><div align='left'>Nome do paciente: <br> &nbsp; <?php echo $nome; ?></div></th>
			 
							<th width="52%" scope='col'><div align='left'>Matricula: <br> &nbsp; <?php echo $matricula; ?></div></th>
		              	</tr>
						 <tr>
						   <th scope='row'><div align="left">Data Nascimento: <br />
  &nbsp; <?php 	if(isset($_POST["data_nascimento"])){
  						echo $_POST["data_nascimento"];
				}else{
						echo date("d/m/Y", strtotime($data_nascimento));
				}
		 ?>
				 </div></th>
						   <th><div align="left">Idade: <br />
  &nbsp; <?php 
  				if(isset($_POST["idade"])){
  					echo $_POST["idade"]; 
			    }else{
					echo calc_idade($data_nascimento);
				}				
					
		?></div></th>
	      </tr>
						 <tr>
						   <th scope='row'><div align="left">Deficiente: <br />
  &nbsp; 								<?php 
  											
  											if(isset($_POST["deficiente"])){
												if($_POST["deficiente"] <> 0){
													echo "Sim"; 
												}else{
													echo "Não";
												}
											}
											if($deficiente == 0){
											
												echo "Não";
											}
										?>
  
  
  </div></th>
						   <th>&nbsp;</th>
				      </tr>
						 <tr>
								<th scope='row'><div align='left'>
							    <div align="left">Data de Emissão: <br> &nbsp; <?php print date("j / n / Y"); ?></div></th>
								<th> <div align="left">Hora: <br> &nbsp; <?php print date("H:i:s"); ?></div></th>
						</tr>
			
						 <tr>
						   <th scope='row'><div align="left">Credenciado: <br> &nbsp; <?php echo	$credenciado;  ?> </div></th>
						   <th scope='col'><div align="left">Atendente: <br />
&nbsp; <?php echo utf8_encode($_SESSION['login']); ?></div></th>
	      </tr>
					    <tr>
					      <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope='row'><div align="center">Dados do Pronto Atendimento </div></th>
				      </tr>
					   	
					    <tr>
					      <th scope='row'><div align="left">
					        <div align="left">Médico atendente<br />
  &nbsp;
  <?php
								
								if(!empty($medico)){

					      			echo $medico;
					      		}

					      	?>
                            </div>
					        <div align="left">
<br />
</div>					        
					      <div align="left"></div></th>
						  <th scope='col'><div align="left">
						    <div align="left">Motivo do atendimento <br />
						      &nbsp;
						      <?php
								
								if(!empty($motivo)){

					      			echo $motivo;
					      		}

					      	?>
					                                  </div>
					      <div align="left">					        </div>						  </tr>
					    <tr>
					      <th scope='row'><div align="left">Data da entrada: <br> &nbsp; <?php print date('j / n / Y', strtotime($dat_entrada));  ?></div></th>
					      <th scope='col'><div align="left">Hora da entrada: <br> &nbsp; <?php print date('H:i:s', strtotime($dat_entrada));  ?><br> 
					        &nbsp;</div></th>
				      </tr>
				       <tr>
					      <th scope='row'><div align="left">Data de Saíde: <br> &nbsp; 
					      	<?php 
					      		
					      			if($dat_saida <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida));	
					      			} 
					      		 
					      	?> </div>					      </th>
					      <th scope='col'><div align="left">Permanência: <br> &nbsp;
					        <?php
								
								if(!empty($dat_saida)){	
										
										 $date_time  = new DateTime($dat_entrada);
										 $diff       = $date_time->diff( new DateTime($dat_saida));
										 echo $diff->format('%H hora(s), %i minuto(s) e %s segundo(s)');

					      		}

					      	?>
					      </div>
					 </th>
				      </tr>

				      <tr>
				      	 <th colspan="2" style="font-weight:bold; font-size:10px;" bgcolor="#CCCCCC" scope='row'>
				      	 	<div align="center">
				      		    Atenção</br>
 							</div>
 							<div style="text-align: justify;">
										Caro credenciado, é considerado pronto atendimento a permanencia de 12 horas do usuário do plano no hospital.

										Caso o mesmo necessite permanecer além do prazo, o atendente deverá cadastrá-lo no sistema de internação, através do botão internação.				      	</th>
				      </tr>
				      <tr>
				      	<th></th>
				      </tr>
    				</table>
		 		</div>
				        <div align="center">
	        <p>

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

  <a href="painel.php?pa=1" > <input class='btn btn-primary delete' type="button" value="Voltar"> </a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input class='btn btn-primary delete'  name="button" type="button" onclick="window.print();" value="Imprimir" />
          </p>
	        <p><br />
            </p>
        </div>
                      


          </tr>
        </tbody>
    </table>


	
	
	

</div>
    <?php

     	include ("rodape.php");

     ?>