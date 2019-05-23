<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
  
  # Corrige o erro de acentuação no banco
  mysqli_query($conn,"SET NAMES 'utf8'");
  
  
  echo $_SESSION["id_credenciado"];
 
 
  

   
    $query = mysqli_query($conn,"SELECT `id`,`nome`,`nome_fantasia`,`cpf_cnpj`, `codigo`, `data_inc`, `telefone`, `celular`, `email`, `endereco`, `numero`, `bairro`, `cep`, `cidade`, `estado` FROM `credenciado` WHERE id = '".$_SESSION["id_credenciado"]."'") or die("erro ao carregar consulta");
  


               while($registro = mysqli_fetch_row($query)){

                               echo   $id = $registro[0];
                               echo   $nome = $registro[1];
                               echo   $nome_fantasia = $registro[2];
                               echo    $cpf_cnpj = $registro[3];
                               echo   $codigo = $registro[4];
                               echo   $data_inc = $registro[5];
                               echo    $telefone = $registro[6];
                               echo    $celular = $registro[7];
                               echo   $email = $registro[8];
                               echo   $endereco = $registro[9];
                               echo   $numero = $registro[10];
                               echo   $bairro = $registro[11];
                               echo   $cep = $registro[12];
                               echo    $cidade = $registro[13];
                                

                                   
               }
              
  
 ?>