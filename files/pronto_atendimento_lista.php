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

return "$horas:$minutos:$segundos";
}




 if(isset($_GET['mes'])){

  $mes = $_GET['mes'];
 

  }else{

  $mes = date("m");
  
  }
 
  If( $_SESSION["perfil"] == "usuario"){
   $query = mysqli_query($conn,"SELECT pronto_atendimento.id as autorizacao, pronto_atendimento.matricula as matricula, pronto_atendimento.nome as paciente, pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida , pronto_atendimento.motivo as motivo, usuarios.nome as credenciado, pronto_atendimento.prorrogacao as prorrogacao FROM `pronto_atendimento` INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario WHERE usuarios.login = '".$login."' and MONTH(pronto_atendimento.dat_entrada) = ".$mes." and Year(pronto_atendimento.dat_entrada) = '".date("Y")."' order by pronto_atendimento.id") or die("erro ao carregar consulta");
  }else{

     $query = mysqli_query($conn,"SELECT pronto_atendimento.id as autorizacao, pronto_atendimento.matricula as matricula, pronto_atendimento.nome as paciente, pronto_atendimento.dat_entrada as dat_entrada, pronto_atendimento.dat_saida as dat_saida , pronto_atendimento.motivo as motivo, usuarios.nome as credenciado, pronto_atendimento.prorrogacao as prorrogacao FROM `pronto_atendimento` INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario WHERE MONTH(pronto_atendimento.dat_entrada) = ".$mes." and Year(pronto_atendimento.dat_entrada) = ".date("Y")." order by pronto_atendimento.id") or die("erro ao carregar consulta");

  }




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

                                   prorrogacao = prompt ("O paciente exedeu as 12 horas do pronto atendimento, favor informar o motivo:");

                               window.location.href = "pronto_atendimento_saida.php?id="+id+"&prorrogacao="+prorrogacao;


                       }else{
                               window.location.href = "pronto_atendimento_saida.php?id="+id;
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
          window.location.href = "pronto_atendimento_deleta.php?id="+id;


     }
}
</script>
<div align="right"><span style="right:inherit">Mês
  <select name="mes" id="mes" onchange="mudarmes()">
    <option  value="" > ... </option>
    <option  value="pronto_atendimento.php?mes=01"<?php  if($mes == '01'){ echo "selected"; } ?>>Janeiro </option>
    <option  value="pronto_atendimento.php?mes=02"<?php  if($mes == '02'){ echo "selected"; } ?>>Fevereiro</option>
    <option  value="pronto_atendimento.php?mes=03"<?php  if($mes == '03'){ echo "selected"; } ?>>Março</option>
    <option  value="pronto_atendimento.php?mes=04"<?php  if($mes == '04'){ echo "selected"; } ?>>abril</option>
    <option  value="pronto_atendimento.php?mes=05"<?php  if($mes == '05'){ echo "selected"; } ?>>Maio</option>
    <option  value="pronto_atendimento.php?mes=06"<?php  if($mes == '06'){ echo "selected"; } ?>>Junho</option>
    <option  value="pronto_atendimento.php?mes=07"<?php  if($mes == '07'){ echo "selected"; } ?>>Julho</option>
    <option  value="pronto_atendimento.php?mes=08"<?php  if($mes == '08'){ echo "selected"; } ?>>Agosto</option>
    <option  value="pronto_atendimento.php?mes=09"<?php  if($mes == '09'){ echo "selected"; } ?>>Setembro</option>
    <option  value="pronto_atendimento.php?mes=10"<?php  if($mes == '10'){ echo "selected"; } ?>>Outubro</option>
    <option  value="pronto_atendimento.php?mes=11"<?php  if($mes == '11'){ echo "selected"; } ?>>Novembro</option>
    <option  value="pronto_atendimento.php?mes=12"<?php  if($mes == '12'){ echo "selected"; } ?>>dezembro</option>
  </select>
</span></div>

<!-- pegar mes de consulta  -->
<script language="Javascript">
    function mudarmes(){
      var x = document.getElementById("mes").value;
      window.location.href = x;
    }
</script>
                    
   <table width="435" align="center" class="table table-striped" style="font-size: 9px">
               <tr>
                 <td colspan="10" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td width="61" ><div align="center" style='width: 30px;'>Autorização</div></td>
                 <td width="156"><div align="center" style='width: 150px;'>Paciente</div></td>
                 <td width="50" ><div align="center">Matricula</div></td>
                 <td width="39" ><div align="center">Entrada</div></td>
                 <td width="43" ><div align="center">Permanência</div></td>
                 <td width="29" ><div align="center">Saída</div></td>
                  
                 <?php If( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?>
                 <td width="16"><div align="center"></div></td>
                    <td width="5"><div align="center"></div></td>
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
                                     <td ><div align='center'>".date("j/n/Y <\b\\r> H:i:s",strtotime($registro["dat_entrada"]))."</div></td>
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

                        echo "
                                    <td>
                                        <div align='center'>

                                            <!-- Botão sair -->
                                            <a class='btn btn-primary' style='width: 50px; height: 25px' onclick='saida(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>
                                            <!--/Botão sair -->

                                        </div>
                                    </td>
                                    <td>
                                        <div align='center'>";
                    If( $_SESSION["perfil"] == "administrador"){
                         echo  " <!-- Botão exluir -->
                                            <a class='btn btn-danger' style='width: 50px; height: 25px' onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                <!--/Botão exluir -->

                                        </div>
                                    </td>
                                 </tr>";
                          }       
                                 $i++;
                     }
                  

                   
              ?>              
</table>
			       <span style="background-color: red"></span>
					
	