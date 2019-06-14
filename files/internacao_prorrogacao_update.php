
<?php 
    // Arquivo de configuração
  require_once "../config/config.php";
  

$id_prorrogacao = $_GET["id_prorrogacao"];


        $update = mysqli_query($conn,"UPDATE `prorrogacao` SET `status`= 2 WHERE id = '".$id_prorrogacao."'"); 
        
		
          echo"<script language='javascript' type='text/javascript'>window.location.href='painel.php?int=1'</script>";

       
  
     
    
?>