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

 if(isset($_GET['mes'])){

    $mes = substr($_GET['mes'], 0, -4 );

    $ano = substr($_GET['mes'], -4 );
 

  }else{

  $mes = date("m");
  
  }

  // Definição de perfil de usuário Administrador ou usuário comum.
  $a = "SELECT internamento.prorrogacao, internamento.id as autorizacao,internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, internamento.id_beneficiarios as id_beneficiarios, internamento.motivo as motivo, internamento.id_prorrogacao as id_prorrogacao, internamento.prorrogacao as prorrogacao, internamento.dias as dias_internamento, cid.cid , cid.dias as dias, credenciado.nome as credenciado, pronto_atendimento.id as id_pa, internamento.internacao_numero_totvs, internamento.internacao_senha_totvs,
pronto_atendimento.dat_entrada as data_pa, beneficiarios.data_nascimento as data_nascimento, acomodacao.nome as acomodacao FROM `internamento` LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid  INNER JOIN alocacao on alocacao.id = internamento.id_alocacao INNER JOIN acomodacao on acomodacao.id = alocacao.id_acomodacao  INNER JOIN beneficiarios on beneficiarios.id = internamento.id_beneficiarios INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado";

/* ( SELECT
prorrogacao.status as status from prorrogacao
ORDER by prorrogacao.id DESC
 LIMIT 1
) as status,

 INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id
*/

 
  If( $_SESSION["perfil"] == "usuario"){

    if(isset($_GET['buscar'])){

       $b = " WHERE usuarios.id_credenciado = '".$_SESSION["id_credenciado"]."' and (internamento.nome like '%".$_GET['buscar']."%' or internamento.id = '".$_GET['buscar']."' or internamento.matricula = '".$_GET['buscar']."')order by internamento.id";
    }elseif(isset($_GET['mes'])){

        $b = " WHERE usuarios.id_credenciado = '".$_SESSION["id_credenciado"]."' and MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = '".$ano."' order by internamento.id";
    }else{


      // Consulta de entrada Dedault para usuário 
       $b = "  WHERE usuarios.id_credenciado = '".$_SESSION["id_credenciado"]."' and (internamento.dat_saida is null OR internamento.dat_saida = '0000-00-00 00:00:00')  order by internamento.id";
    }

    $a = $a.$b;

  }elseif( $_SESSION["perfil"] == "aut_internacao") {

        if(isset($_GET['buscar'])){

          $b = " WHERE  (internamento.nome like '%".$_GET['buscar']."%' or credenciado.nome like '%".$_GET['buscar']."%' or internamento.id = '".$_GET['buscar']."' or internamento.matricula = '".$_GET['buscar']."' or usuarios.nome like '%".$_GET['buscar']."%') order by  credenciado.nome, internamento.id ";

         
        }elseif(isset($_GET['mes'])){

          $b= " WHERE MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = ".$ano." order by  credenciado.nome ,internamento.id ";

        }else{

           $b= " WHERE  (internamento.internacao_numero_totvs = '' or internamento.internacao_numero_totvs is null) AND (internamento.dat_saida is null OR internamento.dat_saida = '0000-00-00 00:00:00') order by credenciado.nome,internamento.id  ";
            
          }

      $a = $a.$b;

  }else{


        if(isset($_GET['buscar'])){

          $b = " WHERE (internamento.nome like '%".$_GET['buscar']."%' or credenciado.nome like '%".$_GET['buscar']."%' or internamento.id = '".$_GET['buscar']."' or internamento.matricula = '".$_GET['buscar']."' or usuarios.nome like '%".$_GET['buscar']."%') order by  credenciado.nome , internamento.id ";

         
        }elseif(isset($_GET['mes'])){

          $b= " WHERE MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = ".$ano." order by  credenciado.nome ,internamento.id ";

        }else{

           $b= " WHERE internamento.dat_saida is null OR internamento.dat_saida = '0000-00-00 00:00:00' order by  credenciado.nome, internamento.id ";

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




 function calc_idade($nascimento) {
            $nascimento = date("d/m/Y", strtotime($nascimento));
            $nascimento=date($nascimento);
            $nascimento=explode('/',$nascimento); //Cria um array com os campos da data de nascimento  
            $data=date('d/m/Y'); 
            $data=explode('/',$data); //Cria um array com os campos da data atual 
            $anos=$data[2]-$nascimento[2]; //ano atual - ano de nascimento 
            if($nascimento[1] > $data[1]){
               return $anos-1;
            } //Se o mês de nascimento for maior que o mês atual, diminui um ano 
            if($nascimento[1] == $data[1]){ 
            //se o mês de nascimento for igual ao mês atual, precisamos ver os dias 
                  if($nascimento[0] <= $data[0]) {
                      return $anos; 
                  }else{
                      return $anos-1; 
                  }
            }
              
          return $anos; 
        
}


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
                    
   <style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
   </style>
   <table width="834" align="center" class="table table-striped" style="font-size: 9px">
               <tr>
                 <td colspan="14" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 
                 <td style='padding: 4px;'><div align='center' style='width: 30px;'>ID</div></td>
                 <td style='padding: 4px;'><div align="center">Paciente</div></td>
                 <td style='padding: 4px;'><div align="center">Matricula</div></td>
                 <td style='padding: 4px;'><div align="center">Acomodação</div></td>
                  <td style='padding: 4px;'><div align="center">Idade</div></td>
                  <td style='padding: 4px;'><div align="center">Entrada</div></td>
                <!-- <td style='padding: 4px;'><div align="center">Diárias</div></td> -->
                <!-- <td style='padding: 4px;'><div align="center">Previsão</div></td>  -->
                  <td style='padding: 4px;'><div align="center">Saída</div></td> 
                 <?php If( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor" or $_SESSION["perfil"] == "medico"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?>            
          				 <td style='padding: 4px;'><div align="center"> P.A </div></td>
                   <td style='padding: 4px;'><div align="center">Prorrogação</div></td>  
                 <td style='padding: 4px;'><div align='center' style='color:red'>Autorização Internação</div></td>   
                    
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

                                    
                        // ID de autorizaçãp
                         echo  "</div></td> -->
                                    <td style='padding: 4px;'>
                                      <div align='center' style='width: 30px;'> 
                                        
                                            <a  id='ticket' href = 'internacao_menu.php?id=".$registro["autorizacao"]."'>  ".$registro["autorizacao"]."</a>
                                       

                                      </div>
                                    </td>


                                    <td '><div id='paciente'>".$registro["paciente"]."</div></td>
                                    <td ><div align='center' >".$registro["matricula"]."</div></td>
                                    <td ><div align='center'>". utf8_encode($registro["acomodacao"])."</div></td>
                                     <td ><div align='center'>".calc_idade($registro["data_nascimento"])."</div></td>
                                     <td ><div align='center'><font color='blue'><strong>".date("j/n/Y <\b\\r> H:i:s",strtotime($registro["dat_entrada"]))."</strong></font></div></td>";
                                     


              // =========== Diárias =================
               /*                       
              // Previsão de saída

                        $dias = $registro["dias_internamento"];

              // Prorrogação

              // Mendagem da prorrogação
                          switch ($registro["prorrogacao"]) {
                            case '1':

                              $mensagem = "Aguardando aprovação";

                              echo "<td ><div align='center'>".$registro["dias"]."+".$registro["dias_prorrogacao"]."</div></td>";

                              $dias = $registro["dias"]+$registro["dias_prorrogacao"];

                              $dat_previsao[$i] = strtotime(date("Y-n-j", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+".$dias." days"))); 

                              break;
                            
                            case '2':
                            
                              $mensagem = "Ultima prorrogação: ".$registro["data_prorrogacao"];
                             
                              $dias = $registro["dias_internamento"];

                              echo "<td ><div align='center'>". $registro["dias_internamento"]."</div></td>"; 


                              break;

                            case '3':
                               $mensagem = "Prorrogação negada";
                              break;

                            


                            default:
                        
                                echo "<td ><div align='center'>".$dias."</div></td>"; 
  
                              break;  
                          } 

            */
          // =========== /Diárias =================

          //PREVISÂO 

                     /*
                               $dat_previsao[$i] = strtotime(date("Y-n-j", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+".$dias." days")));
                               $previsao[$i] = date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));

                              //DATA ATUAL
                               $dat_atual[$i] = strtotime(date("Y-n-j"));



                       if($dat_atual[$i] < $dat_previsao[$i]){

                               $data[$i] = 1;

                                  echo " <td ><div align='center'>"; 

                                  if(!empty($registro["prorrogacao"])){ 

                                          // $day = date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));

                                           if($dat_atual[$i] < $dat_previsao[$i]){   
                                                $cor = "style='color: #FF4000'";
                                            }

                                            echo "<font ><strong><a ".$cor." href=\"javascript:func()\" onmouseover=\"Tip(' ".$mensagem." ')\" onmouseout=\"UnTip()\"> ";

                                            echo $previsao[$i];      
                                            
                                            echo "</a></strong></font>";       


                                  }else{

                                                //  echo date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));
                                             echo $previsao[$i];   
                                  }


                                  echo "</div></td>";               
                              

                        }elseif($dat_atual[$i] = $dat_previsao[$i]) {

                              $data[$i] = 1;

                              $botão = 1;
                              
                              // Prorrogação / Starus / Mensagens
                                  echo " <td style='color: #FF4000; font-weight: bold;'><div align='center'>";

                                  if($registro["prorrogacao"] == 1){     

                                      echo "<strong><a style='color: #FF4000' href=\"javascript:func()\" onmouseover=\"Tip('  ".$mensagem."  ')\" onmouseout=\"UnTip()\">";
                           
                                                echo $previsao[$i]; 

                                       echo "</a></strong>";       
                                  }else{

                                                echo $previsao[$i];  
                                  }
      
                           
                                  echo "</div></td>";    
                        

                        }else{

                               $botão = 1;

                             

                                  echo " <td ><div align='center'>";

                                        echo "<strong><a href=\"javascript:func()\" onmouseover=\"Tip('  ".$mensagem."  ')\" onmouseout=\"UnTip()\">";
                                        
                                        echo $previsao[$i];  

                                        echo "</a></strong>";       
                            
                                  echo "</div></td>"; 
                                
                        }


                          if($registro["status"] == 1){     

                                  echo "<font color=\"#FFA500\"><strong><a href=\"javascript:func()\" onmouseover=\"Tip(' Data prorrogada ')\" onmouseout=\"UnTip()\">";

                                  echo "</a></strong></font>";       
                            }

*/

                          echo " <td >
                                      <div align='center'>";


                                     if ($registro["dat_saida"] == 0){
                                     
                                          echo   "";
                                          $dat_saida[$i]  = 0;

                                    }elseif (!empty($registro["prorrogacao"])) {


                                           echo   "<font color=\"#FF4000\"><strong><a style=\"color: #F00;\"  href=\"javascript:func()\" onmouseover=\"Tip('";

                                           echo "Motivo prorrogação:<br>".$registro["prorrogacao"];


                                           echo "')\" onmouseout=\"UnTip()\">".date("d/m/Y <\b\\r> H:i:s",strtotime($registro["dat_saida"]))."</a></strong></font>";
                                           $dat_saida[$i]  = true;

                                    }else{

                                           echo   "<font color='#04B45F'><strong>".date("d/m/Y <\b\\r> H:i:s",strtotime($registro["dat_saida"]))." </strong></font>";
                                           $dat_saida[$i]  = true;


                                    }




                      /*  echo "        </div>
                                    </td>
                                    <td ><div align='center'>".$registro["cid"]."</div></td>"; */

                                      If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor") or ($_SESSION["perfil"] == "medico")){
                                         echo " <td><div align='center'>".$registro["credenciado"]."</div></td>";
                                      }

                 // Campo PA - Pronto atendimento
                    if($registro["data_pa"] <> ""){

          						// echo " <td>  <!--    <div align='center'><font color='#FF00FF'><strong>";
                      // echo date("d/m/Y <\b\\r> H:i:s",strtotime($registro["data_pa"]));                      
                      // echo "</strong></font></div>   --> <span class='glyphicon glyphicon-flag' style='color:blue;font-size: 20px;' ></span>  </td>";
                      echo " <td> ";

                      echo "<font ><strong><a  style='font-family: Andale monospace;'  ".$cor." href=\"javascript:func()\" onmouseover=\"Tip(' Guia P.A. Nº:  ".$registro["id_pa"]." <br> Entrada: ".date('Y-n-j H:i:s',strtotime($registro['data_pa']))."')\" onmouseout=\"UnTip()\"> ";

                      echo "<span class='glyphicon glyphicon-flag' style='color: slategrey; font-size: 15px;' ></span>";    
                                            
                      echo "</a></strong></font> </td>";  



                    }else{
                       echo " <td><div align='center'><font color='#FF00FF'><strong>";

                       echo '';
                       
                       echo "</strong></font></div>  </td>";
                     }


                  // Campo Status - Prorrogação
                        echo "<td><div align='center' style='color: #FF4000; font-weight: bold;'> <font color='#FF4000'>";
                        
                          if($registro["prorrogacao"] == 1){ 
                            echo "<font ><strong><a  style='font-family: Andale monospace;'  ".$cor." href=\"javascript:func()\" onmouseover=\"Tip(' Prorrogação em análise ')\" onmouseout=\"UnTip()\"> ";

                            echo "<span class='glyphicon glyphicon-warning-sign' style='color: slategrey; font-size: 15px;' ></span>";
                          }

                        echo "</font> </td><td align='center'>";
                 
                  // Campo Autorização Internação        
                          if(!empty($registro["internacao_numero_totvs"])){ 
                            echo "<font ><strong><a  style='font-family: Andale monospace;'  ".$cor." href=\"javascript:func()\" onmouseover=\"Tip('Nº: ".$registro["internacao_numero_totvs"]." ')\" onmouseout=\"UnTip()\"> ";

                            echo "<span class='glyphicon glyphicon-ok' style='color: slategrey; font-size: 15px;' ></span>";
                          }
                            echo"</td>";
                            echo "  <td style='text-align:right;'>";


                  //Botão Acomodação   
                  /*    echo " 
                                    <!-- Botão sair -->
                                            <a class='btn btn-warning  btn-xs'  onclick='acomodacao(".$registro['autorizacao'].",".$dat_saida[$i].")'><span style='font-size: 10px; align: center;'> Acomodação </center> </span> </a>
                                      ";
                  */

                  //Botão Saída   

                       if (empty($registro["dat_saida"]) && $_SESSION["perfil"] <> "aut_internacao"){                
                        echo " 
                                    <!-- Botão sair 
                                            <a class='btn btn-primary  btn-xs'  onclick='saida(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>
                                    -->

                                    <a href='painel.php?int=1&guia=1&registro=".$registro['autorizacao']."&saida=".$dat_saida[$i]."&data=".$data[$i]."' name='bnt' id='bnt' class='btn btn-primary  btn-xs'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>

                                      ";
                       }

                  //  Botão Ecluir                  
                    
                    If( $_SESSION["perfil"] == "administrador"){
                         echo  " <!-- Botão exluir -->
                                            <a class='btn btn-danger  btn-xs'  onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                 ";
                            
                          } 



          // Botão prorrogação

                        
       
            If(($dat_atual[$i] >= $dat_previsao[$i])  && (empty($dat_saida[$i])) ){

              // Credendiados 
                  // Solicita a prorrogação do internamento. Não é visível a médicos.
                 
              /*
                  if( $_SESSION["perfil"] != "medico") {

                          

                          if ($registro["status"] == 1){

                                   echo  " <!-- Botão prorrogação -->
                                                      <a class='btn btn-danger  btn-xs' onclick='prorrogar(".$registro["autorizacao"].",3)'><span style='font-size: 10px; align: center;'> Prorrogar </span> </a>
                                           ";

				
                          }else{ 
     
                                    echo  " <!-- Botão prorrogação -->
                                                      <a class='btn btn-danger  btn-xs' onclick='prorrogar(".$registro["autorizacao"].",0)'><span style='font-size: 10px; align: center;'> Prorrogar </span> </a>
                                           ";
				
                          }    
                    }                 
                 */
              }
              

              // Médicos 
              // Efetiva a prorrogação da internação do paciente. visível apenas para Administradores e médicos  

              /*      if( ($_SESSION["perfil"] == "medico") || ($_SESSION["perfil"] == "administrador")){ 


                       if($registro["status"] == 1){
                                   echo  " <!-- Botão prorrogação -->
                                                      <a class='btn btn-success  btn-xs' onclick='prorrogar(".$registro["autorizacao"].",1)'><span style='font-size: 10px; align: center;'> Prorrogar </span> </a>
                          ";
                       }
                     }
              */
                 

                  // -- / --              
                               


      
                                 $i++;

                          echo " </td>
                          </tr>";

                     }
                  

                   
              ?>              
            
</table>
			       <span style="background-color: red; "></span>


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
                <a class="glyphicon glyphicon-fast-backward" href="painel.php?int=1&pagina=0" aria-label="Previous">               
                </a>
              </li>
    <!-- REMETE PARA O REGISTRO ANTERIOR -->            
              <li >
                <a class="glyphicon glyphicon-chevron-left"  href="painel.php?int=1&pagina=<?php echo $registro1-$itens_por_pagina-1; ?>">              
                </a>
              </li> 
    <!-- REMETE PARA O REGISTRO POSTERIOR-->            
              <li class="page-item">
                <a class="glyphicon glyphicon-chevron-right"  href="painel.php?int=1&pagina=<?php echo $registro2; ?>" aria-label="Next">
                            
                </a>
              </li> 
    <!-- REMETE PARA O ULTIMO REGISTRO -->            
              <li class="page-item">
                <a class="glyphicon glyphicon-fast-forward"  href="painel.php?int=1&pagina=<?php echo $ultima_pagina; ?>" aria-label="Next">
                           
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
    <tr class="table-danger"><td><span class="style1">Atenção:</span></td>
    </tr>
    <tr><td>
     <span id="ticket"> Os Atendimentos estão organizados por ordem decrente. A visualisação não apresenta os atendimentos fechados. Caso queira visualizá-los, vá em pesquisar por id, nome, matrícula e código do atendimento. Favor fechar os atendimentos já finalizados.</span></td>
    </tr>
</table>  