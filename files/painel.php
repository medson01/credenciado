<?php 


if(!isset($_SESSION)){

  session_start();
}
	
	if(!isset($_SESSION["login"])){
			header('Location: ../index.html');
	}else{

	//Arquivo de configuração
	include "cabecalho.php";
	

 ?>


 <!-- painel -->

<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-style: italic;
}
-->
</style>
        
            <td id="portal-column-content">

              
                
                  <div class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading"> 

   									 	<!-- Título do painel -->

   									 	<?php

   									 		if(isset($_GET['pa'])){
   									 			$sub_menu= 1;
												$titulo = "Pronto Atendimento";
											}
											if(isset($_GET['int'])){
												$sub_menu= 2;
												$titulo = "Internação";	 		
											}
											if(isset($_GET['cred'])){
												$sub_menu = 3;
												$titulo = "Credenciado";	 		
											}
											if(isset($_GET['aviso'])){
												$sub_menu = 4;
												$titulo = "Aviso";	 		
											}
											if(isset($_GET['caduser'])){
												$sub_menu = 5;
												$titulo = "Cadastro de usuários";	 		
											}
											
											if(isset($_GET['prorro'])){
												$sub_menu = 6;
												$titulo = "Prorrogação";	 		
											}

											if(isset($_GET['acomodacao'])){
												$sub_menu = 7;
												$titulo = "Alterar acomodação";	 		
											}
											
											echo $titulo;
   									 	?>

   									 	<!-- /Título do painel -->
   									 
   									 </h1>
								</div>
                    </div>

 
                    <p><br />
		            </p>
                     <div class="x"></div>
			<div id="feature"></div>
  </div>		
<!-- Conteudo -->
				
	<!-- Sub menu -->
<style type="text/css">


#exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
 
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
</style>

 <div id="exTab2" class="container" style="width: 980px; padding-left: 1px;"> 

 	
<?php

// Relação de paginas do sistema


		require_once("sub_menu.php");

	


?>

<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- /Sub menu -->
	<!-- Sub Conteudo -->
	
	
	
	<!-- Sub Conteudo -->
<!--/ Coonteudo -->                      
                      </p>
              </div>
           
          </tr>
        </tbody>
    </table>

</div>
  
<!-- /painel -->

 <?php
 
 	  include "rodape.php";

 }
 ?>     