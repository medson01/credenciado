
<!-- RECARRREGAR A PÁGINA A CASA 3 MINUTOS-->
<script language="Javascript">
setTimeout(function() {
 window.location.reload(1);
}, 180000); // 3 minutos
</script>



<?php 

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

// CONSULTA PADRÃO
  $a= "SELECT DISTINCT sadt.status, sadt.id, sadt.data_sadt,sadt.n_autorizacao,
            
            beneficiarios.nome, beneficiarios.matricula, beneficiarios.tipreg,  
            credenciado.codigo AS cod_cred, credenciado.nome AS nome_cred 
           
            FROM `sadt`
            INNER JOIN beneficiarios on beneficiarios.id = sadt.id_beneficiario 
            INNER JOIN credenciado on credenciado.id = sadt.id_credenciado            
            LEFT JOIN internamento on internamento.id = sadt.id_internamento
          ";


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
// PERFIL USUÁRIO OU ADMIN/AUDITOR
		 if( ($_SESSION["perfil"] <> "auditor") || ($_SESSION["perfil"] <> "admin")   ){
			$b = " WHERE credenciado.id = '".$_SESSION["id_credenciado"]."' and (credenciado.nome like '%".$_GET['buscar']."%' or beneficiarios.nome like '%".$_GET['buscar']."%' or sadt.id = '".$_GET['buscar']."' or (beneficiarios.matricula = '".$matric."'and beneficiarios.tipreg = '".$tipreg."')) order by sadt.id";
		}else{
			$b = " WHERE credenciado.nome like '%".$_GET['buscar']."%' or beneficiarios.nome like '%".$_GET['buscar']."%' or sadt.id = '".$_GET['buscar']."' or (beneficiarios.matricula = '".$matric."'and beneficiarios.tipreg = '".$tipreg."') order by sadt.id";
		}
		
		  $a = $a.$b;
  }

  // PEQUISA MES
  if (isset($_GET['mes'])) {
    $mes = substr($_GET['mes'], 0, -4);
    $ano = substr($_GET['mes'], 2);

     $b = " WHERE credenciado.id = '".$_SESSION["id_credenciado"]."' and MONTH(sadt.data_proc) = ".$mes." and Year(sadt.data_proc) = '".$ano."' order by sadt.id";
     $a = $a.$b;
  }

  if($_SESSION["perfil"] == "laboratorio"){
  	$d =  " WHERE credenciado.id = '".$_SESSION["id_credenciado"]."'   LIMIT $pagina, $itens_por_pagina";
  }else{
  	$d =  " LIMIT $pagina, $itens_por_pagina";
  }

  if(isset($_GET['prorro'])){ 
    $int = " WHERE id_internamento = ".$_GET['id'];
    $a = $a.$int;
  }



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
                <td style='padding: 4px;'><div align="center">Nome Usuário</div></td>
                <td style='padding: 4px;'><div align="center">matrícula</div></td>
                <td style='padding: 4px;'><div align="center">Credenciado </div></td>
                <td style='padding: 4px;'><div align="center">Cod. RDA </div></td>
                <td style='padding: 4px;'><div align="center">Data da Guia</div></td>
                <td style='padding: 4px;'><div align="center">Retorno</div></td>
              </tr>
            </thead>
            <tbody>
              <?php  while($registro = $stmt1->fetch(PDO::FETCH_ASSOC)){    ?>
              <tr>
                <td><div align='center'><?php echo "<a  id='ticket' href = 'painel.php?lab=1&id=".$registro["id"]."'>  ".$registro["id"]."</a>";  ?> </div></td>           
                <td><?php echo "<a  href = 'painel.php?lab=1&id=".$registro["id"]."'>".$registro["nome"]."</a>"; ?> </td>  
                <td><?php echo "0001.0001.".$registro["matricula"]." - ".$registro["tipreg"]; ?></td>            
                <td><?php echo $registro["nome_cred"]; ?></td>
                <td><?php echo $registro["cod_cred"]; ?></td>
                <td><div align=' right'><?php echo date("j/n/Y <\b\\r> H:i:s",strtotime($registro["data_sadt"])); ?></div></td>
                <td><div align='center'>
				<?php 
				
					if ($registro["status"] == 3 && $registro["n_autorizacao"] <> 0) { 
						echo   "<font color=\"#FF4000\"><strong><a href = 'painel.php?lab=1&id=".$registro["id"]."' style=\"color: #F00;\"  href=\"javascript:func()\" onmouseover=\"Tip('";
                        echo "Clique para verificar os procedimentos autorizados!";
                        echo "')\" onmouseout=\"UnTip()\">";				   
						echo '<span class="glyphicon glyphicon-flag btn-lg" style="color:green"></span></a></strong></font>'; 
					}elseif(isset($registro["n_autorizacao"]) && $registro["n_autorizacao"] == 0){
					    echo   "<font color=\"#FF4000\"><strong><a href = 'painel.php?lab=1&id=".$registro["id"]."' style=\"color: #F00;\"  href=\"javascript:func()\" onmouseover=\"Tip('";
                        echo "Guia não autorizada!";
                        echo "')\" onmouseout=\"UnTip()\">";				   
						echo '<span class="glyphicon glyphicon-remove-sign btn-lg" style="color:green"></span></a></strong></font>'; 
					}else{ 
						echo '<span>&nbsp;&nbsp;</span>'; 
					}
				
				?></div> 
				</td>


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


  <span style="background-color: red; "></span>

