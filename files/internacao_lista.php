<?php 
  
  // retira os erros 
 // error_reporting(0);


 if(isset($_GET['mes'])){

  $mes = $_GET['mes'];
 

  }else{

  $mes = date("m");
  
  }
 
  If( $_SESSION["perfil"] == "usuario"){
   $query = mysqli_query($conn,"SELECT internamento.id as autorizacao, internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida , cid.cid ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid WHERE usuarios.login = '".$login."' and MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = '".date("Y")."' order by internamento.id") or die("erro ao carregar consulta");
  }else{

     $query = mysqli_query($conn,"SELECT internamento.id as autorizacao, internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida , cid.cid ,usuarios.nome as credenciado, cid.dias as dias, internamento.motivo as motivo FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid WHERE MONTH(internamento.dat_entrada) = ".$mes." and Year(internamento.dat_entrada) = ".date("Y")." order by internamento.id") or die("erro ao carregar consulta");

  }




?>
<!-- pegar mes de consulta -->
<script language="Javascript">
 document.getElementById("mes").onchange = function(){
      window.location.href = this.value;
    }
</script>

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

                               var motivo;

                                   motivo = prompt ("O paciente exedeu as diárias permitidas, favor informar o motivo:");

                               window.location.href = "saida_internacao.php?id="+id+"&motivo="+motivo;


                       }else{
                               window.location.href = "saida_internacao.php?id="+id;
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
          window.location.href = "deleta_internacao.php?id="+id;


     }
}
</script>
<div align="right"><span style="right:inherit">Mês
  <select name="m" id="m" onchange="javascript:location.href = this.value;">
    <option  value="" > ... </option>
    <option  value="internacao.php?mes=01"<?php  if($mes == '01'){ echo "selected"; } ?> >Janeiro </option>
    <option  value="internacao.php?mes=02"<?php  if($mes == '02'){ echo "selected"; } ?>>Fevereiro</option>
    <option  value="internacao.php?mes=03"<?php  if($mes == '03'){ echo "selected"; } ?>>Março</option>
    <option  value="internacao.php?mes=04"<?php  if($mes == '04'){ echo "selected"; } ?>>abril</option>
    <option  value="internacao.php?mes=05"<?php  if($mes == '05'){ echo "selected"; } ?>>Maio</option>
    <option  value="internacao.php?mes=06"<?php  if($mes == '06'){ echo "selected"; } ?>>Junho</option>
    <option  value="internacao.php?mes=07"<?php  if($mes == '07'){ echo "selected"; } ?>>Julho</option>
    <option  value="internacao.php?mes=08"<?php  if($mes == '08'){ echo "selected"; } ?>>Agosto</option>
    <option  value="internacao.php?mes=09"<?php  if($mes == '09'){ echo "selected"; } ?>>Setembro</option>
    <option  value="internacao.php?mes=10"<?php  if($mes == '10'){ echo "selected"; } ?>>Outubro</option>
    <option  value="internacao.php?mes=11"<?php  if($mes == '11'){ echo "selected"; } ?>>Novembro</option>
    <option  value="internacao.php?mes=12"<?php  if($mes == '12'){ echo "selected"; } ?>>dezembro</option>
  </select>
</span></div>
                    
   <table class="table table-striped" align="center" style="font-size: 9px">
               <tr>
                 <td colspan="12" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td style='padding: 4px;'><div align="center" style='width: 30px;'>Autorização</div></td>
                 <td style='padding: 4px;'><div align="center" style='width: 150px;'>Paciente</div></td>
                 <td style='padding: 4px;'><div align="center">Matricula</div></td>
                 <td style='padding: 4px;'><div align="center">Solicitante</div></td>
                  <td style='padding: 4px;'><div align="center">CRM</div></td>
                  <td style='padding: 4px;'><div align="center">Entrada</div></td>
                  <td style='padding: 4px;'><div align="center">diárias</div></td>
                  <td style='padding: 4px;'><div align="center">Saída</div></td>
                  <td style='padding: 4px;'><div align="center">CID</div></td>
                 <?php If( $_SESSION["perfil"] == "administrador" or $_SESSION["perfil"] == "auditor"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?>
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
                                    <td style='padding: 4px;'><div align='center' style='width: 30px;'> <a href = 'rel_internacao.php?id_internacao=".$registro["autorizacao"]." '>  ".$registro["autorizacao"]."</a></div></td>
                                    <td style='padding: 4px;'><div align='center' style='width: 150px;'>".$registro["paciente"]."</div></td>
                                    <td style='padding: 4px;'><div align='center' >".$registro["matricula"]."</div></td>
                                    <td style='padding: 4px;'><div align='center'>".$registro["solicitante"]."</div></td>
                                     <td style='padding: 4px;'><div align='center'>".$registro["crm"]."</div></td>
                                     <td style='padding: 4px;'><div align='center'>".date("j/n/Y H:i:s",strtotime($registro["dat_entrada"]))."</div></td>
                                     <td style='padding: 4px;'><div align='center'>".$registro["dias"]."</div></td>
                                     <td style='padding: 4px;'>
                                      <div align='center'>";

 
                                        $dat_previsao[$i] = strtotime(date("Y-n-j", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+".$registro["dias"]." days")));

                                        $dat_atual[$i] = strtotime(date("Y-n-j"));


                                       if($dat_atual[$i] <= $dat_previsao[$i]){

                                             $data[$i] = 1;
                                             
                                       }

                                     if ($registro["dat_saida"] == 0){
                                     
                                          echo   "";
                                          $dat_saida[$i]  = 0;

                                    }elseif (!empty($registro["motivo"])) {


                                           echo   "<font color=\"#FF4000\"><strong><a style=\"color: #F00\"  href=\"javascript:func()\" onmouseover=\"Tip('";

                                           echo $registro["motivo"];


                                           echo "')\" onmouseout=\"UnTip()\">".date("d/m/Y H:i:s",strtotime($registro["dat_saida"]))."</a></strong></font>";
                                           $dat_saida[$i]  = true;

                                    }else{

                                           echo   "<font color='#04B45F'><strong>".date("d/m/Y H:i:s",strtotime($registro["dat_saida"]))." </strong></font>";
                                           $dat_saida[$i]  = true;

                                            
                                           
                                    }

                        echo "        </div>
                                    </td>
                                    <td style='padding: 4px;'><div align='center'>".$registro["cid"]."</div></td>";

                                      If( ($_SESSION["perfil"] == "administrador") or ($_SESSION["perfil"] == "auditor")){
                                         echo " <td><div align='center'>".$registro["credenciado"]."</div></td>";
                                      }

                        echo "
                                    <td>
                                        <div align='center'>

                                            <!-- Botão sair -->
                                            <a class='btn btn-primary' style='width: 50px; height: 25px' href='javascript:func()' onclick='saida(".$registro['autorizacao'].",".$dat_saida[$i].",".$data[$i].")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>
                                            <!--/Botão sair -->

                                        </div>
                                    </td>
                                    <td>
                                        <div align='center'>";
                    If( $_SESSION["perfil"] == "administrador"){
                         echo  " <!-- Botão exluir -->
                                            <a class='btn btn-danger' style='width: 50px; height: 25px' href='javascript:func()' onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
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
					
	