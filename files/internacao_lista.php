<?php 
  
 
 
   $query = mysqli_query($conn,"SELECT internamento.id as autorizacao, internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida , cid.cid ,usuarios.nome as credenciado, cid.dias as dias FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid WHERE internamento.dat_saida = '00000-00-00' or (Month(internamento.dat_entrada) = ".date("m")." and Year(internamento.dat_entrada) = ".date("Y").") order by internamento.id") or die("erro ao carregar consulta");


?>

<!-- Perguntar antes de saida -->
<script language="Javascript">
function saida(id,dat_saida) {

   if (dat_saida != true){
     var resposta = confirm("Deseja dar saída do paciente?");
 
     if (resposta == true) {
          window.location.href = "saida_internacao.php?id="+id+"&dat_saida="+dat_saida;
     }
   }else{
      alert("Usuário já saiu!");
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



                    
   <table class="table table-striped" width="709" align="center" style="font-size: 9px">
               <tr>
                 <td colspan="14" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados</strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                  <td width="236"><div align="center">Status</div></td>
                  <td width="236"><div align="center">Autorização</div></td>
                  <td width="236"><div align="center">Paciente</div></td>
                  <td width="257"><div align="center">Matricula</div></td>
                  <td width="257"><div align="center">Solicitante</div></td>
                  <td width="202"><div align="center">CRM</div></td>
                  <td width="202"><div align="center">Entrada</div></td>
                  <td width="202"><div align="center">diárias</div></td>
                  <td width="202"><div align="center">Saída</div></td>
                  <td width="202"><div align="center">CID</div></td>
                  <td width="202"><div align="center">Credenciado</div></td>
                   <td width="202"><div align="center"></div></td>
                    <td width="202"><div align="center"></div></td>
               </tr>
                          
              <?php

                 
                  while($registro = mysqli_fetch_assoc($query)){
                         
                      

                         echo " <tr>   
                                    <td><div align='center'>";

                                     if ($registro["dat_saida"] != 0){

                                    echo "<span class='glyphicon glyphicon-ok'> </span>";

                                    }

                         echo          "</div></td>
                                    <td><div align='center'> <a href = 'rel_internacao.php?id_internacao=".$registro["autorizacao"]." '>  ".$registro["autorizacao"]."</a></div></td>
                                    <td><div align='center'>".$registro["paciente"]."</div></td>
                                    <td><div align='center'>".$registro["matricula"]."</div></td>
                                    <td><div align='center'>".$registro["solicitante"]."</div></td>
                                     <td><div align='center'>".$registro["crm"]."</div></td>
                                     <td><div align='center'>".date("j/n/Y H:i:s",strtotime($registro["dat_entrada"]))."</div></td>
                                     <td><div align='center'>".$registro["dias"]."</div></td>
                                     <td>
                                      <div align='center'>";

                                     if ($registro["dat_saida"] == 0) {
                                     
                                          echo   "";
                                          $dat_saida = false;

                                    }else{

                                           echo   "<font color='green'>".date("d/m/Y H:i:s",strtotime($registro["dat_saida"]))."</font>";
                                           $dat_saida = true;
                                    }

                        echo "        </div>
                                    </td>
                                    <td><div align='center'>".$registro["cid"]."</div></td>
                                    <td><div align='center'>".$registro["credenciado"]."</div></td>
                                    <td>
                                        <div align='center'>
                                            <a class='btn btn-primary' style='width: 50px; height: 25px' href='javascript:func()' onclick='saida(".$registro['autorizacao'].",".$dat_saida.")'><span style='font-size: 10px; align: center;'> Saída </center> </span> </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div align='center'>
                                            <a class='btn btn-danger' style='width: 50px; height: 25px' href='javascript:func()' onclick='excluir(".$registro["autorizacao"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                        </div>
                                    </td>
                                 </tr>";
                     }
                  

                   
              ?>              
            
        </table>
			       <span style="background-color: red"></span>
					
	