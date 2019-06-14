<?php 
  
  // retira os erros 
 // error_reporting(0);

        # Corrige o erro de acentuação no banco
        # mysqli_query($conn,"SET NAMES 'utf8'");

 if(isset($_GET['mes'])){

  $mes = $_GET['mes'];
 

  }else{

  $mes = date("m");
  
  }

  // Definição de perfil de usuário Administrador ou usuário comum.
 $a = "SELECT internamento.id as autorizacao,internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida, internamento.id_beneficiarios as id_beneficiarios, internamento.motivo as motivo, internamento.id_prorrogacao as id_prorrogacao, internamento.prorrogacao as prorrogacao, cid.cid , cid.dias as dias, usuarios.nome as credenciado, pronto_atendimento.id as id_pa, pronto_atendimento.dat_entrada as data_pa, prorrogacao.id as id_prorrogacao, prorrogacao.dias as dias_prorrogacao ,prorrogacao.status as status FROM `internamento` LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid left JOIN prorrogacao on prorrogacao.id = internamento.id_prorrogacao";


 
  If( $_SESSION["perfil"] == "usuario"){

    if(isset($_GET['buscar'])){

       $b = " WHERE usuarios.login = '".$login."' and (internamento.nome like '%".$_GET['buscar']."%' or internamento.id = '".$_GET['buscar']."' or internamento.matricula = '".$_GET['buscar']."')order by internamento.id";
    }else{

       $b = " WHERE usuarios.login = '".$login."' and MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = '".date("Y")."' order by internamento.id";
    }

  }else{


        if(isset($_GET['buscar'])){

          $b = " WHERE (internamento.nome like '%".$_GET['buscar']."%' or internamento.id = '".$_GET['buscar']."' or internamento.matricula = '".$_GET['buscar']."' or usuarios.nome like '%".$_GET['buscar']."%') order by internamento.id";

         
        }else{

          $b= " WHERE MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = ".date("Y")." order by internamento.id";

        }

  }



    $query = mysqli_query($conn,$a.$b) or die("erro ao carregar consulta");

?>


<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

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


<!-- Perguntar antes de prorrogar -->
<script language="Javascript">
function prorrogar(id,valor) {

     var resposta = confirm("Deseja realmente prorrogar?");
     
     if (resposta == true) {
      
          window.location.href = "painel.php?id="+id+"&prorro=1&valor="+valor;

     }
}
</script>

		
<?php 

  require_once("pesquisar.php");

?>


<!-- pegar mes de consulta  -->
<script language="Javascript">
    function mudarmes(){
      var x = document.getElementById("mes").value;
      window.location.href = x;
    }
