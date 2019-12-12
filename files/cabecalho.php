<?php
  //Acertar data e hora 
   date_default_timezone_set('America/Maceio');


   // Arquivo de configuração
  require_once "../config/config.php";

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>


    <meta charset="UTF-8">


    <!-- Internet Explorer fix, forces IE8 into newest possible rendering
         engine even if it's on an intranet. This has to be defined before any


         script/style tags. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    

 


       <link rel="stylesheet" type="text/css" href="../css/base-cachekey3495.css">
       <!-- Estrutura em tabelas do site -->
       <link rel="stylesheet" type="text/css" href="../css/contentpanels-cachekey9970.css">
	   <!-- Remover lixo na impressão -->
	   <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
   
    
  <!-- Bootstrap -->
    
    <script src="http://code.jquery.com/jquery.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  


<title>Credenciado Ipaseal Saúde</title>



    <!-- Disable IE6 image toolbar -->
    <meta http-equiv="imagetoolbar" content="no">
        
    <!-- Script calendario data -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

    
    <style type="text/css">
    <!--
    .style1 {font-size: 24px}
    .style3 {color: #000000}
    .style6 {font-size: 24px; color: #6666FF;}
    .style11 {color: #000000; font-size: 12px; font-style: italic; }
    .style13 {color: #000000; font-size: 20px; }

    -->
    </style>
 
   

    <!-- CSS para o título e conteúdo -->
    <link rel="stylesheet" type="text/css" href="../css/titulo_conteudo.css"/>

        <!-- CSS para o título e conteúdo -->
    <link rel="stylesheet" type="text/css" href="../css/botao_redondo.css"/>


    <!-- Soma campos -->
    <script src="../js/soma.js"></script>
    
    <!-- Mascara para campo -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
	
	

   <script type="text/javascript">
    $("#matricula").mask("00000000.000000-00");
    $("#qtd_motora").mask("00");
    $("#qtd_motora2").mask("00");
    $("#dias_autorizados").mask("00");
	  $("#qtd_respiratoria").mask("00");
    $("#qtd_respiratoria2").mask("00");
	  $("#crm").mask("0000");
    $("#codigo").mask("000000");
    $("#cpf_cnpj").mask("00000000000");
    $("#numero").mask("00000");
    $("#dias").mask("00");
    </script>


	<!-- Mascara para valor monetário -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
   
  





</head>
<body class="section-ipaseal-saude template-contentpanels_view" dir="ltr">
<div id="visual-portal-wrapper">
      <div id="portal-top">
        <div id="portal-header">

<!-- Banner -->
          <div id="portal-logo">
            <p>&nbsp;</p>
            <p>
              <a href="principal.php" id="tema-portal">  IPASEAL SAÚDE  </a>
              <span id="descricao-portal">Instituto de Assistência à Saúde dos Servidores do Estado de Alagoas</span>
            </p>
			 <div align="right" style="color:#FFFFFF">
			   <?php
			 								// Data e hora 
								setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
								date_default_timezone_set('America/Sao_Paulo');
								echo strftime('%A, %d de %B de %Y', strtotime('today'));
			 ?>
	        </div>
          </div>

<!-- /Banner -->

        </div>
      </div>

    <div>
	
	<?php 
      if(isset($_GET["prorro"])){
	  
	  	echo "<table height='1500px' id='portal-columns'>";
	  
	  }else{
	  
	  	echo "<table id='portal-columns'>";
	  }
	?>  
	  
        <tbody>
          <tr>
            
            <td width="209" height="766" id="portal-column-one"><p align="center" class="style1">
              </p>
              <p>
    
    
<!-- Menu sistema -->       
              <div class="col-sm-6 col-md-3" style="">
                        <?php   

                            include 'menu.php';

                         ?>
              </div>
                
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
<!-- Fim Menu sistema -->

                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>

            </td>

  <!-- Conteudo -->           