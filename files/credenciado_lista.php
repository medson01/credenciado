<?php 
  
  // retira os erros 
 // error_reporting(0);

        # Corrige o erro de acentuação no banco
         mysqli_query($conn,"SET NAMES 'utf8'");

 if(isset($_GET['mes'])){

  $mes = $_GET['mes'];
 

  }else{

  $mes = date("m");
  
  }
 
  If( $_SESSION["perfil"] == "usuario"){
   $query = mysqli_query($conn,"SELECT `id`,`nome`,`nome_fantasia`,`cpf_cnpj`, `codigo`, `data_inc`, `telefone`, `celular`, `email` FROM `credenciado`") or die("erro ao carregar consulta");
  }else{

     $query = mysqli_query($conn,"SELECT `id`,`nome`,`nome_fantasia`,`cpf_cnpj`, `codigo`, `data_inc`, `telefone`, `celular`, `email` FROM `credenciado` ") or die("erro ao carregar consulta");

  }




?>


<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

<!-- Perguntar antes de saida -->


<!-- Perguntar antes de excluir -->
<script language="Javascript">
function excluir(id) {
     var resposta = confirm("Deseja remover esse registro?");
     
     if (resposta == true) {
          window.location.href = "credenciado_deleta.php?id="+id;


     }
}
</script>

<!-- Atualizar credenciado -->
<script language="Javascript">
function atualizar(id) {
          window.location.href = "painel.php?cred=1&id="+id;
}
</script>

<!-- pegar mes de consulta  -->
<script language="Javascript">
    function mudarmes(){
      var x = document.getElementById("mes").value;
      window.location.href = x;
    }
</script>
                    
   <table class="table table-striped" align="center" style="font-size: 10px">
               <tr>
                 <td colspan="12" style="text-align: center; text-decoration-style: solid;"> <strong> Empresas </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td style='padding: 4px;'><div align="center">Id</div></td>
                 <td style='padding: 4px;'><div align="center">Nome</div></td>
                 <td style='padding: 4px;'><div align="center">CNPJ/CPF</div></td>
                  <td style='padding: 4px;'><div align="center">Código</div></td>
                  <td style='padding: 4px;'><div align="center">Data Inclusão</div></td>
                  <td style='padding: 4px;'><div align="center">telefone</div></td>
                  <td style='padding: 4px;'><div align="center">Celular</div></td>
                  <td style='padding: 4px;'><div align="center">E-mail</div></td>
                 <!-- <?php If( $_SESSION["perfil"] == "administrador"){ echo "<td style='padding: 4px;'><div align='center'>Credenciado</div></td>"; } ?> -->
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
                                    <td ><div align='center'> <a href = 'credenciado_relatorio.php?id_credenciado=".$registro["id"]." '>  ".$registro["id"]."</a></div></td>
                                    <td ><div align='center'>".$registro["nome"]."</div></td>
                                    <td ><div align='center'>".$registro["cpf_cnpj"]."</div></td>
                                    <td ><div align='center'>".$registro["codigo"]."</div></td>
                                    <td ><div align='center'>".date("d/m/Y ",strtotime($registro["data_inc"]))."</div></td>
                                    <td ><div align='center'>".$registro["telefone"]."</div></td>
								    <td ><div align='center'>".$registro["celular"]."</div></td>
									<td ><div align='center'>".$registro["email"]."</div></td>
									<td></td>";

                      

                        echo "
                                    <td align='right'>
                                       

                                            <!-- Botão sair -->
                                            <a class='btn btn-primary  btn-xs'  onclick='atualizar(".$registro["id"].")'><span style='font-size: 10px; align: center;'> Atualizar </center> </span> </a>";
                                           

                                       
                    If( $_SESSION["perfil"] == "administrador"){
                         echo  " <!-- Botão exluir -->
                                            <a class='btn btn-danger  btn-xs'  onclick='excluir(".$registro["id"].")'><span style='font-size: 10px; align: center;'> Excluir </span> </a>
                                

                                       
                                    </td>
                                 </tr>";
                          }       
                                 $i++;
                     }
                  

                   
              ?>              
            
</table>
			       <span style="background-color: red"></span>
					
	