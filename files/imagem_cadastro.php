 <!-- Perguntar antes de excluir -->
<script language="Javascript">
function excluir(id,id_imagem,id_prorrogacao) {
     var resposta = confirm("Deseja remover esse registro?");
     
     if (resposta == true) {
          window.location.href = "imagem_excluir.php?id="+id+"&id_imagem="+id_imagem+"&id_prorrogacao="+id_prorrogacao;
     }
}
</script>

 <?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];
  
          $sql = "SELECT prorrogacao.medico_solicitante, prorrogacao.crm, prorrogacao.dias_solicitados, 
                               prorrogacao.motivo, prorrogacao.id as id_prorrogacao, prorrogacao.status, 
                               prorrogacao.id_internamento, prorrogacao.qtd_respiratoria, prorrogacao.qtd_motora,
				   prorrogacao.data_autorizacao
                        FROM internamento

                        INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id
                        WHERE prorrogacao.status <> 2 and internamento.id =".$id;

          $query = mysqli_query($conn,$sql) or die("erro ao carregar consulta");
                   
                  
                                while($registro = mysqli_fetch_row($query)){


                                  $medico_pro = $registro[0];
                                  $crm_pro = $registro[1];
                                  $dias_pro = $registro[2];
                                  $motivo_pro = $registro[3];
                                  $id_prorrogacao = $registro[4];
                                  $status = $registro[5];
                                  $id_internamento = $registro[6];
                                  $qtd_respiratoria = $registro[7];
                                  $qtd_motora = $registro[8];
				      $data_autorizacao = $registro[9];


                                

                             }
                    

                             require_once "internacao_prorrogacao_permissao.php";




                               

?> 

