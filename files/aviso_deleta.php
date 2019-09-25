<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];

$sql = "DELETE FROM avisos WHERE id = '".$id."'";

$deleta = mysqli_query($conn,$sql);


if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"painel.php?aviso=1\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"painel.php?aviso=1\"</script>";
}


?>