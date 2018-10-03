<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
$deleta = mysqli_query($conn,"DELETE FROM usuarios WHERE id = '$id'");
if($deleta == ''){
echo "<script>alert('Houve um erro ao deletar!');
location.href=\"form_cadastro_usuario.php\"</script>";
}else{
echo "<script>alert('Registro excluido com sucesso!');
location.href=\"form_cadastro_usuario.php\"</script>";
}
?>