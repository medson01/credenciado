<!-- Pag menu.php -->
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>

<!-- Boas vindas! -->	
				<div style="height: 100px; width: 40px; " >	
					<div align="center"  ><br />
			    		<img src="../imagem/avatar.png" alt="Clique aqui para ser atendido" border="0" height="37" width="36" />
			    	</div>
				</div>
				<div style="height: 100px; width: 100px; position:absolute; left: 57px; top: 7px;" >	
					<div align="center" style="size:+1" ><span class="style1">Seja bem vindo,</span><br />
				  		<br /> 
                  		
<script>
	var hora;
	var muda = 1;
	var tempo = new Number();
	tempo = <?php echo ini_get("session.gc_maxlifetime") ?>;
	function iniciaLogout(){
	   if((tempo - 1) >= 0){
		  var min = parseInt(tempo/60);
		  var seg = tempo%60;
		  if(min < 10){
			 min = '0'+min;
			 min = min.substr(0, 2);
		  }
		  if(seg <=9){
			 seg = "0"+seg;
		  }
		  hora = min + ':' + seg;
		  $("#cronometro").html(hora);
		  setTimeout('iniciaLogout()',1000);
		  if((tempo - 1) <= 25){
			 if(muda == 1){
				$("#cronometro").css('color', 'red').css('font-weight', 'bold');
				muda = 0;

				

			 }else{
				$("#cronometro").css('color', 'white').css('font-weight', 'normal');
				muda = 1;


			 }
		  }
		  tempo--;
	   }else{
		  $("#cronometro").html('00:00');
		  window.location.href = "../index.html";
	   }
	}
</script>

                  		<?php
							$login = $_SESSION["login"];		
								//echo $_SESSION["perfil"]."<br>";	
	
						  echo '<span id="login" >'. utf8_encode($_SESSION["login"]) . '</span>';

						  echo '<span id="id_usuarios" style="display: none;">'.  $_SESSION["id"] . '</span>';
						?>
							<br>
							 <span class='hidden' id='cronometro'></span><script>iniciaLogout();</script> 
					</div>
				</div>
<!-- /Boas vindas! -->
		
