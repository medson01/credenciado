<?php

   // Arquivo de configuração
  require_once "../config/config.php";

  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br"><head>


    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <meta name="generator" content="Plone - http://plone.org">

    <!-- Internet Explorer fix, forces IE8 into newest possible rendering
         engine even if it's on an intranet. This has to be defined before any


         script/style tags. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    

    <link rel="kss-base-url" href="http://www.ipasealsaude.al.gov.br/ipaseal-saude">


       <link rel="stylesheet" type="text/css" href="../css/base-cachekey3495.css">
       <!-- Estrutura em tabelas do site -->
       <link rel="stylesheet" type="text/css" href="../css/contentpanels-cachekey9970.css">

   
    
  <!-- Bootstrap -->
    
    <script src="http://code.jquery.com/jquery.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.min.css">
    <link rel="kinetic-stylesheet" type="text/css" href="http://www.ipasealsaude.al.gov.br/portal_kss/Tema%20Fabrica/at-cachekey1702.kss">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  


<title>Ipaseal Saúde — ipaseal</title>



    <!-- Disable IE6 image toolbar -->
    <meta http-equiv="imagetoolbar" content="no">
        
    <!-- Script calendario data -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
  

  <script>
    $(function() {
         $( "#cal_inicial" ).datepicker({
              dateFormat: 'ddmmyy', 
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
              dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
              dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S�b','Dom'],
              monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
              monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
      });
    });
  </script>

  <script>
    $(function() {
         $( "#cal_final" ).datepicker({
              dateFormat: 'ddmmyy', 
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
              dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
              dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S�b','Dom'],
              monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
              monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
      });
    });
  </script>
  <!-- fim calendario data -->

    
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

    
    <!-- Mascara para campo -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

   <script type="text/javascript">
    $("#matricula").mask("00000000.000000-00");
    $("#crm").mask("0000");
    </script>
    


  
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
      <table height="772" id="portal-columns">
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