</script>
                    
   <table width="834" align="center" class="table table-striped" style="font-size: 9px">
               <tr>
                 <td colspan="13" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td style='padding: 4px;'><div align="left">Autorização</div></td>
                 <td style='padding: 4px;'><div align="center">Paciente</div></td>
                 <td style='padding: 4px;'><div align="center">Matricula</div></td>
                 <td style='padding: 4px;'><div align="center">Solicitante</div></td>
                  <td style='padding: 4px;'><div align="center">CRM</div></td>
                  <td style='padding: 4px;'><div align="center">Entrada</div></td>
                  <td style='padding: 4px;'><div align="center">diárias</div></td>
                  <td style='padding: 4px;'><div align="center">Previsão</div></td>
                  <td style='padding: 4px;'><div align="center">Saída</div></td> 
                 <?php If( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?>            
				 <td style='padding: 4px;'><div align="center"> Entrada P.A </div></td>
                
                    
               </tr>
                          
              <?php

                error_reporting(E_ALL ^ E_NOTICE);

                  $i = 0;
                 
                  while($registro = mysqli_fetch_assoc($query)){
                         
                      

                         echo " <tr>   
                                  <!--  <td><div align='center'>";

                                     if ($registro["dat_saida"] != 0){

                                    echo "<span class='glyphicon glyphicon-ok'> </span> ";

                                    }

                         echo  "</div></td> -->
                                    <td style='padding: 4px;'>
                                      <div align='center' style='width: 30px;'> 

                                        <a href = 'internacao_relatorio.php?id_internacao=".$registro["autorizacao"]."&id_pa=".$registro["id_pa"]."&prorro=".$registro["prorrogacao"]."'>  ".$registro["autorizacao"]."</a>


                                      </div>
                                    </td>


                                    <td style='padding: 4px;'><div align='center' style='width: 150px;'>".$registro["paciente"]."</div></td>
                                    <td ><div align='center' >".$registro["matricula"]."</div></td>
                                    <td ><div align='center'>".$registro["solicitante"]."</div></td>
                                     <td ><div align='center'>".$registro["crm"]."</div></td>
                                     <td ><div align='center'><font color='blue'><strong>".date("j/n/Y <\b\\r> H:i:s",strtotime($registro["dat_entrada"]))."</strong></font></div></td>";
                                     



              // Previsão de saída

                        $dias = $registro["dias"];
                            

                        if($registro["status"] == 1){

                          $dias = $registro["dias"]+$registro["dias_prorrogacao"];

                          $dat_previsao[$i] = strtotime(date("Y-n-j", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+".$dias." days"))); 

                        }else{

                          $dat_previsao[$i] = strtotime(date("Y-n-j", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+".$dias." days")));
                        }

                                        $dat_atual[$i] = strtotime(date("Y-n-j"));

               // Dias
               

                          echo "<td ><div align='center'>".$dias."</div></td>";         


              // Prorrogação

              // Mendagem da prorrogação
                          switch ($registro["status"]) {
                            case '1':
                              $mensagem = "Aguardando aprovação";
                              break;
                            
                            case '2':
                              $mensagem = "Data prorrogada";
                              break;
                            case '3':
                               $mensagem = "Prorrogação negada";
                              break;
                          } 


                       if($dat_atual[$i] < $dat_previsao[$i]){

                               $data[$i] = 1;


                                  echo " <td ><div align='center'>"; 

                                  if(!empty($registro["status"])){     

                                            echo "<font color=\"#FFA500\"><strong><a href=\"javascript:func()\" onmouseover=\"Tip(' ".$mensagem." ')\" onmouseout=\"UnTip()\">";

                                                  echo date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));
                                            
                                            echo "</a></strong></font>";       
                                  }else{

                                                  echo date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));
                                  }
                                  
                                  echo "</div></td>";               
                              

                        }elseif($dat_atual[$i] = $dat_previsao[$i]) {

                              $data[$i] = 1;
                              
                                  echo " <td style='color: #FF4000; font-weight: bold;'><div align='center'>";

                                  if(!empty($registro["status"])){     

                                      echo "<font color=\"#FFA500\"><strong><a href=\"javascript:func()\" onmouseover=\"Tip('  ".$mensagem."  ')\" onmouseout=\"UnTip()\">";
                           
                                                echo  date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));

                                       echo "</a></strong></font>";       
                                  }else{

                                                echo  date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));
                                  }
      
                           
                                  echo "</div></td>";    
                        

                        }else{

                             if(!empty($registro["status"])){     

                                  echo " <td ><div align='center'>";

                                        echo "<font color=\"#FFA500\"><strong><a href=\"javascript:func()\" onmouseover=\"Tip('  ".$mensagem."  ')\" onmouseout=\"UnTip()\">";
                                                  echo  date("d/m/Y <\b\\r> H:i:s", strtotime(date("Y-n-j H:i:s",strtotime($registro["dat_entrada"]))."+".$dias." days"));
                                        echo "</a></strong></font>";       
                            }
                                  echo "</div></td>"; 
                                
                        }

/*
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


                                           echo   "<font color=\"#FF4000\"><strong><a style=\"color: #F00\"  href=\"javascript:func()\" onmouseover=\"Tip('";

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

                                      If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
                                         echo " <td><div align='center'>".$registro["credenciado"]."</div></td>";
                                      }

                    if($registro["data_pa"] <> ""){

          						 echo " <td><div align='center'><font color='#FF00FF'><strong>";

                       echo date("d/m/Y <\b\\r> H:i:s",strtotime($registro["data_pa"]));
                       
                       echo "</strong></font></div></td>";

                    }else{
                       echo " <td><div align='center'><font color='#FF00FF'><strong>";

                       echo '';
                       
                       echo "</strong></font></div></td>";




                     }


                        echo "  <td style='width: 200px;'>";

                  //Botão Saída   
                        echo " 
                                    <!-- Botão sair -->
                                            <a class='btn btn-primary' style='width: 50px; height: 25px' onclick='saida(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>
                                      ";

                  //  Botão Ecluir                  
                    
                    If( $_SESSION["perfil"] == "administrador"){
                         echo  " <!-- Botão exluir -->
                                            <a class='btn btn-danger' style='width: 50px; height: 25px' onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                 ";
                            
                          } 



            If( $dat_atual[$i] >= $dat_previsao[$i] ){

              // Botão prorrogação Credendiados 
                  // Solicita a prorrogação do internamento. Não é visível a médicos.
                   if( $_SESSION["perfil"] != "medico") {  

                           if(empty($registro["status"])){
                                    echo  " <!-- Botão prorrogação -->
                                                      <a class='btn btn-danger' style=' height: 25px' onclick='prorrogar(".$registro["autorizacao"].",0)'><span style='font-size: 10px; align: center;'> Prorrogar </span> </a>
                                           ";
                            }
                    }                 
               }



              // Botão prorrogação Médicos 
              // Efetiva a prorrogação da internação do paciente. visível apenas para Administradores e médicos  

                    if( ($_SESSION["perfil"] == "medico") || ($_SESSION["perfil"] == "administrador")){ 


                       if($registro["status"] == 1){
                                   echo  " <!-- Botão prorrogação -->
                                                      <a class='btn btn-success' style=' height: 25px' onclick='prorrogar(".$registro["autorizacao"].",1)'><span style='font-size: 10px; align: center;'> Prorrogar </span> </a>
                          ";
                       }
                     }



                  // -- / --              
                               


      
                                 $i++;

                          echo " </td></tr>";

                     }
                  

                   
              ?>              
            
</table>
			       <span style="background-color: red"></span>
					
	