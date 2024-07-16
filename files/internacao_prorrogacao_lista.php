 <!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

  <?php
// FORMATA A DATA QUE ESTÁ NO FORMATO ENG PARA BR NO BANCO
	require_once "../func/formatar_data_banco.php";
	
// CONTROLE DE EXIBIÇÃO DE FORMULARIOS
	if($_SESSION["perfil"] <> 'medico'){
		$exibir_medico =  'style="display: block;;"';
	}else{
		$exibir_medico =  'style="display: none;"';
	}
  

// NAVEGAÇÃO ENTRE AS PÁGINAS
// ==========================================
// define o número de itens por página
$itens_por_pagina = 5; 
// pega a página atual
 if(isset($_GET['pagina'])){
  $pagina = intval($_GET['pagina']);
 }elseif(isset($_GET['ultima_pagina'])){
  $pagina = intval($_GET['ultima_pagina']);
 }else{
  $pagina = 0;
 }
// ===========================================

  $a = "SELECT prorrogacao.id as id_prorrogacao, prorrogacao.medico_solicitante, prorrogacao.motivo, prorrogacao.motivo_medico, prorrogacao.data_inicial,prorrogacao.data_final, prorrogacao.data_inicial_aut,prorrogacao.data_final_aut,prorrogacao.dias_solicitados, prorrogacao.dias_autorizados, prorrogacao.qtd_motora, prorrogacao.qtd_respiratoria, data, prorrogacao.status, imagem.id as id_imagem, imagem.nome, imagem FROM prorrogacao INNER JOIN imagem on imagem.id_prorrogacao = prorrogacao.id WHERE prorrogacao.id_internamento=".$_GET['id']; 

$d =  "    LIMIT ".$pagina.", ".$itens_por_pagina;

  $sql1 = $a.$d;

  $stmt1 = $pdo->prepare($sql1);

  $stmt1->execute();

  // numero de linhas com o critério LIMIT
  $num = $stmt1->rowCount();

  
  //quantidade todal de objetos no banco 

  $stmt2 = $pdo->prepare($a);
  
  $stmt2->execute();

  $num_total = $stmt2->rowCount();

  // definir o numero de paginas
  $num_paginas = ceil($num_total/$itens_por_pagina);
   
  $ultima_pagina  = $num_total - ($itens_por_pagina*$num_paginas - $num_total); 
 

   $resultado = mysqli_query($conn, $a);


?>
  <style type="text/css">
<!--
.style1 {font-size: 10px}
-->
  </style>
  
<br>
  
    <div align="left" <?php echo $exibir_medico; ?> >
	<a href="internacao_menu.php?id=<?php echo $_GET['id']?>&prorro=0">
  	    <button type="button" class="btn btn-primary" style="width:87px" id="incluir"
		<?php 
			if($_SESSION["perfil"] == "callcenter"){
				 echo" disabled "; 
			}		
		
		?> > Incluir </button> </a>
	</div>	
		<div style="width:40px;float: right;" >
		<button  class="btn btn-default glyphicon glyphicon-print hidden-print" onclick="javascript:print();"> 
		 
		</button>
		</div>		
     <h5 align="center" class="visible-print"> HIST&Oacute;RICO DE PRORROGA&Ccedil;&Otilde;ES </h3>
     
        <table width="100% " border="0" align="center" class="hidden-print">
		<tr >
                              <td >&nbsp;</td>
                              <td >&nbsp;</td>
                              <td >&nbsp;</td>
          </tr>
		                    <tr>
                              <td colspan="3" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              &nbsp;</td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td >&nbsp;</td>
                              <td >&nbsp;</td>
                            </tr>
	</table>	
