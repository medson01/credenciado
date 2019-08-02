
<?php 

	// Arquivo de configuração
 require_once "../config/config.php";

$id_credenciado = $_POST["id_credenciado"];
$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];

         $query = "INSERT INTO avisos (id, id_credenciado, titulo, conteudo, data, status) VALUES (null,'$id_credenciado','$titulo','$conteudo','".date("Y-m-d H:i:s")."', '1')";
      

        $insert = mysqli_query($conn, $query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Aviso cadastrado com sucesso!');window.location.href='painel.php?aviso=1'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Aviso não cadastrado com sucesso!');window.location.href='painel.php?aviso=1'</script>";

        }
  
    
    
?>