<!-- Botões do Menu -->
<?php

	if( ($_SESSION["perfil"] <> "internacao")  && ($_SESSION["perfil"] <> "aut_internacao")  && ($_SESSION["perfil"] <> "laboratorio") && ($_SESSION["perfil"] <> "callcenter") && ($_SESSION["perfil"] <> "clinica") && ($_SESSION["perfil"] <> "clin_lab") ) {
		if( $_SESSION["perfil"] <> "alimentacao"){
			echo'
			<!-- Botão consulta de situação -->
			<a href="fom_consulta_situacao.php" > 
				<div class="thumbnail tile tile-medium tile-teal"  style="display: flex; justify-content: center; align-items: center;">	
					
					Situação 
				</div>
			</a>
	
			<!-- Botão pronto atendimento -->
			<a href="painel.php?pa=1"  > 
				<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
					
					Pronto atendimento
				</div>
			</a>
			';
		}
		
		if( $_SESSION["perfil"] <> "pa"){
		echo'
			<!-- Botão internação -->
			<a  href="painel.php?int=1"  > 
				<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
					
					Interna&ccedil;&atilde;o 	
				</div>
			</a>
			';
		}	
			
		if( $_SESSION["perfil"] <> "alimentacao"){
			echo'	
			<!-- Em desenvolvimento 
			
			 Botão sadt 
			<a  href="painel.php?sadt=1"  > 
				<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
					
					SADT 	
				</div>
			</a>
	
	
	
			 Botão Pronto 
			<a  href="principal.php?ponto=1"  > 
				<div class="thumbnail tile tile-medium tile-teal btn-ponto" style="display: flex; justify-content: center; align-items: center;">	
					
					Ponto	
				</div>
			</a>
	
			-->
			';
		}
	}
		

		// ==================================== Botões Perfis  ========================================  	
    	
    	//-- Botão Laboratório -->		
		if( $_SESSION["perfil"] == "clinicas" or $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "callcenter" or $_SESSION["perfil"] == "laboratorio" or $_SESSION["perfil"] == "clin_lab") {
		echo'
		<a  href="painel.php?lab=exame"  > 
			<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	';
				
			if($_SESSION["perfil"] == "callcenter"){
				echo "SADT";
			}else{
				echo "Exame"; 
			}
		echo'	</div>
		</a>';
		}
		//-- Botão Clinicas -->		
		if( $_SESSION["perfil"] == "clinica" or $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "clin_lab") {
		echo'
		<a  href="painel.php?lab=consulta"  > 
			<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
				
				Consulta

			</div>
		</a>';
		}
    	/*-- Botão CallCenter -->		
		if( $_SESSION["perfil"] == "callcenter" or $_SESSION["perfil"] == "administrador") {
		echo'
		<a  href="painel.php?call=1"  > 
			<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
				
				Callcenter

			</div>
		</a>';
		}
		*/
    	//-- Botão internação validação TOTVs -->		
		if( $_SESSION["perfil"] == "aut_internacao"  || $_SESSION["perfil"] == "internacao") {
		echo'
		<a  href="painel.php?int=1"  > 
			<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
				
				Interna&ccedil;&atilde;o
			</div>
		</a>';
		}


		//-- Botão Usuários -->
		if( $_SESSION["perfil"] == "administrador") {
				//  botão Cadastro de Empresa 
				echo "
				<div>	
				=============== <br>
				Configuração <br>
				===============
						<a href='painel.php?cred=1' > 
							<div class='thumbnail tile tile-medium tile-teal' style='display: flex; justify-content: center; align-items: center; background-color: #0047ff;'>	
								
								 Credenciados
							</div>
						</a>
				";

				
		 		//  botão Cadastro de usuários 
				echo "	
						<a href='painel.php?caduser=1' > 
							<div class='thumbnail tile tile-medium tile-teal' style='display: flex; justify-content: center; align-items: center;background-color: #0047ff;'>	
								
								 Usu&aacute;rios
							</div>
						</a>
				";
				
				


		}
		
		 if( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "faturamento")){
		 		//  botão Avidos 
				echo "	
						<a href='faturamento_formulario.php' > 
							<div class='thumbnail tile tile-medium tile-teal' style='display: flex; justify-content: center; align-items: center; background-color: #0047ff;'>	
								
								 Faturamento 
							</div>
						</a>
				";
				
		}		
	
	
		 If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
		 		
				//Botão Procedimento 
				echo' <a  href="painel.php?proc"  > 
					<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center; background-color: #0047ff;">	
						
						Procedimento	
					</div>
				</a>';
		 
		 		//  botão Avidos 
				echo "	
						<a href='painel.php?aviso=1' > 
							<div class='thumbnail tile tile-medium tile-teal' style='display: flex; justify-content: center; align-items: center;'>	
								
								 Avisos 
							</div>
						</a>
				";

		}		

		?>
		<?php 
			        

			switch ($_SESSION["perfil"]) {
        			
        			case "administrador":
        				echo "<a href='https://drive.google.com/open?id=1sJ_ra3b58K9frWX45gKP0M_TJK2pA2H6' target='_blank'> ";												
        			break;

                    case "auditor":
        				echo "<a href='https://drive.google.com/open?id=1eDVe20kCPoclhEw9xQI1_4xLo132Kg3u' target='_blank'> ";												
        			break;              
        							
        			case "usuario":
        				echo "<a href='https://drive.google.com/open?id=1bbMZdkkI7R9eu3ST5Fkgmpv38gNhBGv2' target='_blank'> ";												
        			break;
        	}
				
			
		?>

			<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
				
				 Downloads  	
			</div>
		</a>
<!-- /botão perfil --> 

<!-- logout -->		  
		<a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout.php">
			<div>
					
			    <img src="../imagem/logoff.png" width="100" height="100">
		    </div>
		</a>

<!-- /Pag menu.php -->		  
