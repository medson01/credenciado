<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
if(isset($id)){

$deleta = mysqli_query($conn,"DELETE FROM credenciado WHERE id = '$id'");

header ("location: credenciado.php");
}
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"credenciado.php\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"credenciado.php\"</script>";
}
?>