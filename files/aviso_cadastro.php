
<?php 

	// Arquivo de configuração
 require_once "../config/config.php";

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];

         $query = "INSERT INTO avisos (id, id_usuarios, titulo, conteudo, data, status) VALUES (null,'$id','$titulo','$conteudo','".date("Y-m-d H:i:s")."', '1')";
      

        $insert = mysqli_query($conn, $query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Aviso cadastrado com sucesso!');window.location.href='aviso.php'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Aviso não cadastrado com sucesso!');window.location.href='aviso.php'</script>";

        }
  
      
    
?>