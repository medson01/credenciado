<?php

  // Início de sessão


 $perfil = $_SESSION["perfil"];

 function permissao($b) {

		 	switch ($b) {
		 		case 'medico':

		 				$b = "style='display:none' required='required'"; 

		 				return $b;
		 					
		 			break;
		 		
		 		case 'administrador':

		 				return $b;
		 					
		 			break;

		 		case 'usuario':

		 				return $b;
		 					
		 			break;
		    }
 		
   }  


   echo permissao($perfil);

/*
if(!((isset($status)) && ($status == 2) )){

	 if((isset($crm_pro))  ){ 

	 	 if( (isset($medico_pro)) ){ 

	 	 	if(isset($dias_pro) ){ 

	 	 		  if( (($_SESSION["perfil"] == "medico") || ($_SESSION["perfil"] == "administrador"))){ 


	 	 		  


*/

?>