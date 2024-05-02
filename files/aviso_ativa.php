<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
$deleta = mysqli_query($conn,"UPDATE `avisos` SET `status`= 1 WHERE id = '".$id."'");
if($deleta == ''){
echo "<script>alert('Houve um erro ao atualizar!');
location.href=\"painel.php?aviso=1\"</script>";
}else{
echo "<script>alert('Registro atualizado com sucesso!');
location.href=\"painel.php?aviso=1\"</script>";
}
?>