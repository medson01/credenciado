<?php 
  
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

  $mes = $_GET['mes'];
 

  }else{

  $mes = date("m");
  
  }
 
 // Definição de perfil de usuário Administrador ou usuário comum.

 $a = "SELECT pronto_atendimento.id as autorizacao, pronto_atendimento.matricula as matricula, pronto_atendimento.nome as paciente, pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida , pronto_atendimento.motivo as motivo, usuarios.nome as credenciado, pronto_atendimento.prorrogacao as prorrogacao FROM `pronto_atendimento` INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario";


  If( $_SESSION["perfil"] == "usuario"){


     if(isset($_GET['buscar'])){
       
          $b = " WHERE usuarios.login = '".$login."' and (pronto_atendimento.nome like '%".$_GET['buscar']."%' or pronto_atendimento.id = '".$_GET['buscar']."' or pronto_atendimento.matricula = '".$_GET['buscar']."')order by pronto_atendimento.id";

     }else{ 
  
          $b = " WHERE usuarios.login = '".$login."'and MONTH(pronto_atendimento.dat_entrada) = ".$mes." and Year(pronto_atendimento.dat_entrada) = '".date("Y")."' order by pronto_atendimento.id";
     }

  
  }else{


    if(isset($_GET['buscar'])){


            $b = " WHERE (pronto_atendimento.nome like '%".$_GET['buscar']."%' or pronto_atendimento.id = '".$_GET['buscar']."' or pronto_atendimento.matricula = '".$_GET['buscar']."' or usuarios.nome like '%".$_GET['buscar']."%') order by pronto_atendimento.id";
       
     }else{
          
            $b = " WHERE MONTH(pronto_atendimento.dat_entrada) = ".$mes." and Year(pronto_atendimento.dat_entrada) = '".date("Y")."' order by pronto_atendimento.id";
  
     }
  }


   $query = mysqli_query($conn,$a.$b) or die("erro ao carregar consulta");

?>


<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

<!-- Botão Sair -->
<script type="text/javascript" src="../js/bnt_sair.js"></script>

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
      var x = document.getElementById("mes").value;
      window.location.href = x;
    }
</script>
                    
   <table width="435" align="center" class="table table-striped" style="font-size: 9px">
               <tr>
                 <td colspan="12" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td ><div align="left" style='width: 30px;'>Autorização</div></td>
                 <td ><div align="center" style='width: 150px;'>Paciente</div></td>
                 <td ><div align="center">Matricula</div></td>
                 <td ><div align="center">Entrada</div></td>
                 <td ><div align="center">Permanência</div></td>
                 <td ><div align="center">Saída</div></td>
                  
                 <?php If( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?>
                 
                   
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
                                    <td ><div align='center' style='width: 30px;'> <a href = 'pronto_atendimento_relatorio.php?id_internacao=".$registro["autorizacao"]." '>  ".$registro["autorizacao"]."</a></div></td>
                                    <td ><div align='center' style='width: 150px;'>".$registro["paciente"]."</div></td>
                                    <td ><div align='center' >".$registro["matricula"]."</div></td>
                                     <td ><div align='center'><font color='blue'><strong>".date("j/n/Y <\b\\r> H:i:s",strtotime($registro["dat_entrada"]))."</strong></font></div></td>
                                     <td >
                                      <div align='center'>";

                                  # Configurar a permanência do paciênte no hospital "+12 minute".
                                      $dat_previsao[$i] = strtotime(date("Y-n-j H:i:s", strtotime("+12 minute",strtotime($registro["dat_entrada"]))));

                                      $dat_atual[$i] = strtotime(date("Y-n-j H:i:s"));


                                      if(!empty($registro["dat_saida"])){

                                        //echo $horaB = substr(date("Y-n-j H:i:s", strtotime("+30 minute",strtotime($registro["dat_entrada"]))),10);

                                         $horaA = $registro["dat_entrada"];                              
                                         $horaB = $registro["dat_saida"];
      
                                          echo calculaTempo($horaA, $horaB);

                                     }else{
                                         $horaA = $registro["dat_entrada"];                              
                                         $horaB = date("Y-n-j H:i:s");
  
                                          echo calculaTempo($horaA, $horaB);

                                     }



                        echo "       </div>
                                    </td>
                                    <td > <div align='center'>";
									
									 
                                       


                                       if($dat_atual[$i] <= $dat_previsao[$i]){

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

                        
                        If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
                                         echo " <td><div align='center'>".$registro["credenciado"]."</div></td>";
                                      }

                             echo " <!-- Botão sair -->
                                    <td align='right'  style='width: 220px'>                           
                                            <a class='btn btn-primary' style='width: 50px; height: 25px' onclick='saida(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>                                                   
                                    ";



                             echo " <!-- Botão internaramento -->
                  
                                            <a class='btn btn-success' style='width: 50px; height: 25px' onclick='internar(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].",\"".$registro['matricula']."\",\"".$registro['paciente']."\")'><span style='font-size: 10px; align: center'> Internar </center> </span> </a>              
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
					
	