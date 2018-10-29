<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
if(isset($id)){

$deleta = mysqli_query($conn,"DELETE FROM internamento WHERE id = '$id'");

header ("location: internacao.php");
}
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"internacao.php\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"internacao.php\"</script>";
}
?>