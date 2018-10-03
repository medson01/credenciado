<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>

<!-- Boas vindas! -->	
				<div style="height: 100px; width: 70px; " >	
					<div align="center"  ><br />
			    		<img src="../imagem/avatar.png" alt="Clique aqui para ser atendido" border="0" height="37" width="36" />
			    	</div>
				</div>
				<div style="height: 100px; width: 100px; position:absolute; left: 77px; top: 6px;" >	
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
			<div class="thumbnail tile tile-medium tile-teal">	
				<br />
				<br />
				<font size="+3"> P. A </font> <br>
				<font size="-3"> (Pronto Atendimento) </font> 	
			</div>
		</a>


		<a href="internacao.php" > 
			<div class="thumbnail tile tile-medium tile-teal">	
				<br />
				<br />
				<font size="+3"> Interna&ccedil;&atilde;o </font> 	
			</div>
		</a>

		
<!-- botão perfil  -->  	
    	<?php 

		 If( $_SESSION["perfil"] == "administrador"){
				
		 		//  botão Cadastro de usuários 
				echo "	
						<a href='form_cadastro_usuario.php' > 
							<div class='thumbnail tile tile-medium tile-teal'>	
								<br />
								<br />
								<font size='+3'> Usu&aacute;rios </font>
							</div>
						</a>
				";

		 		//  botão Avidos 
				echo "	
						<a href='form_cadastro_aviso.php' > 
							<div class='thumbnail tile tile-medium tile-teal'>	
								<br />
								<br />
								<font size='+3'> Avisos </font>
							</div>
						</a>
				";

		}		

		?>

		<a href="downloads.php" > 
			<div class="thumbnail tile tile-medium tile-teal">	
				<br />
				<br />
				<font size="+3"> Downloads </font> 	
			</div>
		</a>
<!-- /botão perfil --> 

<!-- logout -->		  
		<a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout.php">
			<div>
					
			    <img src="../imagem/logoff.jpg" width="100" height="100">
		    </div>
		</a>
		  
