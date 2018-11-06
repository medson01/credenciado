<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
$deleta = mysqli_query($conn,"DELETE FROM avisos WHERE id = '$id'");
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"aviso.php\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"aviso.php\"</script>";
}
?>