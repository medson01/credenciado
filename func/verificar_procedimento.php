 <?php

// Arquivo de configuração
 require_once "../config/config.php";
$cod_proc = $_GET['cod_proc'];
echo $tamanho = strlen($cod_proc);
 
If($tamanho < 8){

  $dados = "<script language='javascript' type='text/javascript'>alert('O procedimento tem que ter no m\u00ednimo 8 d\u00edgitos');location.href=\"".$_SESSION["url"]."\"</script>";

 //  $dados = "<script language='javascript' type='text/javascript'>alert($tamanho);</script>";

}else{

      $sql = "SELECT id, descricao FROM `procedimento` WHERE codigo = ".$cod_proc;

      $stmt = $pdo->prepare($sql);
         
      $stmt->execute();

      $resultado = $stmt->rowCount();

   if ($resultado > 0){
      
      while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
               $id_proc = $registro["id"];
               $desc_proc = $registro["descricao"];
      };
          
          $dados =  "<script>location.href=\"painel.php?".$_SESSION["url"]."&numero_protocolo=1&sadt=1&desc_proc=".$desc_proc."&id=1&id_proc=".$id_proc."&cod_proc=".$cod_proc."\"</script>";
   
   }else{
      $dados = "<script language='javascript' type='text/javascript'>alert('Procedimento n\u00e3o existe!');location.href=\"".$_SESSION["url"]."\"</script>";
   }
}

