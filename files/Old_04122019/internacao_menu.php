<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
  
	

 ?>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-style: italic;
}
-->
</style>
        
            <td width="898" id="portal-column-content">

              
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

$sub_menu = 1;
switch ($sub_menu) {
						case '1':

							$menu1 =  "Guia de internação";
							$link1 =  "internacao_usuario.php";
							
							//$menu2 =  "Autorização Exames";
							//$link2 =  "imagem_cadastro.php";	

							$menu3 =  "Prorrogação";
							$link3 =  "imagem_cadastro.php";	
							$link4 =  "internacao_prorrogacao.php";	

							$menu5 =  "Acomodação";
							$link5 =  "internacao_acomodacao_formulario.php";

							break;
					

					}
					
					
?>					
			       
	<ul class="nav nav-tabs">
    	<li <?php if(!(isset($_GET["status"]))){ echo "class='active'"; } ?> >
			<a data-toggle="tab" href="#menu1" class="hidden-print"><?php echo $menu1; ?></a>
		</li>
	<!-- 
		<li>
			<a data-toggle="tab" href="#menu2" class="hidden-print"><?php echo $menu2; ?></a>
		</li>
	-->
		<li <?php if(isset($_GET["status"])){ echo "class='active'"; } ?> >
			<a data-toggle="tab" href="#menu3" class="hidden-print"><?php echo $menu3; ?></a>
		</li>
		<li>
			<a data-toggle="tab" href="#menu5" class="hidden-print"><?php echo $menu5; ?></a>
		</li>


 	</ul>				
					
<div class="tab-content">

    <div id="menu1" class="tab-pane	  <?php if(!(isset($_GET["status"]))){ echo "in active "; } ?>    ">
			    <?php include $link1;?>
    </div>
<!--
	<div id="menu2" class="tab-pane fade" >
				<?php include $link2;?>
   	</div>
-->
   	<div id="menu3" class="tab-pane fade  <?php if((isset($_GET["status"]))){ echo "in active "; } ?> ">
				<?php include $link3;?>
				<?php include $link4;?>
   	</div>
   	<div id="menu5" class="tab-pane fade" >
				<?php include $link5;?>
   	</div>

  </div>		
					
<!--/ Coonteudo -->                      
                      </p>
              </div>
           
          </tr>
        </tbody>
    </table>

</div>
  
  
 <?php
 
 	  include "rodape.php";
 ?>     