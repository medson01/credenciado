<?php 
function periodo ($valor){
	
	switch ($valor) {
		case 1:
			echo "dia(s)";
			break;
		case 2:
			echo "mês(es)";
			break;
		case 3:
			echo "ano(s)";
			break;
	}

}


// define o número de itens por página
$itens_por_pagina = 100;
 
// pega a página atual
 if(isset($_GET['pagina']) && $_GET['pagina'] > 0){
  $pagina = $_GET['pagina'];
 }else{
  $pagina = 0;
 }

// Sql limitado pela variável $itens_por_pagina
  $a= "SELECT * FROM `procedimento`";


// PESQUISA 
  if (isset($_GET['buscar'])) {

  // PESQUISA ID, NOME MATRICULA E CODIGO
  // TRATAMENTO DO MATRÍCULA
    $cont = strlen($_GET['buscar']);
    if( $cont == 16){
      $matric = substr($_GET['buscar'], 8, -2);
      $tipreg = substr($_GET['buscar'], 14);
    }else{
      $matric = 'null';
      $tipreg = 'null';
    }


    $b = " WHERE procedimento.codigo = '".$_GET['buscar']."' or procedimento.descricao like '%".$_GET['buscar']."%' order by procedimento.codigo";
    $a = $a.$b;

  }

  // PEQUISA MES
  if (isset($_GET['mes'])) {
    $mes = substr($_GET['mes'], 0, -4);
    $ano = substr($_GET['mes'], 2);

     $b = " WHERE credenciado.id = '".$_SESSION["id_credenciado"]."' and MONTH(sadt.data_proc) = ".$mes." and Year(sadt.data_proc) = '".$ano."' order by procedimento.codigo";
     $a = $a.$b;
  }


  $d =  "    LIMIT $pagina, $itens_por_pagina";

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
 


?>

<!-- Tickt ID e usuário -->
<link rel="stylesheet" type="text/css" href="../css/ticket.css">

<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

<!-- Botão Prorrogação --> 
<script type="text/javascript" src="../js/int_bnt_prorrogar.js"></script>

<!-- Botão acomodação --> 
<script type="text/javascript" src="../js/int_bnt_acomodacao.js"></script>

<!-- Botão Modal Sair -->
<?php
if(isset($guia)){
  echo"  <script type='text/javascript' src='../js/modal_sair.js'></script>";
}
?>

<!-- Perguntar antes de saida -->
<script language="Javascript">
function saida(id,dat_saida,data) {
   
   if (dat_saida != 1){

     var resposta = confirm("Deseja dar saída do paciente?");
 
               if (resposta == true) {

                       //Previsaão < que data atual
                       if(data != 1){

                               var prorrogacao;

                                   prorrogacao = prompt ("O paciente exedeu as diárias permitidas, favor informar o motivo:");

                               window.location.href = "internacao_saida.php?id="+id+"&prorrogacao="+prorrogacao;


                       }else{
                               window.location.href = "internacao_saida.php?id="+id;
                       }
                    
               }

   }else{
      alert("Paciente já saiu!");
   }
}
</script>

<!-- Perguntar antes de excluir -->
<script language="Javascript">
function excluir(id) {
     var resposta = confirm("Deseja remover esse registro?");
     
     if (resposta == true) {
          window.location.href = "internacao_deleta.php?id="+id;


     }
}
</script>




		
<?php 

  require_once("pesquisar.php");

?>


<!-- pegar mes de consulta  -->
<script language="Javascript">
    function mudarmes(){
      var y = document.getElementById("ano").value;
      var x = document.getElementById("mes").value;
      if((x && y)){
      window.location.href = x+y;
      }
    }
</script>


