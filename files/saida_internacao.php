<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
$dat_entrada = $_GET['dat_entrada'];


if(isset($id)){
$update = mysqli_query($conn,"UPDATE `internamento` SET `dat_saida`= '".date("Y-m-d H:i:s")."' WHERE id = '".$id."'");

if($dat_entrada){

}

header ("location: internacao.php");
}

if($update == ''){
echo "<script>alert('Houve um erro ao atualizar!');
location.href=\"internacao.php\"</script>";
}else{
echo "<script>alert('Registro atulizado com sucesso!');
location.href=\"internacao.php\"</script>";
}


?>