<!-- Esconde o que está dentro da div na impressão -->
<style type="text/css">
<!--
.text1 {
	font-size: 9px;
	font-style: italic;
}
.style2 {font-size: 9px; font-style: italic; color: #FF0000; }
-->
</style>


<div class="visible-print">
  <center>
<?php echo "Relatório de Prorrogações" ?>
  </center>
</div>


 <?php 
 	// AVISO DE DOCUMENTAÇÃO JÁ SOLICITADAS
	if(isset($aviso)){echo $aviso;} 
 ?>
 
    <div class="panel panel-primary hidden-print" >
      <div class="panel-heading">Arquivo digitalizado da prorrogação</div>
      <div class="panel-body">						  

                        
  
<form id="formulario" name="formulario" enctype="multipart/form-data" action="imagem_upload.php" method="post"><br>
          <div>Descrição da imagem<br> 
          <input name="descricao" id ="descricao" type="text" class="form-control input-sm" value="Atesto de prorrogação" readonly="true"  >
    </div> 
          <br>
          <input name="evento" type="hidden"  value="int" />  
          <input name="id" type="hidden"  value="<?php echo $id; ?>" />  
          <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />


              <div><input name="imagem" type="file" class="form-control-file" required /></div>
          	<br>
              <div>
              <input type="submit" value="Adicionar Imagem" class="btn btn-primary "  <?php if( ($_SESSION["perfil"] == "medico")  || (isset($status)) ){ echo 'disabled'; } ?>   /></div>


</form>
</div>	
</div>

<br />
<table border="1"  class="table table-bordered" >
    <tr style="font-size: 12px">
      <td colspan="12" align="center" class="info">Solicitações de prorrogação </td>
    </tr>
    <tr style="font-size: 10px">
   
        <td align="center">Id</td>
        <td align="center">Data<br /> 
        Sol.</td>
        <td align="center">Dias <br />
        Sol.</td>
		    <td align="center">Data<br /> 
	        Aut.</td>
        <td align="center">Dias Aut.</td>
        <td align="center">F.M.</td>
        <td align="center">F.R.</td>
        <td align="center">
            Medico solicitante        </td>  
        <td align="center">
            Motivo        </td>
        <td align="center">
            Arquivo        </td>
        <td align="center">

             Status        </td>
        <td align="center">
             Obs.        </td>
        <td align='center'>
      </td>
    </tr>    <?php

// NAVEGAÇÃO ENTRE AS PÁGINAS
// ==========================================
// define o número de itens por página
$itens_por_pagina = 25; 
// pega a página atual
 if(isset($_GET['pagina'])){
  $pagina = intval($_GET['pagina']);
 }elseif(isset($_GET['ultima_pagina'])){
  $pagina = intval($_GET['ultima_pagina']);
 }else{
  $pagina = 0;
 }
// ===========================================

   $a = "SELECT  prorrogacao.id as id_prorrogacao, prorrogacao.medico_solicitante, prorrogacao.motivo, prorrogacao.motivo_medico, prorrogacao.dias_solicitados, prorrogacao.dias_autorizados, prorrogacao.qtd_motora, prorrogacao.qtd_respiratoria,  data, prorrogacao.status,
imagem.id as id_imagem, imagem.nome, imagem
FROM prorrogacao
LEFT JOIN imagem on imagem.id_internamento = prorrogacao.id_internamento

WHERE prorrogacao.id_internamento=".$id."  
ORDER BY `id_prorrogacao`  DESC";

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
  

    while($aquivos = $stmt1->fetch(PDO::FETCH_ASSOC)){ 
         
          $id_imagem = $aquivos['id_imagem'];
    ?>
    
    <tr style="font-size: 10px; text-align: justify">    
        <td align="center">
         <?php echo  $aquivos['id_prorrogacao']; ?>    </td>
    <td align="center">
        <?php echo date("j/n/Y,  H:i:s",strtotime($aquivos['data'])); ?>    
    </td>
    <td align="center">
       <div align="center"><?php echo $aquivos['dias_solicitados']; ?>          </div>   
    </td>
    <td align="center">
        <?php 
      			if(!empty($aquivos['data_autorizacao'])){
      				echo date("j/n/Y,  H:i:s",strtotime($aquivos['data_autorizacao'])); 
			      }
		    ?>    
    </td>
    <td >
      <div align="center"><?php echo $aquivos['dias_autorizados']; ?>          </div>
    </td>
    <td >
	<div align="center"><?php if(isset($aquivos['qtd_motora'])){ echo  $aquivos['qtd_motora'];}else{ echo "0";} ?>  </div>
    </td>
    <td ><div align="center"><?php if(isset($aquivos['qtd_respiratoria'])){echo  $aquivos['qtd_respiratoria'];}else{ echo "0"; } ?>  </div>
	</td>
    <td >
        <?php echo $aquivos['medico_solicitante']; ?>    </td>
   
    <td >
        <?php echo $aquivos['motivo']; ?>    </td>
        <td align="center">
     <!-- Campo Imagem --> 
        <?php 

        echo '<a class="hidden-print" href="imagem_exibir.php?id='.$aquivos['id_imagem'].'"  target="_blank">Arquivo '.$aquivos["id_imagem"].'</a>'; 


        echo '<span class="visible-print">Imagem '.$aquivos["id_imagem"].'</span>';
        ?>    </td>
      <td align="center">
      <!-- Campo Autorização --> 
        <?php

            if( $aquivos['status'] == 1 ){ 
              echo "<strong> Em an&aacute;lise </strong>"; 
            }elseif (is_null($aquivos['status'])){
              echo "";
            }else {           
              echo "<strong style='color: #008000' > Autorizado </strong>";
            }

        ?>       
	</td>
        <td >
          <!-- Campo Obs --> 
            <?php echo $aquivos['motivo_medico']; ?>    
        </td>
        <td class="hidden-print" align="center">
    <?php

                   if( ($aquivos['status'] == 1)  && ($_SESSION["perfil"] <> "medico")){  
                    echo '<a   class="hidden-print" onclick="excluir('.$id.','.$aquivos['id_imagem'].','.$aquivos['id_prorrogacao'].' )"> 
                           <button type="button" class="btn btn-danger glyphicon glyphicon-remove"></button> </a>';
                   }

    ?>
    </td>
   <!--  <td class="hidden-print" align="center"> Imagem '.$aquivos['id_imagem'].'</tr> -->
</tr>
    <?php 
            $w = $aquivos['id_prorrogacao'];
              } ?>


</table>
     
      <span class="style2">*F.M.: Fisioterapia Motora<br />
                           &nbsp; F.R.: Fisioterapia Respitarória </span><br />
       <center>

        <button style="right: all;" class="btn btn-default glyphicon glyphicon-print hidden-print" onclick="javascript:print();"> Imprimir </button>
      </center> 
<br>
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
          echo '<span id="ticket"> <i> De '.$registro1.' para '.$registro2.' de '.$num_total.'</i> </span>'; 
        ?>

<!-- BARRA DE NAVEGAÇÃO DE REGISTROS -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-backward" href="painel.php?sadt=1&pagina=0" aria-label="Previous">

                </a>
              </li>
    <!-- NAVEGA ENTRE AS PÁGINAS NUMERADAS -->
              <?php 
                $pagina = 0;
                for ($i=1; $i < $num_paginas+1; $i++) {

                 echo '<li class="page-item"><a class="page-link" href="painel.php?sadt=1&pagina='.$pagina.'"><b>'. $i .'</b></a></li>';
                $pagina = $registro2;
                }
              ?>
    <!-- REMETE PARA O ULTIMO REGISTRO -->            
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-forward"  href="painel.php?sadt=1&ultima_pagina=<?php echo $ultima_pagina; ?>" aria-label="Next">          
                </a>
              </li> 
            </ul>
      </nav>

  <!-- // -->

