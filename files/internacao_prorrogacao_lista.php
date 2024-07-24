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

  $a = "SELECT prorrogacao.id as id_prorrogacao, prorrogacao.medico_solicitante, prorrogacao.motivo, prorrogacao.motivo_autorizacao, prorrogacao.data_inicial,prorrogacao.data_final, prorrogacao.data_inicial_aut,prorrogacao.data_final_aut,prorrogacao.dias_solicitados, prorrogacao.dias_autorizados, prorrogacao.qtd_motora, prorrogacao.qtd_respiratoria, prorrogacao.qtd_motora_aut, prorrogacao.qtd_respiratoria_aut,prorrogacao.data_prorrogacao, prorrogacao.data_autorizacao, prorrogacao.status, imagem.id as id_imagem, imagem.nome, imagem FROM prorrogacao INNER JOIN imagem on imagem.id_prorrogacao = prorrogacao.id WHERE prorrogacao.id_internamento=".$_GET['id']; 

$d =  "  ORDER BY `id_prorrogacao` DESC   LIMIT ".$pagina.", ".$itens_por_pagina;

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
      <td width="26" rowspan="5" align="center" style="vertical-align: inherit; border-radius: 25px 0px 0px 25px; <?php if(isset($aquivos["status"]) && $aquivos["status"] <> 2){ echo"background: #95FFFF;"; }else{ echo 'background: #C0C0C0; ';}  ?> ">
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
      <td colspan="11"  align="left" bgcolor="#95FFFF" >
	  
	  <div >
	  <div align="center" class="style1" style="width:50%; display:inline-block; text-align: end;">SOLICITAÇÃO</div><div style="width:50%; display:inline-block; text-align: end;">
	    <div align="right"  class="style1">
      <?php echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_prorrogacao'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php 
	  				if( ($aquivos['status'] == 1)  && ($_SESSION["perfil"] <> "medico")){ 
                    echo '
					<a  href="#" class="hidden-print" onclick="excluir('.$_GET['id'].','.$aquivos['id_prorrogacao'].' )"> 
                      <span class="glyphicon glyphicon-trash" style="color: blue; font-size: 15px;"></span>   
					</a>';
                   }
	  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	    </div>
	  </div>		</td>
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
      <td colspan="9" align="left"> 
        MÉDICO  :
      <?php echo "&nbsp;&nbsp;<strong><span style='font-size: 12px;'>".$aquivos['medico_solicitante']."</span></strong>  <br> 
	  	PERÍODO:&nbsp;&nbsp; <strong><span style='font-size: 12px;'>".formatar_banco_data($aquivos['data_inicial'])."</span></strong> 		  	&nbsp;&nbsp;À&nbsp;&nbsp; <strong><span style='font-size: 12px;'>".formatar_banco_data($aquivos['data_final'])."</span></strong>, &nbsp;&nbsp;<strong><span style='font-size: 12px;'>".$aquivos['dias_solicitados']."</span></strong>&nbsp;&nbsp; DIÁRIAS."; ?> <br />
      FISIOTERAPIAS &nbsp;&nbsp; MOTORA:
       <strong> <span style='font-size: 12px;'>  <?php if(isset($aquivos['qtd_motora'])){ echo  $aquivos['qtd_motora'];}else{ echo "0.";} ?> </span></strong>,&nbsp;&nbsp;
