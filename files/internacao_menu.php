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
							
							$menu2 =  "Autorização Exames";
							$link2 =  "teste5.php";
							
							break;
					
						case '2':

							$menu1 = "Lista internação";
							$link1 =  "internacao_lista.php";
							
							$menu2 = "Lista internação";
							$link2 =  "internacao_lista.php";
							
							break;
					}
					
					
?>					
			       
	<ul class="nav nav-tabs">
    	<li class="active">
			<a data-toggle="tab" href="#menu1" class="hidden-print"><?php echo $menu1; ?></a>
		</li>
		<li>
			<a data-toggle="tab" href="#menu2" class="hidden-print"><?php echo $menu2; ?></a>
		</li>

 	</ul>				
					
<div class="tab-content">

    <div id="menu1" class="tab-pane	in active">
			<?php include 'internacao_usuario.php';?>
    </div>

	<div id="menu2" class="tab-pane fade" >
				<?php include 'teste5.php';?>
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