<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
if(isset($id)){

$deleta = mysqli_query($conn,"DELETE FROM pronto_atendimento WHERE id = '$id'");

header ("location: pronto_atendimento.php");
}
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"pronto_atendimento.php\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"pronto_atendimento.php\"</script>";
}
?>