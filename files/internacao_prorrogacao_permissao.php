<?php



           		switch ($_SESSION["perfil"]) {
           			case 'usuario':

           				  
           				  $exibir = "display: none;";
           				  $leitura = "readonly";


           				  if((isset($status)) && ($status == 1)){
                                         $aviso = ' <br>  <div class="panel with panel-danger class ">
                                                  <div class="panel-heading"> 
                                                  <center> Prorrogação já solicitada, aguardando aprovação.  </center>
                                                  </div>         
                                              </div>'; 

                                         $desativar= " disabled ";

                          }


           				break;
           			
           			case 'medico':
           				           
           				           if((isset($status)) && ($status == 1)){
                                         $aviso = ' <br>  <div class="panel with panel-danger class ">
                                                  <div class="panel-heading"> 
                                                  <center> Aguardando aprovação.  </center>
                                                  </div>         
                                              </div>'; 

                                         $desativar= " disabled ";

                             }else{
                                          $desativar= " disabled ";
                                          $exibir = "display: none;";
                                          $leitura = "readonly";
                             }


           				break;

           			case 'auditor':
           				# code...
           				break;

           			case 'administrdor':
           				# code...
           				break;
           		}

           		$exibir;

			

           		





?>