
<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
  // Função calcular idade
  include "../func/calc_idade.php";

	

 ?>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-style: italic;
}
-->
</style>
        
            <td id="portal-column-content">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
                      			<div>

   									<h1 class="documentFirstHeading"> Interna&ccedil;&atilde;o  </h1>
								</div>
                    </div>

 
                    <p><br />
		            </p>
                     <div class="x"></div>
			<div id="feature"></div>
  </div>		
<!-- Conteudo -->
	<?php 
/*
if( $_SESSION["perfil"] == "aut_internacao"){
	$sub_menu = 2;
}else{
	$sub_menu = 1;
}

switch ($sub_menu) {
						case '1':
							// Aba Guia de Internação
							$menu1 =  "Guia de internação";
							$link1 =  "internacao_usuario.php";
							// Em desenvolvimento
							//Aba SP/SADT
							//$menu2 =  "SP/SADT";
							//$link2 =  "sadt_menu.php";
							$link2 =  "procedimento_imagem.php";
							$link7 =  "sadt.php";		
							// Aba Prorrogação
							$menu3 =  "Prorrogação";
							$link6 =  "internacao_usuario.php";
							$link3 =  "imagem_cadastro.php";	
							$link4 =  "internacao_prorrogacao.php";	
							// Aba Acomodação
							$menu5 =  "Acomodação";
							$link5 =  "internacao_acomodacao_formulario.php";

							break;

						case '2':
							// Aba Guia de Internação
							$menu1 =  "Guia de internação";
							$link1 =  "internacao_usuario.php";

							// Aba Autorização TOTVS
							$menu2 =  "Autorização TOTVS";
							$link2 =  "internacao_aut_totvs_formulario.php";

							break;
					

					}
*/

//===================================================================================
// CRIAÇÃO DE ABAS AUTOMÁTICAS
//===================================================================================
//EX.: array(TITULO, PAGINAS)

$tabela = array
					(
            array("Guia_internação","internacao_usuario.php"),  
						array("Prorrogação","imagem_cadastro.php","internacao_prorrogacao.php"),
						array("Acomodação","internacao_acomodacao_formulario.php")
  
					);

//====================================================================================
?>
<p>
 <ul class="nav nav-tabs">
<?php

$i=0;
         foreach ($tabela as $key => $value) {   
              foreach ($tabela[$key] as $cedula => $campo){   
                if($cedula == '0'){    
                  echo '<li ';
                  if ($i == 0) {
                  	echo 'class="active"';
                  }
                  echo'><a data-toggle="tab" href="#'.$campo.'">'.$campo.'</a></li>';
                  $i++;
                }
               
              }
          }
 ?>           
 </ul>
 <div class="tab-content">
 <?php
$i=0;
         foreach ($tabela as $key => $value) {   
              foreach ($tabela[$key] as $cedula => $campo){ 
              	 
                if($cedula == '0'){    

                  echo'<div id="'.$campo.'" class="tab-pane fade ';
                  if ($i == 0) {
                  	echo 'active in';
                  }
                  echo'">';
                 	$i++;

                }
                if($cedula <> 0){

 									include "$campo"; 
 									
                } 
                	
              }
              echo "</div>";
          }
 
 ?> 
</div>			       
	



	<!--/ Coonteudo -->                      
	            
	           
	          </tr>
	        </tbody>
	    </table>

	</div>
	  
	  
	 <?php
	 
	 	  include "rodape.php";
	 ?>     