<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
if(isset($id)){

$deleta = mysqli_query($conn,"DELETE FROM pronto_atendimento WHERE id = '$id'");

header ("location: painel.php?pa=1");
}
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"painel.php?pa=1\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"painel.php?pa=1\"</script>";
}
?>