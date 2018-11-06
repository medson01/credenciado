<?php 

if(isset($_GET['mes'])){

  $mes = $_GET['mes'];
 

  }else{

  $mes = date("m");
  
  }
 
  If( $_SESSION["perfil"] == "usuario"){   
                  $query = mysqli_query($conn,"SELECT avisos.status ,avisos.id, avisos.titulo, avisos.conteudo, usuarios.login, avisos.data FROM `avisos` INNER JOIN usuarios ON usuarios.id = avisos.id_usuarios where MONTH(avisos.data) = '".$mes."' or avisos.status = 1") or die("erro ao carregar os usuários");
  }else{
                  
                  $query = mysqli_query($conn,"SELECT avisos.status ,avisos.id, avisos.titulo, avisos.conteudo, usuarios.login, avisos.data FROM `avisos` INNER JOIN usuarios ON usuarios.id = avisos.id_usuarios where MONTH(avisos.data) = '".$mes."' or avisos.status = 1") or die("erro ao carregar os usuários");
}



                  $z = 0;
                  while($row = mysqli_fetch_assoc($query)){
                          $status[$z] = $row["status"];
                          $id[$z] = $row["id"];
                          $titulo[$z] = $row["titulo"];
                          $conteudo[$z] = $row["conteudo"];
                          $login2[$z] = $row["login"];
                          $data[$z] = $row["data"];

                          $z++;
                   }
 

                 
              
 ?>


<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>


<!-- Perguntar antes de excluir -->
<script language="Javascript">
function excluir(id) {
     var resposta = confirm("Deseja remover esse registro?");
     
     if (resposta == true) {
          window.location.href = "aviso_deleta.php?id="+id;


     }
}
</script>
<div align="right"><span style="right:inherit">Mês
  <select name="mes" id="mes" onchange="mudarmes()">
    <option  value="" > ... </option>
    <option  value="aviso.php?mes=01"<?php  if($mes == '01'){ echo "selected"; } ?>>Janeiro </option>
    <option  value="aviso.php?mes=02"<?php  if($mes == '02'){ echo "selected"; } ?>>Fevereiro</option>
    <option  value="aviso.php?mes=03"<?php  if($mes == '03'){ echo "selected"; } ?>>Março</option>
    <option  value="aviso.php?mes=04"<?php  if($mes == '04'){ echo "selected"; } ?>>abril</option>
    <option  value="aviso.php?mes=05"<?php  if($mes == '05'){ echo "selected"; } ?>>Maio</option>
    <option  value="aviso.php?mes=06"<?php  if($mes == '06'){ echo "selected"; } ?>>Junho</option>
    <option  value="aviso.php?mes=07"<?php  if($mes == '07'){ echo "selected"; } ?>>Julho</option>
    <option  value="aviso.php?mes=08"<?php  if($mes == '08'){ echo "selected"; } ?>>Agosto</option>
    <option  value="aviso.php?mes=09"<?php  if($mes == '09'){ echo "selected"; } ?>>Setembro</option>
    <option  value="aviso.php?mes=10"<?php  if($mes == '10'){ echo "selected"; } ?>>Outubro</option>
    <option  value="aviso.php?mes=11"<?php  if($mes == '11'){ echo "selected"; } ?>>Novembro</option>
    <option  value="aviso.php?mes=12"<?php  if($mes == '12'){ echo "selected"; } ?>>dezembro</option>
  </select>
</span></div>

<!-- pegar mes de consulta  -->
<script language="Javascript">
    function mudarmes(){
      var x = document.getElementById("mes").value;
      window.location.href = x;
    }
</script>
                    
   <table class="table table-striped" align="center" style="font-size: 9px">
               <tr>
                 <td colspan="8" style="text-align: center; text-decoration-style: solid;"> <strong>Avisos cadastrados</strong></td>
               </tr>
               <tr>
                  <td ><div align="center">Status</div></td>
                  
                  <td ><div align="center">Login</div></td>
                   <td ><div align="center">Data</div></td>
                  <td ><div align="center">Titulo</div></td>
                  <td ><div align="center">Aviso</div></td>
                  <td style="width:25px"><div align="center"></div></td>
                  <td style="width:25px"><div align="center"></div></td>
                  <td style="width:25px"><div align="center"></div></td>
                 

               </tr>
                            
              <?php

                  
                  
                  for ($i=0; $i < $z; $i++) { 
                
                         print "  <tr>
                                    <td><div align='center'>";
                                    if($status[$i] == 1){
                                            echo "<span class='glyphicon'>&#xe013;</span>";
                                    }else{
                                            echo "<span class='glyphicon'>&#xe014;</span>";
                                    }
                        print "   </a></div></td>
                                    
                                    <td><div align='center'>".$login2[$i]."</div></td>
                                     <td><div align='center'>".date("j/n/Y <\b\\r> H:i:s",strtotime($data[$i]))."</div></td>
                                    <td><div align='center'>".$titulo[$i]."</div></td>
                                    <td><div align='center'>".$conteudo[$i]."</div></td>
                                   
                         ";
                       If( $_SESSION["perfil"] == "administrador"){
                            print "
                                        <td style='width:25px'><a class='btn btn-success btn-sm' href=aviso_ativa.php?id=".$id[$i]."><span class='glyphicon glyphicon-ok' align: center;'></span></a></td>
                                      ";
                            print "
                                        <td style='width:25px'><a class='btn btn-primary btn-sm'  href=aviso_desativar.php?id=".$id[$i]."><span class='glyphicon glyphicon-remove' align: left;'></span></a></td>
                                      ";
                            print "
                                        <td style='width:25px'><div align='center'><a class='btn btn-danger btn-sm' href=aviso_deleta.php?id=".$id[$i]."><span class='glyphicon glyphicon-trash' style='align: center;'></span></a></td>
                                      </tr>";
                       }

                  } 
              ?>              
            
        </table>     
			       <span style="background-color: red"></span>
					
	