<table width="996" border="0"  class="table table-bordered" >
    <tr style="font-size: 12px">
      <td colspan="21" align="center" class="info"><div align="center">PRORROGAÇÕES</div></td>
    </tr>

    <?php
    while($aquivos = $stmt1->fetch(PDO::FETCH_ASSOC)){ 
         
          $id_imagem = $aquivos['id_imagem'];
    ?>
    
    <tr style="font-size: 10px; text-align: justify">
      <td width="26" rowspan="4" align="center" style="vertical-align: inherit;">
        <br>
		<span style="font-size: small; font-weight: 800; ">
      		<?php  
				if(isset($aquivos["status"]) && $aquivos["status"] <> 2){
					echo "<a  id='ticket' href = 'internacao_menu.php?id=".$_GET['id']."&prorro=".$aquivos["id_prorrogacao"]."'>".$aquivos['id_prorrogacao']."</a>";
				}else{
					echo $aquivos['id_prorrogacao'];
				
				} 
			?>
	  	</span>	  </td>
      <td colspan="11"  align="left">
	  
	  <div ><div align="center" class="style1" style="width:50%; display:inline-block; text-align: end;">SOLICITAÇÃO</div><div style="width:50%; display:inline-block; text-align: end;">
	    <div align="right"  class="style1">
	    <?php echo date("j/n/Y,  H:i:s",strtotime($aquivos['data'])); ?></div></div>		</td>
      <!-- DATA DE AUTORIZAÇÃO 
	  <td width="136" >
      <div align="left">Data
        Autoriza&ccedil;&atilde;o<br>
        <?php if(!empty($aquivos['data_autorizacao'])){
      				echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_autorizacao'])); 
			      }
		?></div>
    </td>
	 -->
    </tr>
    <tr style="font-size: 10px; text-align: justify">
      <td width="36" align="left">&nbsp;</td>
      <td colspan="9" align="left"> 
          Medico  :
      <?php echo "<strong>".$aquivos['medico_solicitante']."</strong>  <br> Período: <strong>".formatar_banco_data($aquivos['data_inicial'])."</strong> à <strong>".formatar_banco_data($aquivos['data_final'])."</strong>, <strong>".$aquivos['dias_solicitados']."</strong> diárias."; ?> <br />
      F.M
          <?php if(isset($aquivos['qtd_motora'])){ echo  $aquivos['qtd_motora'];}else{ echo "0";} ?>, 
F.R.
<?php if(isset($aquivos['qtd_respiratoria'])){echo  $aquivos['qtd_respiratoria'];}else{ echo "0"; } ?>
<br />
Solicita&ccedil;&atilde;o: <?php echo $aquivos['motivo']; ?>, <br /></td>
		  <td width="61"><div align="center">Arquivo
            <br />
            <?php 

        echo '<a class="hidden-print" href="imagem_exibir.php?id='.$aquivos['id_imagem'].'"  target="_blank">'.$aquivos["id_imagem"].'</a>'; 


        echo '<span class="visible-print">Imagem '.$aquivos["id_imagem"].'</span>';
        ?>
		  </div></td>
    </tr>
<td colspan="11"  align="left">
<div >
<div align="center" class="style1" style="width:50%; display:inline-block; text-align: end;">AUTORIZAÇÃO</div><div style="width:50%; display:inline-block; text-align: end;">
	    <div align="right"  class="style1">
	    <?php echo date("j/n/Y,  H:i:s",strtotime($aquivos['data'])); ?></div></div></td>
    <tr style="font-size: 10px; text-align: justify">
      <td align="left">&nbsp;</td>    
      <td colspan="9" align="left">
        Medico  : <?php echo "<strong>".$aquivos['medico_solicitante']."</strong>  <br> Período autorizado: <strong>".formatar_banco_data($aquivos['data_inicial_aut'])."</strong> à <strong>".formatar_banco_data($aquivos['data_final_aut'])."</strong>, <strong>".$aquivos['dias_autorizados']."</strong> diárias."; ?>
          <br />
        F.M
        <?php if(isset($aquivos['qtd_motora'])){ echo  $aquivos['qtd_motora'];}else{ echo "0";} ?>, 
F.R.
<?php if(isset($aquivos['qtd_respiratoria'])){echo  $aquivos['qtd_respiratoria'];}else{ echo "0"; } ?> <br />
Retorno:        
          <?php if(!empty($aquivos['motivo_medico']) ){ echo $aquivos['motivo_medico']; } ?>              </td><td><span style="vertical-align: inherit;">
        <?php

            if( $aquivos['status'] == 1 ){ 
               echo "<font ><strong><a  style='font-family: Andale monospace;'   href=\"javascript:func()\" onmouseover=\"Tip(' Prorrogação em analise ')\" onmouseout=\"UnTip()\"> ";
			   echo "<span class='glyphicon glyphicon-warning-sign' style='color: slategrey; font-size: 15px;' ></span>"; 
            }elseif (is_null($aquivos['status'])){
              echo "";
            }else {           
              echo "<font ><strong><a  style='font-family: Andale monospace;' href=\"javascript:func()\" onmouseover=\"Tip('Prorrogação autorizada!')\" onmouseout=\"UnTip()\"><span class='
glyphicon glyphicon-ok' style='color: slategrey; font-size: 15px;' ></span></font>";                     
            }
			
if( ($aquivos['status'] == 1)  && ($_SESSION["perfil"] <> "medico")){ 
	
                    echo '<a   class="hidden-print" onclick="excluir('.$_GET['id'].','.$aquivos['id_imagem'].','.$aquivos['id_prorrogacao'].' )"> 
                           <button type="button" class="btn btn-danger glyphicon glyphicon-remove"></button> </a>';
                   }
        ?>
        </span></td>
  </tr>
    <?php 
            $w = $aquivos['id_prorrogacao'];
              } ?>
