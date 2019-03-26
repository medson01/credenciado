
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";

       # Corrige o erro de acentuação no banco
         mysqli_query($conn,"SET NAMES 'utf8'");


$id_credenciado = $_SESSION["id"];
$codigo = $_POST["codigo"];
$nome = $_POST["nome"];
$cpf_cnpj = $_POST["cpf_cnpj"];
$nome_fantasia = $_POST["nome_fantasia"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cep = str_replace("-", "", $_POST["cep"]);
$cidade = $_POST["cidade"];
$celular =  str_replace("-","",str_replace(")", "",str_replace("(", "", $_POST["celular"])));
$telefone =  str_replace("-","",str_replace(")", "",str_replace("(", "", $_POST["telefone"])));
$email = $_POST["email"];
$banco = $_POST["banco"];
$agencia = $_POST["agencia"];
$operacao = $_POST["operacao"];
$conta = $_POST["conta"];
$estado = $_POST["estado"];
    
    if(isset( $_POST['id'])){ 

       $query = "UPDATE `credenciado` SET  `codigo`='".$codigo."' , `cpf_cnpj`='".$cpf_cnpj."', `nome`= '".$nome."', `nome_fantasia`='".$nome_fantasia."', `endereco`='".$endereco."', `bairro`='".$bairro."', `numero`='".$numero."', `cep`='".$cep."', `cidade`='".$cidade."', `estado`='".$estado."', `telefone`='".$telefone."', `celular`='".$celular."', `email`='".$email."', `banco`='".$banco."', `agencia`='".$agencia."', `operacao`='".$operacao."', `conta`='".$conta."' WHERE id ='". $_POST['id']."'";

    }else{

		    $query = "INSERT INTO `credenciado`(`id`, `id_usuarios`, `codigo`, `cpf_cnpj`, `nome`, `nome_fantasia`, `endereco`, `bairro`, `numero`, `cep`, `cidade`, `estado`, `telefone`, `celular`, `email`, `banco`, `agencia`, `operacao`, `conta`) VALUES (null,'".$id_credenciado."', '".$codigo."', '".$cnpj_cpf."' , '".$nome."','".$nome_fantasia."',	'".$endereco."', '".$bairro."' , '".$numero."' , '".$cep."','".$cidade."', '".$estado."' , '".$telefone."','".$celular."','".$email."','".$banco."','".$agencia."','".$operacao."','".$conta."')";

     }  
	 
   
        $insert = mysqli_query($conn, $query);
		
		    $res = mysqli_insert_id($conn);

        
        if($insert){

          if(isset( $_POST['id'])){ 
          
		       echo"<script language='javascript' type='text/javascript'>alert('Credenciado atualizado com sucesso!');window.location.href='credenciado.php'</script>";
          }else{
           echo"<script language='javascript' type='text/javascript'>alert('Credenciado cadastrado com sucesso!');window.location.href='credenciado.php'</script>";          }
          
        }else{
		
          echo"<script language='javascript' type='text/javascript'>alert('Credenciado não cadastrado com sucesso!');window.location.href='credenciado.php'</script>";

        }
 
     
?>