<?php 

// Define o número de itens por página
$itens_por_pagina = 20;
 
// pega a página atual
 if(isset($_GET['pagina']) && $_GET['pagina'] > 0){
  $pagina = $_GET['pagina'];
 }else{
  $pagina = 0;
 }

  
  // retira os erros 
 // error_reporting(0);

        # Corrige o erro de acentuação no banco
        # mysqli_query($conn,"SET NAMES 'utf8'");



# Função para calcuçar a diferença de horas
function calculaTempo($hora_inicial, $hora_final) {

$i = 1;
$tempo_total;

$tempos = array($hora_final, $hora_inicial);

foreach($tempos as $tempo) {


      
      $segundos = 0;

      list($ano, $mes, $dia) = explode('-', $tempo);


      list($h, $m, $s) = explode(':', $tempo);
      $segundos += $dia * 86400;
      $segundos += $h * 3600;
      $segundos += $m * 60;
      $segundos += $s;

      $tempo_total[$i] = $segundos;

      $i++;
}
      $segundos = $tempo_total[1] - $tempo_total[2];

      $horas = floor($segundos / 3600);
      $segundos -= $horas * 3600;
      $minutos = str_pad((floor($segundos / 60)), 2, '0', STR_PAD_LEFT);
      $segundos -= $minutos * 60;
      $segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);
      
      $horas = abs($horas);
      $minutos = abs($minutos);
      $segundos = abs($segundos);

return "$horas:$minutos:$segundos";
}





 if(isset($_GET['mes'])){

    $mes = substr($_GET['mes'], 0, -4 );

    $ano = substr($_GET['mes'], -4 );
 

  }else{

  $mes = date("m");
  
  }
 
 // Definição de perfil de usuário Administrador ou usuário comum.

 $a = "SELECT pronto_atendimento.id as autorizacao, pronto_atendimento.id_beneficiarios as id_beneficiarios , pronto_atendimento.matricula as matricula, pronto_atendimento.nome as paciente, pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida , pronto_atendimento.motivo as motivo, usuarios.nome as aten_entrada, (SELECT usuarios.nome FROM usuarios WHERE usuarios.id = pronto_atendimento.id_usuario_out) as aten_saida, pronto_atendimento.prorrogacao as prorrogacao, credenciado.nome AS credenciado FROM `pronto_atendimento` INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado";


  If( $_SESSION["perfil"] == "usuario"){


     if(isset($_GET['buscar'])){
       
          $b = " WHERE usuarios.id_credenciado = '".$_SESSION["id_credenciado"]."' and (pronto_atendimento.nome like '%".$_GET['buscar']."%' or pronto_atendimento.id = '".$_GET['buscar']."' or pronto_atendimento.matricula = '".$_GET['buscar']."')order by credenciado , pronto_atendimento.id";
      }elseif(isset($_GET['mes'])){

         $b = " WHERE usuarios.id_credenciado = '".$_SESSION["id_credenciado"]."' and MONTH(pronto_atendimento.dat_entrada) = ".$mes." and Year(pronto_atendimento.dat_entrada) = '".$ano."' order by credenciado , pronto_atendimento.id";

     }else{ 
  

          // Consulta de entrada Dedault para usuário 
          $b = " WHERE usuarios.id_credenciado = '".$_SESSION["id_credenciado"]."' and (pronto_atendimento.dat_saida IS null OR pronto_atendimento.dat_saida = '0000-00-00 00:00:00') order by credenciado , pronto_atendimento.id";
     
     }


        $a = $a.$b;
  
  }else{


    if(isset($_GET['buscar'])){


            $b = " WHERE (pronto_atendimento.nome like '%".$_GET['buscar']."%' or credenciado.nome like '%".$_GET['buscar']."%' or pronto_atendimento.id = '".$_GET['buscar']."' or pronto_atendimento.matricula = '".$_GET['buscar']."' or usuarios.nome like '%".$_GET['buscar']."%') order by credenciado , pronto_atendimento.id";
      
     }elseif(isset($_GET['mes'])){
     
            $b = " WHERE MONTH(pronto_atendimento.dat_entrada) = ".$mes." and Year(pronto_atendimento.dat_entrada) = '".$ano."' order by credenciado , pronto_atendimento.id";       
     }else{
          
            $b = " WHERE pronto_atendimento.dat_saida IS null OR pronto_atendimento.dat_saida = '0000-00-00 00:00:00' order by credenciado , pronto_atendimento.id";
  
     }

     $a = $a.$b;
  }



    $d =  "  DESC LIMIT $pagina, $itens_por_pagina ;";

  
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






  // $query = mysqli_query($conn,$a.$b) or die("erro ao carregar consulta");