</table>
     
      <span class="style2">*F.M.: Fisioterapia Motora<br />
                           &nbsp; F.R.: Fisioterapia Respitarória </span><br />

<br />
<?php
         
          If(empty($w)){
          echo "<div class='alert alert-warning' style='text-align:center'>
                                    É necessário preencher os dados abaixo para que a solicitação seja atendida.
                   
                </div>";
        }
?>

<!-- NAVEGAÇÃO DAS PAGINAS GERADAS PELA CONSULTA MILIT -->
  <!-- CONTADOR DE REGISTROS -->        
        <?php 
          $registro1 = $pagina + 1;
          $registro2 = $itens_por_pagina+ $pagina;
          if($registro2 > $num_total){
            $registro2 = $num_total;
          }else{
            $registro2 = $itens_por_pagina+ $pagina;
          }

        ?>

  <!-- NAVEGAÇÃO DAS PAGINAS GERADAS PELA CONSULTA MILIT -->

  <!-- CONTADOR DE REGISTROS -->        
        <?php 
          $registro1 = $pagina + 1;
          $registro2 = $itens_por_pagina+ $pagina;
          if($registro2 > $num_total){
            $registro2 = $num_total;
          }else{
            $registro2 = $itens_por_pagina+ $pagina;
          }
          echo '<span id="ticket"> <i> Do '.$registro1.'º ao '.$registro2.'º, total de '.$num_total.'</i> '; 

           if( (!isset($_GET['buscar'])) && (!isset($_GET['mes']))){
            echo "registros.</span>";
           
          }
        ?>

<!-- BARRA DE NAVEGAÇÃO DE REGISTROS -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-backward" href="internacao_menu.php?id=<?php echo $_GET['id']; ?>&prorro=1&pagina=0" aria-label="Previous">               
                </a>
              </li>
    <!-- REMETE PARA O REGISTRO ANTERIOR -->            
              <li >
                <a class="glyphicon glyphicon-chevron-left"  href="internacao_menu.php?id=<?php echo $_GET['id']; ?>&prorro=1&pagina=<?php echo $registro1-$itens_por_pagina-1; ?>">              
                </a>
              </li> 
    <!-- REMETE PARA O REGISTRO POSTERIOR-->            
              <li class="page-item">
                <a class="glyphicon glyphicon-chevron-right"  href="internacao_menu.php?id=<?php echo $_GET['id']; ?>&prorro=1&pagina=<?php echo $registro2-1; ?>" aria-label="Next">
                            
                </a>
              </li> 
    <!-- REMETE PARA O ULTIMO REGISTRO -->            
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-forward"  href="internacao_menu.php?id=<?php echo $_GET['id']; ?>&prorro=1&pagina=<?php echo $ultima_pagina-1; ?>" aria-label="Next">
                           
                </a>
              </li> 

            </ul>
      </nav>
  <!-- // -->
 <?php 
   //  Acesso Modal Prorrogacao
  include("internacao_prorrogacao_modal.php"); 
  ?>
</div>
