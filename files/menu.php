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
                  		
                  		<?php
							$login = $_SESSION["login"];
								
							echo $login;
				
						?>
					</div>
				</div>
<!-- /Boas vindas! -->
		
<!-- Botões do Menu -->
		<a href="fom_consulta_situacao.php" > 
			<div class="thumbnail tile tile-medium tile-teal"  style="display: flex; justify-content: center; align-items: center;">	
				
				Pronto Atendimento 	
			</div>
		</a>


		<a href="internacao.php"  > 
			<div class="thumbnail tile tile-medium tile-teal" style="display: flex; justify-content: center; align-items: center;">	
				
				Interna&ccedil;&atilde;o 	
			</div>
		</a>

		
<!-- botão perfil  -->  	
    	<?php 

		 If( $_SESSION["perfil"] == "administrador") {
				
		 		//  botão Cadastro de usuários 
				echo "	
						<a href='form_cadastro_usuario.php' > 
							<div class='thumbnail tile tile-medium tile-teal' style='display: flex; justify-content: center; align-items: center;'>	
								
								 Usu&aacute;rios
							</div>
						</a>
				";

		}

		 If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
		 		//  botão Avidos 
				echo "	
						<a href='form_cadastro_aviso.php' > 
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
		  