?>

<!-- Tickt ID e usuário -->
<link rel="stylesheet" type="text/css" href="../css/ticket.css">

<script type="text/javaScript">
function autoRefresh(interval) {
	setTimeout(function(){  window.location.href = "painel.php?pa=1"; } ,interval);
}

</script>


<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

<!-- Botão Modal Sair -->
<?php
if(isset($guia)){
  echo"  <script type='text/javascript' src='../js/modal_sair.js'></script>";
}
?>
<!-- Botão Excluir -->
<script type="text/javascript" src="../js/bnt_excluir.js"></script>

<!-- Botão internação -->
<script type="text/javascript" src="../js/bnt_internacao.js"></script>

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
                    
   <table width="435" align="center" class="table table-striped" style="font-size: 9px" >
               <tr>
                 <td colspan="11" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes em atendimento </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td ><div align='center' style='width: 30px;'>ID</div></td>
                 <td ><div align="center" style='width: 150px;'>Paciente</div></td>
                 <td ><div align="center">Matricula</div></td>
				 <td ><div align='center'>Credenciado</div></td> 
                 <td ><div align='center'>Aten. In</div></td>  
                 <td ><div align="center">Entrada</div></td>                       
                  <?php 
                    if( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ 
                      echo '<td ><div align="center">Permanência</div></td>'; 
                      }
                  ?>
                 <td ><div align='center'>Aten. Out</div></td>  
                 <td ><div align="center">Saída</div></td>   
   
               </tr>
                          
              <?php

                error_reporting(E_ALL ^ E_NOTICE);

                  $i = 0;
                 
                  while($registro = $stmt1->fetch(PDO::FETCH_ASSOC)) {      
                      

                         echo " <tr>   
                                  <!--  <td><div align='center'>";

                                     if ($registro["dat_saida"] != 0){

                                    echo "<span class='glyphicon glyphicon-ok'> </span> ";

                                    }

                         echo          "</div></td> -->
                                    <td ><div id='ticket'> <a href = 'pronto_atendimento_relatorio.php?id_pronto_atendimento=".$registro["autorizacao"]." '>  ".$registro["autorizacao"]."</a></div></td>
                                    <td ><div id='paciente'>".$registro["paciente"]."</div></td>
                                    <td ><div align='center' >".$registro["matricula"]."</div></td>
									<td ><div align='center' >".$registro["credenciado"]."</div></td>
                                    <td ><div align='center'>".$registro["aten_entrada"]."</div> </td>";
                         echo "     <td ><div align='center'><font color='blue'><strong>".date("j/n/Y <\b\\r> H:i:s",strtotime($registro["dat_entrada"]))."</strong></font></div></td>
                                    <td ><div align='center'>".$registro["aten_saida"];


                                  # Configurar a pernamnencia do Pronto Atendimento 
                                  #    1  segundos => "1  second"     
                                  #    1 minutos   => "1  minute"                                      
                                  #    1  hora     => "1  hour"

                                      $v = "2";
                                      $t = "horas";
                      
                                  #################################################

                                      switch ($t) {
                                        case 'secondos':
                                          $time = "+". $v . " second";
                                          $tempo = $v . "seguntos";

                                          break;
                                        case 'minutos':
                                          $time = "+". $v . " minute";
                                          $tempo = $v . " minutos";

                                          break;
                                        case 'horas':
                                          $time = "+". $v . " hour";
                                          $tempo = $v . " horas";

                                          break;                                        
                                
                                      }

                                  #################################################

                                       $dat_previsao[$i] = strtotime(date("Y-n-j H:i:s", strtotime( $time ,strtotime($registro["dat_entrada"]))));

                                      // echo "previsão: ". date("Y-n-j H:i:s", strtotime( $time ,strtotime($registro["dat_entrada"]))); 

                                      // echo "<br>".$time."<br>";


                                       $dat_atual[$i] = strtotime(date("Y-n-j H:i:s"));

                                       // echo "atual: " . date("Y-n-j H:i:s");

                                       //  echo "<br>".$time."<br>";

                                if( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ 

                                      if(!empty($registro["dat_saida"])){

                                         $horaA = $registro["dat_entrada"];                              
                                         $horaB = $registro["dat_saida"];
      
                                          echo calculaTempo($horaA, $horaB);

                                     }else{
                                         $horaA = $registro["dat_entrada"];                              
                                         $horaB = date("Y-n-j H:i:s");
  
                                          echo calculaTempo($horaA, $horaB);

                                     }

                                 }

                        echo "       </div>
                                    </td>
                                     
                                    <td > <div align='center'>";
									
									 


                                       if($dat_atual[$i] > $dat_previsao[$i]){

                                             $data[$i] = 1;


									                     }else{

                                            $data[$i] = 0;


                                       }





                                     if ($registro["dat_saida"] == 0){
                                     
                                          echo   "";
                                          $dat_saida[$i]  = 0;

                                    }elseif (!empty($registro["prorrogacao"])) {


                                           echo   "<font color=\"#FF4000\"><strong><a style=\"color: #F00\"  href=\"javascript:func()\" onmouseover=\"Tip('";

                                           echo "Motivo prorrogação:<br>".$registro["prorrogacao"];


                                           echo "')\" onmouseout=\"UnTip()\">".date("d/m/Y <\b\\r> H:i:s",strtotime($registro["dat_saida"]))."</a></strong></font>";
                                           $dat_saida[$i]  = true;

                                    }else{

                                           echo   "<font color='#04B45F'><strong>".date("d/m/Y <\b\\r> H:i:s",strtotime($registro["dat_saida"]))." </strong></font>";
                                           $dat_saida[$i]  = true;

                                            
                                           
                                    }
									
					             	echo"			</div></td>";


                        
                        
                        
                                        


                            if(!isset($registro["dat_saida"])){    


                                      echo " <!-- Botão sair -->
                                            <td align='right'  >                           
                                                    <a href='painel.php?pa=1&guia=1&tempo=".$tempo."&registro=".$registro['autorizacao']."&saida=".$dat_saida[$i]."&data=".$data[$i]."' name='bnt' id='bnt' class='btn btn-primary  btn-xs'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>                                                   
                                            ";




                                     echo " <!-- Botão internaramento -->
                          
                                                    <a class='btn btn-success  btn-xs'  onclick='internar(\"".$tempo."\",".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].",\"".$registro['matricula']."\",\"".$registro['paciente']."\",".$registro['id_beneficiarios'].")'><span style='font-size: 10px; align: center'> Internar </center> </span> </a>              
                                            ";

                              


                                If( $_SESSION["perfil"] == "administrador"){

                                     echo  " <!-- Botão exluir -->
                                                        <a class='btn btn-danger btn-xs' onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                                </td>
                                             </tr>";
                                      } 


                                    }else{

                                      echo "<td></td>";

                                    }

                                     $i++;
                         }
                  

                   
              ?>              
