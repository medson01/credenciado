
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

						case '8':

							$tituloMenu = "Lista SP/SADT";
							$lista =  "sadt_lista.php";
							$formulario =  "sadt_formulario.php";
							break;

						case '9':
							$tituloMenu = "Procedimento";
							$lista =  ".//procedimento/procedimento_lista.php";
							$formulario =  ".//procedimento/procedimento_formulario.php";
							break;

						case '10':
							$tituloMenu = "Lista de Atendimentos";
							//$lista =  "..\\laboratorio\lab_lista.php";
							//$formulario =  "..\\laboratorio\lab_formulario.php";
							$lista =  "lab_lista.php";
							$formulario =  "lab_formulario.php";
							break;
						case '11':
							$tituloMenu = "Lista de Consulta";
							//$lista =  "..\\laboratorio\lab_lista.php";
							//$formulario =  "..\\laboratorio\lab_formulario.php";
							$lista =  "lab_lista.php";
							$formulario =  "lab_formulario.php";
							break;

					}


// sub_menu  
if (isset($tituloMenu)) {


echo '<div id="exTab2" >
<ul class="nav nav-tabs">';


			

					if( !isset($_GET['id']) && !isset($_GET['numero_protocolo']) ){ 
						echo '<li class="active">';
					}else{
						echo '<li >';
					}

					echo "<a  href='#1' data-toggle='tab' >". $tituloMenu ."</a>

					</li>


					<li "; 
					if(isset($_GET['id'])){ echo 'class="active"';} 
					echo ">";
					if( $_SESSION["perfil"] <> "internacao" && $_SESSION["perfil"] <> "aut_internacao") {
					   echo "	<a href='#2' data-toggle='tab'>Cadastro</a>";
					}
			echo "</li>" ;




			If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
			
				echo "	<li>
							<a href='#3' data-toggle='tab'>Gráficos</a>
					    </li>";
				
			}
		
//=======================================
		if(isset($_GET['sadt'])){
				if(isset($_GET['numero_protocolo'])){ 
						echo '<li class="active">';
				}else{
						echo '<li >';
				}
				
			echo'	<a href="#sadt_autorizacao" data-toggle="tab" >Autorização SADT</a>
	  		</li>';
	  	}

//======================================

		echo '</ul>

			<div class="tab-content ">
			  	<div class="tab-pane '; 
			  	if(!isset($_GET['id']) && !isset($_GET['numero_protocolo']) ){ echo 'active';} 
		echo'	" id="1">';
          	     require_once $lista; 			
		echo'	</div>

				<div class="tab-pane ';
				 if(isset($_GET['id'])){ echo 'active';} 
		echo '  " id="2">';
        	       require_once $formulario;		
		echo'	</div>';

        

        echo'	<div class="tab-pane ';
				 
		echo '  " id="3">';
        	       
        If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){		

         
          		if(isset($_GET['pa'])){
	    		 		echo '<iframe src="../grafico/graf_pa.php" height="900" width="100%" scrolling="no" style="border:none;"></iframe>'; 
				}
				if(isset($_GET['int'])){
				 		
				 		echo '<iframe src="../grafico/graf_int.php" height="350" width="100%" scrolling="no" style="border:none;"></iframe>'; 
				 		echo '<iframe src="../grafico/graf_dias_internado.php" height="400" width="100%" scrolling="no" style="border:none;"></iframe>'; 

				}	

		}
		echo'	</div>';


		//==========================================================
		if(isset($_GET['sadt'])){
		echo'		<div class= "tab-pane '; 
					if(isset($_GET['numero_protocolo'])){ echo 'active in';} 
		echo' 					" id="sadt_autorizacao"  >';
			          include "../sadt_autorizacao/sadt_autorizacao.php";
		
		echo'		</div>';
		}

		//===========================================================


					
		echo'</div>


  </div>


';
}else{


	if(isset($_GET['prorro'])){

		require_once("internacao_prorrogacao_formulario.php");


	}elseif(isset($_GET['acomodacao'])){
	
	  require_once("internacao_acomodacao_formulario.php");

	}else{

		 require_once("user_system_formulario.php");
	}

}
?>
<!-- /sub_menu -->

