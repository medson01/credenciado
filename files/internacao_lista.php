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
 $a = "SELECT internamento.id as autorizacao, internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida , cid.cid ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo, internamento.prorrogacao as prorrogacao, pronto_atendimento.id as id_pa ,pronto_atendimento.dat_entrada as data_pa FROM `internamento` LEFT JOIN pronto_atendimento on pronto_atendimento.id = internamento.id_pa INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid";


 
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
                 <td colspan="14" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados </strong></td>
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
                  <td style='padding: 4px;'><div align="center">Saída</div></td>
                  <td style='padding: 4px;'><div align="center">CID</div></td>
                 <?php If( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?>            
				 <td style='padding: 4px;'><div align="center"> Entrada P.A </div></td>
                 <td><div align="center"></div></td>
                    <td><div align="center"></div></td>
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

                         echo          "</div></td> -->
                                    <td style='padding: 4px;'><div align='center' style='width: 30px;'> <a href = 'internacao_relatorio.php?id_internacao=".$registro["autorizacao"]."&id_pa=".$registro["id_pa"]." '>  ".$registro["autorizacao"]."</a></div></td>
                                    <td style='padding: 4px;'><div align='center' style='width: 150px;'>".$registro["paciente"]."</div></td>
                                    <td ><div align='center' >".$registro["matricula"]."</div></td>
                                    <td ><div align='center'>".$registro["solicitante"]."</div></td>
                                     <td ><div align='center'>".$registro["crm"]."</div></td>
                                     <td ><div align='center'><font color='blue'><strong>".date("j/n/Y <\b\\r> H:i:s",strtotime($registro["dat_entrada"]))."</strong></font></div></td>
                                     <td ><div align='center'>".$registro["dias"]."</div></td>
                                     <td >
                                      <div align='center'>";

 
                                        $dat_previsao[$i] = strtotime(date("Y-n-j", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+".$registro["dias"]." days")));

                                        $dat_atual[$i] = strtotime(date("Y-n-j"));


                                       if($dat_atual[$i] <= $dat_previsao[$i]){

                                             $data[$i] = 1;
                                             
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

                        echo "        </div>
                                    </td>
                                    <td ><div align='center'>".$registro["cid"]."</div></td>";

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


                        echo "  <td></td><td>
                                    <!-- Botão sair -->
                                            <a class='btn btn-primary' style='width: 50px; height: 25px' onclick='saida(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>
                                      ";
									  
                    If( $_SESSION["perfil"] == "administrador"){
                         echo  " <!-- Botão exluir -->
                                            <a class='btn btn-danger' style='width: 50px; height: 25px' onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                 </td>
                            </tr>";
                          }       
                                 $i++;
                     }
                  

                   
              ?>              
            
</table>
			       <span style="background-color: red"></span>
					
	