</table>
			       <span style="background-color: red"></span>
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
          echo '<span id="ticket"> <i> De '.$registro1.' para '.$registro2.' de '.$num_total.'</i> '; 

           if( (!isset($_GET['buscar'])) && (!isset($_GET['mes']))){
            echo "atendimentos ativos.</span>";
           
          }
        ?>

<!-- BARRA DE NAVEGAÇÃO DE REGISTROS -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-backward" href="painel.php?pa=1&pagina=0" aria-label="Previous">               
                </a>
              </li>
    <!-- REMETE PARA O REGISTRO ANTERIOR -->            
              <li >
                <a class="glyphicon glyphicon-chevron-left"  href="painel.php?pa=1&pagina=<?php echo $registro1-$itens_por_pagina-1; ?>">              
                </a>
              </li> 
    <!-- REMETE PARA O REGISTRO POSTERIOR-->            
              <li class="page-item">
                <a class="glyphicon glyphicon-chevron-right"  href="painel.php?pa=1&pagina=<?php echo $registro2; ?>" aria-label="Next">
                            
                </a>
              </li> 
    <!-- REMETE PARA O ULTIMO REGISTRO -->            
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-forward"  href="painel.php?pa=1&pagina=<?php echo $ultima_pagina; ?>" aria-label="Next">
                           
                </a>
              </li> 

            </ul>
      </nav>



  <!-- // -->
  <?php

  //  Acesso Modal saida
   if(isset($_GET['guia'])){
      include("modal_saida.php");
  }
  ?>
	

<table class="table table-sm table-dark">
    <tr class="table-danger"><td>Atenção:</td></tr>
    <tr><td>
 <span id="ticket"> Os Atendimentos estão organizados por ordem decrente. A visualisação não apresenta os atendimentos fechados. Caso queira visualizá-los, vá em pesquisar por id, nome, matrícula e código do atendimento. Favor fechar os atendimentos já finalizados.</span></td>
</tr>


  </table>  