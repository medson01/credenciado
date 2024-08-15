 <!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

  <?php
// FORMATA A DATA QUE ESTÁ NO FORMATO ENG PARA BR NO BANCO
	require_once "../func/formatar_data_banco.php";
	
// CONTROLE DE EXIBIÇÃO DE FORMULARIOS
	if($_SESSION["perfil"] <> 'medico'){
		$exibir_medico =  'style="display: block;"';
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

  $a = "SELECT prorrogacao.id as id_prorrogacao, prorrogacao.data_inicial_aut,prorrogacao.data_final_aut,prorrogacao.dias_autorizados, 
  imagem.id as id_imagem, imagem.nome, imagem , 
  alimentacao.id AS id_alimentacao, alimentacao.medico_solicitante,alimentacao.crm, alimentacao.nutrologo, alimentacao.crm_rqe, alimentacao.qtd_diarias, alimentacao.terapia_nutricial,alimentacao.por_dia, alimentacao.motivo_solicitacao, alimentacao.data_inicial, alimentacao.data_final,alimentacao.data_sol_alimentacao,alimentacao.motivo_autorizacao ,alimentacao.status 
  FROM alimentacao 
  INNER JOIN prorrogacao ON prorrogacao.id = alimentacao.id_prorro
  INNER JOIN imagem on imagem.id_prorrogacao = prorrogacao.id 
  WHERE prorrogacao.id_internamento=".$_GET['id']." 
  AND prorrogacao.status=2"; 

  $d =  "  ORDER BY `id_alimentacao` DESC   LIMIT ".$pagina.", ".$itens_por_pagina;

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
.style2 {color: #0000FF}
-->
  </style>
  
<br>
<div style="width:40px;float: right;" >
		<button  class="btn btn-default glyphicon glyphicon-print hidden-print" onclick="javascript:print();"> 
		 
		</button>
</div>		
     <h5 align="center" class="visible-print"> HIST&Oacute;RICO DE ALIMENTAÇÃO </h3>
     
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
      <td colspan="21" align="center" class="info"><div align="center">ALIMENTAÇÕES</div></td>
    </tr>

    <?php
	
    while($aquivos = $stmt1->fetch(PDO::FETCH_ASSOC)){ 
         
          $id_imagem = $aquivos['id_imagem'];
    ?>
    
    <tr style="font-size: 10px; text-align: justify">
      <td width="26" rowspan="4" align="center" style="vertical-align: inherit; border-radius: 25px 0px 0px 25px; <?php if(isset($aquivos["status"]) && $aquivos["status"] <> 2){ echo"background: #95FFFF;"; }else{ echo 'background: #C0C0C0; ';}  ?> ">
        <br>
		<span style="font-size: small; font-weight: 800; ">
      		<?php  
				if(isset($aquivos["status"]) && $aquivos["status"] <> 2){
					echo "<a  id='ticket' href = 'internacao_menu.php?id=".$_GET['id']."&id_prorro=".$aquivos['id_prorrogacao']."&ali=".$aquivos["id_alimentacao"]."'>".$aquivos['id_alimentacao']."</a>";
					
				}else{
					echo $aquivos['id_alimentacao'];
				
				} 
			?>
  	  </span>	  </td>
      <td colspan="11"  align="left" bgcolor="#95FFFF" >
	  
	  <div >
	  <div align="center" class="style1" style="width:50%; display:inline-block; text-align: end;">SOLICITAÇÃO</div>
	  <div style="width:50%; display:inline-block; text-align: end;">
	  <div align="right"  class="style1">
        <?php  if(isset($aquivos['data_autorizacao'])){ echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_autorizacao'])); }else{ echo ''; } ?>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	    &nbsp;&nbsp;&nbsp;&nbsp;</div>	  </td>
      <!-- DATA DE AUTORIZAÇÃO 
	  <td width="136" >
      <div align="left">Data
        Autoriza&ccedil;&atilde;o<br>
        <?php if(!empty($aquivos['data_autorizacao'])){
      			//	echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_autorizacao'])); 
			      }
		?></div>
    </td>
	 -->
    </tr>
    <tr style="font-size: 10px; text-align: justify">
      <td width="36" align="left">	  </td>
      <td colspan="9" >PRORROGAÇÃO Nº: 
	  <span style="font-size: 12px;"><strong>
<?php  
				if(isset($aquivos["id_prorrogacao"])){
					echo $aquivos['id_prorrogacao'];
				}
			?>
</span></strong><br />
PERÍODO DA PRORROGAÇÃO:<?php echo " &nbsp;&nbsp; <span style='font-size: 12px;'><strong>".formatar_banco_data($aquivos['data_inicial_aut'])."</span></strong>&nbsp;&nbsp;  Á &nbsp;&nbsp; <strong><span style='font-size: 12px;'>".formatar_banco_data($aquivos['data_final_aut'])."</span></strong>, <span style='font-size: 12px;'><strong>&nbsp;&nbsp;".$aquivos['dias_autorizados']."</span></strong> &nbsp;&nbsp;diária(s)."; ?><br />
MÉDICO SOLICITANTE:
<span style="font-size: 12px;"><strong>
<?php if(isset($aquivos['medico_solicitante'])){ echo  $aquivos['medico_solicitante'];}else{ echo "0";} ?> 
</span></strong>
         , 
CRM:
<span style="font-size: 12px;"><strong>
<?php if(isset($aquivos['crm'])){ echo  $aquivos['crm'];}else{ echo "0";} ?>
</span></strong>
<br />
NUTRÓLOGO:
<span style="font-size: 12px;"><strong>
<?php if(isset($aquivos['nutrologo'])){ echo  $aquivos['nutrologo'];}else{ echo "0";} ?>
</span></strong>
, 
CRM/RQE:
<span style="font-size: 12px;"><strong>
<?php if(isset($aquivos['crm_rqe'])){ echo  $aquivos['crm_rqe'];}else{ echo "0";} ?>
</span></strong>
<br />
TERAPIA:
<span style="font-size: 12px;"><strong>
<?php if(isset($aquivos['terapia_nutricial'])){ echo  utf8_encode($aquivos['terapia_nutricial']);}else{ echo "0";} ?>
</span></strong><br />
<span class="style2">QTD. DE DIÁRIAS DE ALIMENTAÇÃO:
<span style="font-size: 12px; color: #FF0000;"><strong>
<?php if(isset($aquivos['qtd_diarias'])){ echo  $aquivos['qtd_diarias'];}else{ echo "0";} ?>
</span></strong><br />
QTD.DE VEZES POR DIA:
<span style="font-size: 12px; color: #FF0000; "><strong>
<?php if(isset($aquivos['por_dia'])){ echo  $aquivos['por_dia'];}else{ echo "0";} ?>
</span></strong></span><br />
TOTAL DE ALIMENTAÇÕES: &nbsp;&nbsp; <span style='font-size: 14px; color:#FF0000'> <?php echo $total_alimentacao = $aquivos['por_dia']*$aquivos['qtd_diarias']; ?></span><br />
<br />
MOTIVO DA SOLICITAÇÃO :
<textarea id="internacao_alimentacao_cadastro" class="form-control input-sm" name="internacao_alimentacao_cadastro"  rows="4" cols="60" onmousemove="auto_grow(this);" onkeyup="auto_grow(this);"  style="font-size:12px;  resize:nome; overflow:hidden; width: 100%;" form="internacao_alimentacao_cadastro"  <?php if((isset($status) && $status == 2) || isset($aquivos['motivo'])){ echo "readonly"; } ?>/>
<?php
                                        if(!empty($aquivos['motivo_solicitacao']) ){
                                           echo $aquivos['motivo_solicitacao']; 
                                        }
                                        ?></textarea>

</span></strong></td>
		  <td width="77"><a style="color: blue;" href="internacao_menu.php?id=<?php echo $_GET["id"]; ?>&ali=0"></a>
		    <div align="center">
		      <?php 

        echo '<a style=" color: blue; font-weight: bold;  " class="hidden-print" href="imagem_exibir.php?id='.$aquivos['id_imagem'].'"  target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
</svg>
            <br />'.$aquivos["id_imagem"].'</a>'; 


        echo '<span class="visible-print">Imagem '.$aquivos["id_imagem"].'</span>';        ?>
		    </div></td></tr>
<td colspan="11"  align="left" bgcolor="#A6FFA6" >

<!-- ADICIONAR MOTÃO SOLICITAR ALIMENTAÇÃO -->
<div align="center" class="style1" style="width:50%; display:inline-block; text-align: end;">  
  AUTORIZAÇÃO </div>
<div align="center" class="style1" style="width:45%; display:inline-block; text-align: end; ">  
      <?php  if(isset($aquivos['data_autorizacao'])){ echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_autorizacao'])); }else{ echo ''; } ?>  
</div></td>
    <tr style="font-size: 10px; text-align: justify; ">
      <td align="left">&nbsp;</td>
      <td colspan="9" align="left" ><div <?php if($aquivos["status"] <> 2){ echo 'style="display: none;"';}else{ echo'style="display: block;"'; } ?> >
        MÉDICO:
        <?php if(isset($aquivos['medico_solicitante'])){ echo  $aquivos['medico_solicitante'];}else{ echo "0";} ?>
        , 
		CRM/RQE:
        <?php if(isset($aquivos['crm'])){ echo  $aquivos['crm'];}else{ echo "0";} ?><br />
        TERAPIA: <span style="font-size: 12px;"><strong>
        <?php if(isset($aquivos['terapia_nutricial'])){ echo  $aquivos['terapia_nutricial'];}else{ echo "0";} ?>
        </span></strong><br />
        <span class="style2">QTD. DE DIÁRIAS DE ALIMENTAÇÃO: <span style="font-size: 12px; color: #FF0000;"><strong>
        <?php if(isset($aquivos['qtd_diarias'])){ echo  $aquivos['qtd_diarias'];}else{ echo "0";} ?>
        </span></strong><br />
QTD.DE VEZES POR DIA: <span style="font-size: 12px; color: #FF0000; "><strong>
<?php if(isset($aquivos['por_dia'])){ echo  $aquivos['por_dia'];}else{ echo "0";} ?>
</span></strong></span><br />
TOTAL DE ALIMENTAÇÕES: &nbsp;&nbsp; <span style='font-size: 14px; color:#FF0000'> <?php echo $total_alimentacao = $aquivos['por_dia']*$aquivos['qtd_diarias']; ?></span><br />
        OBSERVAÇÕES DA AUTORIZAÇÃO: 
        </p>
        </div>	  
		
		<textarea id="textarea" class="form-control input-sm" name="textarea"  rows="4" cols="60" onmousemove="auto_grow(this);" onkeyup="auto_grow(this);"  style="font-size:12px; margin-top: 20px; resize:nome; overflow:hidden; width: 100%;" form="internacao_prorrogacao_cadastro"  <?php if((isset($status) && $status == 2) || isset($aquivos['motivo_autorizacao'])){ echo "readonly"; } ?>/>
<?php
                                        if(!empty($aquivos['motivo_autorizacao']) ){
                                           echo $aquivos['motivo_autorizacao']; 
                                        }
                                        ?></textarea>		</td>
      <td align="center" style="border-radius: 0px 0px 25px 0px ; align-content: center;"><div ><span >
        <?php

            if( $aquivos['status'] == 1 ){ 
               echo "<font ><strong><a  style='font-family: Andale monospace;'   href=\"javascript:func()\" onmouseover=\"Tip(' Alimentação em analise ')\" onmouseout=\"UnTip()\"> ";
			   echo "<span class='glyphicon glyphicon-warning-sign' style='color: slategrey; font-size: 15px;' ></span>"; 
            }elseif (is_null($aquivos['status'])){
              echo "";
            }else {           
              echo "<font ><strong><a  style='font-family: Andale monospace;' href=\"javascript:func()\" onmouseover=\"Tip('Alimentação autorizada!')\" onmouseout=\"UnTip()\"><span class='
glyphicon glyphicon-ok' style='color: blue; font-size: 15px;' ></span></font>";                     
            }
			

        ?>
      </span></div></td>
    </tr>
    <tr style="font-size: 10px; text-align: justify; "  >
      <td align="left">      </td>    
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

   <!-- Perguntar antes de excluir -->
<script type="text/javascript">
function excluir(id,id_prorrogacao) {
     var resposta = confirm("Deseja remover esse registro?");
     
     if (resposta == true) {
          window.location.href = "internacao_prorrogacao_excluir.php?id="+id+"&id_prorrogacao="+id_prorrogacao;
     }
}

</script>
<script type="text/javascript">
	function auto_grow(element){
		element.style.height = "5px";
		element.style.height = (element.scrollHeight)+"px";
	}
</script>
	

  
 <?php 
   //  Acesso Modal Alimentação
  include("internacao_alimentacao_modal.php"); 
  ?>
</div>