<!-- CABEÇALHO DA TABELA -->
        <?php if ($num > 0) { ?>
         <table width="834" align="center" class="table table-striped" style="font-size: 9px">
            <thead>
               <tr  style='font-weight:bold;'>
                <td style='padding: 4px;'><div align="center"> ID  </div></td>
                <td style='padding: 4px;'><div align="center">Cod.Proc.</div></td>
                <td style='padding: 4px;'><div align="center">Desc.Proc.</div></td>
                <td style='padding: 4px;'><div align="center">Carência</div></td>
				<td style='padding: 4px;'><div align="center">Und.</div></td>
                <td style='padding: 4px;'><div align="center">Quantidade</div></td>
				<td style='padding: 4px;'><div align="center">Und.</div></td>
                <td style='padding: 4px;'><div align="center">Periodicidade</div></td>
				<td style='padding: 4px;'><div align="center">Und.</div></td>
                <td style='padding: 4px;'><div align="center">Valor Tabela</div></td>
                <td style='padding: 4px;'><div align="center">Valor Cobrado</div></td>
                <td style='padding: 4px;'><div align="center">Ativo</div></td>
              </tr>
            </thead>
            <tbody>
              <?php  while($registro = $stmt1->fetch(PDO::FETCH_ASSOC)){    ?>
              <tr>
                <td><div align='center'><?php echo "<a  id='ticket' href = 'painel.php?proc=1&id=".$registro["id"]."'>  ".$registro["id"]."</a>";  ?> </div></td>
                
                <td><div align="center"><?php echo "<a  id='ticket' href = 'painel.php?proc=1&id=".$registro["id"]."'>  ".$registro["codigo"]."</a>"; ?></div></td>
                <td><?php echo "<a style='color: #243bcd;' id='ticket' href = 'painel.php?proc=1&id=".$registro["id"]."'>  ".$registro["descricao"]."</a>"; ?></td>
                <td><div align="center"><?php echo $registro["carencia"]; ?> </div></td>  
				<td><div align="center" style="color: #243bcd;
    font-weight: bold;"><?php periodo($registro["unid_carencia"]); ?> </div></td>
                <td><div align="center" ><?php echo $registro["quantidade"]; ?></div></td>
				<td><div align="center" style="color: #243bcd;
    font-weight: bold;"><?php echo  periodo($registro["unid_quantidade"]); ?> </div></td>
                <td><div align="center"><?php echo $registro["periodicidade"]; ?> </div></td>  
				<td><div align="center" style="color: #243bcd;
    font-weight: bold;"><?php echo  periodo($registro["unid_periodicidade"]); ?> </div></td>          
                <td><div align="center"><?php echo $registro["valor_tabela"]; ?> </div></td>  
                <td><div align="center"><?php echo $registro["valor_cobrado"]; ?> </div></td>  
                <td><div align="center"><?php if ($registro["bloqueio"] == 1) { echo '<span class="glyphicon glyphicon-remove"></span>';}else{ echo '<span class="glyphicon glyphicon-ok"></span>'; } ?> </div></td>


        <?php } ?>
              </tr>
            </tbody>
          </table>


          
        <?php } ?>


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
                <a class="glyphicon glyphicon-fast-backward" href="painel.php?proc=1&pagina=0" aria-label="Previous">               
                </a>
              </li>
    <!-- REMETE PARA O REGISTRO ANTERIOR -->            
              <li >
                <a class="glyphicon glyphicon-chevron-left"  href="painel.php?proc=1&pagina=<?php echo $registro1-$itens_por_pagina-1; ?>">              
                </a>
              </li> 
    <!-- REMETE PARA O REGISTRO POSTERIOR-->            
              <li class="page-item">
                <a class="glyphicon glyphicon-chevron-right"  href="painel.php?proc=1&pagina=<?php echo $registro2; ?>" aria-label="Next">
                            
                </a>
              </li> 
    <!-- REMETE PARA O ULTIMO REGISTRO -->            
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-forward"  href="painel.php?proc=1&pagina=<?php echo $ultima_pagina; ?>" aria-label="Next">
                           
                </a>
              </li> 

            </ul>
      </nav>

  <!-- // -->


  <span style="background-color: red; "></span>

