
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  
$id_internamento = $_POST["id_internamento"];
$id_acomodacao = $_POST["id_acomodacao"];
$motivo = $_POST["motivo"];

      $query = "INSERT INTO `alocacao`(`id`, `id_internamento`, `id_acomodacao`, `motivo` , `data`) VALUES (null , '".$id_internamento."', '".$id_acomodacao."' , '".$motivo."' , '".date("Y-m-d H:i:s" )."' )";

        $insert = mysqli_query($conn, $query);

        $id_alocacao = mysqli_insert_id($conn);

     

       $sql = "UPDATE `internamento` SET  `id_alocacao`= ".$id_alocacao." WHERE id = '".$id_internamento."'";

        
        $update = mysqli_query($conn,$sql); 

        
        if($update){

          echo"<script language='javascript' type='text/javascript'>alert('Alteração aplicada com sucesso!');window.location.href='painel.php?int=1'</script>";
          
        }else{
         
        //  echo"<script language='javascript' type='text/javascript'>alert('Alteração não aplicada com sucesso!');window.location.href='painel.php?int=1'</script>";

        }
    
    
?>