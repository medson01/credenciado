
<!-- sub_menu -->
<?php 


switch ($sub_menu) {
						case '1':

							$tituloMenu = "Lista Pronto atendimento";
							$lista =  "pronto_atendimento_lista.php";
							$formulario =  "pronto_atendimento_formulario.php";
							break;
					
						case '2':

							$tituloMenu = "Lista internação";
							$lista =  "internacao_lista.php";
							$formulario =  "internacao_formulario.php";
							break;

						case '3':

							$tituloMenu = "Credenciado";
							$lista =  "credenciado_lista.php";
							$formulario =  "credenciado_formulario.php";
							break;

						case '4':

							$tituloMenu = "Lista avisos";
							$lista =  "aviso_lista.php";
							$formulario =  "aviso_formulario.php";
							break;

					}


// sub_menu  
if (isset($tituloMenu)) {


echo '<div id="exTab2" class="container" style="width: 980px; padding-left: 1px;">
<ul class="nav nav-tabs">';


			

					if(!isset($_GET['id'])){ 
						echo '<li class="active">';
					}else{
						echo '<li >';
					}

					echo "<a  href='#1' data-toggle='tab'>". $tituloMenu ."</a>



					</li>


					<li "; 
					if(isset($_GET['id'])){ echo 'class="active"';} 
					echo ">

					<a href='#2' data-toggle='tab'>Cadastro</a>
			</li>" ;

			If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
			/*
				echo "	<li>
						<a href='#3' data-toggle='tab'>Gráficos</a>
					</li>";
			*/	
			}
		


		echo '</ul>

			<div class="tab-content ">
			  	<div class="tab-pane '; 

			  	if(!isset($_GET['id'])){ echo 'active';} 

		echo'	  	" id="1">';
          				  

          				        require_once $lista; 
          				
		echo'		</div>
				<div class="tab-pane ';

				 if(isset($_GET['id'])){ echo 'active';} 

		echo '      " id="2">';
        				 

        				        require_once $formulario;

        				
		echo'		</div>
        	<!--	
        		<div class="tab-pane" id="3">
          			     <iframe src="../grafico/graf_qtd_internacao_hospitiais.php" height="500" width="100%" scrolling="no" style="border:none;"></iframe> 
				</div>
			-->
			</div>
  </div>

<hr></hr>
';
}else{
	
	require_once("user_system_formulario.php");
}
?>
<!-- /sub_menu -->

