<?php 
  
 
 
   $query = mysqli_query($conn,"SELECT internamento.id as autorizacao, internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.data as data ,usuarios.nome as credenciado FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario ORDER BY internamento.id") or die("erro ao carregar consulta");


?>
                    
   <table class="table table-striped" width="709" align="center" style="font-size: 9px">
               <tr>
                 <td colspan="8" style="text-align: center; text-decoration-style: solid;"> <strong>Pacientes insternados</strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                  <td width="236"><div align="center">Autorização</div></td>
                  <td width="236"><div align="center">Paciente</div></td>
                  <td width="257"><div align="center">Matricula</div></td>
                  <td width="257"><div align="center">solicitante</div></td>
                  <td width="202"><div align="center">crm</div></td>
                  <td width="202"><div align="center">Data</div></td>
                  <td width="202"><div align="center">credenciado</div></td>
                   <td width="202"><div align="center"></div></td>
               </tr>
                            
              <?php

                 
                  while($registro = mysqli_fetch_assoc($query)){
                         print "  <tr>
                                    <td><div align='center'>".$registro["autorizacao"]."</div></td>
                                    <td><div align='center'>".$registro["paciente"]."</div></td>
                                    <td><div align='center'>".$registro["matricula"]."</div></td>
                                    <td><div align='center'>".$registro["solicitante"]."</div></td>
                                     <td><div align='center'>".$registro["crm"]."</div></td>
                                     <td><div align='center'>".$registro["data"]."</div></td>
                                     <td><div align='center'>".$registro["credenciado"]."</div></td>
                                    <td><div align='center'><a class='btn btn-primary delete' href=deleta_inscricoes.php?id=".$registro["autorizacao"].">Excluir</a></div></td>
                                  </tr>";
                   }

                  mysqli_close($conn);   
              ?>              
            
        </table>
			       
					
	