RESPIRATÓRIA: 
<strong><span style='font-size: 12px;'><?php if(isset($aquivos['qtd_respiratoria'])){echo  $aquivos['qtd_respiratoria'];}else{ echo "0."; } ?></span> </strong>.<br />
		MOTIVO DA PRORROGAÇÃO:<br />
	<strong><span style='font-size: 12px;'>	
	<textarea id="motivo_autorizacao" class="form-control input-sm" name="motivo_autorizacao"  rows="4" cols="60" onmousemove="auto_grow(this);" onkeyup="auto_grow(this);"  style="font-size:12px; margin-top: 20px; resize:nome; overflow:hidden; width: 100%;" form="internacao_prorrogacao_cadastro"  <?php if((isset($status) && $status == 2) || isset($aquivos['motivo'])){ echo "readonly"; } ?>/><?php
                                        if(!empty($aquivos['motivo']) ){
                                           echo $aquivos['motivo']; 
                                        }
                                        ?></textarea>
		<?php //echo $aquivos['motivo']; ?> 
	</span> </strong><br />	</td>
		  <td width="77"><a style="color: blue;" href="internacao_menu.php?id=<?php echo $_GET["id"]; ?>&ali=0"></a>
  <div>&nbsp;&nbsp;</div>
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
<div align="center" class="style1" style="width:50%; display:inline-block; text-align: end;">AUTORIZAÇÃO</div><div style="width:50%; display:inline-block; text-align: end;">
	    <div align="right"  class="style1">
    <?php  if(isset($aquivos['data_autorizacao'])){ echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_autorizacao'])); }else{ echo ''; } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
       &nbsp;&nbsp;&nbsp;&nbsp;</div>
</td>
    <tr style="font-size: 10px; text-align: justify; ">
      <td align="left"></td>
      <td colspan="9" align="left" ><div <?php if($_SESSION["perfil"] <> 'medico' && $aquivos["status"] <> 2){ echo 'style="display: none;"';}else{ echo'style="display: block;"'; } ?> > <?php echo "PERÍODO: &nbsp;&nbsp; <span style='font-size: 12px;'><strong>".formatar_banco_data($aquivos['data_inicial_aut'])."</span></strong>&nbsp;&nbsp;  Á &nbsp;&nbsp; <strong><span style='font-size: 12px;'>".formatar_banco_data($aquivos['data_final_aut'])."</span></strong>, <strong><span style='font-size: 12px;'>".$aquivos['dias_autorizados']."</span></strong> &nbsp;&nbsp; DIÁRIA(S)."; ?> <br />
        FISIOTERAPIAS &nbsp;&nbsp; MOTORA:<strong><span style='font-size: 12px;'>
  <?php if(isset($aquivos['qtd_motora_aut'])){ echo  $aquivos['qtd_motora_aut'];}else{ echo "0";} ?>
  </span></strong>,&nbsp;&nbsp;
        RESPIRATÓRIA:<strong><span style='font-size: 12px;'>
              <?php if(isset($aquivos['qtd_respiratoria_aut'])){echo  $aquivos['qtd_respiratoria_aut'];}else{ echo "0."; } ?>
              </span></strong>&nbsp;&nbsp;<br />
              <?php 
			if( $aquivos['qtd_motora_aut'] <> $aquivos['qtd_motora'] || $aquivos['qtd_respiratoria'] <> $aquivos['qtd_respiratoria_aut']){ 
				echo "<span style='color: blue; font-style: italic;'> Aviso: Quantidade de fisioterapias solicitadas diferete das autorizadas!</br></span> ";
			}
		?>
        OBSERVAÇÕES:<br />
  <strong><span style='font-size: 12px;'>
  <textarea id="textarea" class="form-control input-sm" name="textarea"  rows="4" cols="60" onmousemove="auto_grow(this);" onkeyup="auto_grow(this);"  style="font-size:12px; margin-top: 20px; resize:nome; overflow:hidden; width: 100%;" form="internacao_prorrogacao_cadastro"  <?php if((isset($status) && $status == 2) || isset($aquivos['motivo_autorizacao'])){ echo "readonly"; } ?>/>
  <?php
                                        if(!empty($aquivos['motivo_autorizacao']) ){
                                           echo $aquivos['motivo_autorizacao']; 
                                        }
                                        ?>
  </textarea>
  <?php //if(!empty($aquivos['motivo_autorizacao']) ){ echo $aquivos['motivo_autorizacao']; } ?>
  </span></strong>
  </p>
      </div></td>
      <td align="center" style="border-radius: 0px 0px 25px 0px ; align-content: center;"><div ><span >
        <?php

            if( $aquivos['status'] == 1 ){ 
               echo "<font ><strong><a  style='font-family: Andale monospace;'   href=\"javascript:func()\" onmouseover=\"Tip(' Prorrogação em analise ')\" onmouseout=\"UnTip()\"> ";
			   echo "<span class='glyphicon glyphicon-warning-sign' style='color: slategrey; font-size: 15px;' ></span>"; 
            }elseif (is_null($aquivos['status'])){
              echo "";
            }else {           
              echo "<font ><strong><a  style='font-family: Andale monospace;' href=\"javascript:func()\" onmouseover=\"Tip('Prorrogação autorizada!')\" onmouseout=\"UnTip()\"><span class='
glyphicon glyphicon-ok' style='color: blue; font-size: 15px;' ></span></font>";                     
            }
			

        ?>
      </span></div></td>
    </tr>
    <tr style="font-size: 10px; text-align: justify; " bgcolor="#A6FFA6" >
      <td align="left">      </td>    
      <td colspan="9" align="left" >
	   
	      <div align="center" class="style1" style="width:55%; display:inline-block; text-align: end;">
	        <div align="right">ALIMENTAÇÃO</div>
	      </div>
	      <div align="right" style="width:40%; display:inline-block; text-align: end;"> 
		  	<font >
				<strong>
					<a  style='color: blue; font-family: Andale monospace;'href="internacao_menu.php?id=<?php echo $_GET["id"]; ?>&id_prorro=<?php echo $aquivos["id_prorrogacao"]; ?>&data_inicial=<?php echo $aquivos["data_inicial_aut"]; ?>&data_final=<?php echo $aquivos["data_final_aut"]; ?>&dias_autorizados=<?php echo $aquivos["dias_autorizados"]; ?> "  onmouseover="Tip('Adicionar Alimentação!')" onmouseout="UnTip()">
	      <button type="button" class="btn" style="padding:1px"><img src="../imagem/alimentacao01.png" width="20" height="20" style="margin:0" /></button>
				  </a> 
		  		</span>
		  	</font>        
		  </div>
	  </td>
	  <td align="center" style="border-radius: 0px 0px 25px 0px ; align-content: center;">&nbsp;</td>
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
   //  Acesso Modal Prorrogacao
  include("internacao_prorrogacao_modal.php"); 
  ?>
</div>
