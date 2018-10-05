<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
echo $id = $_GET['id'];
echo $dat_saida = $_GET['dat_saida'];
//echo $dat_saida = $_GET['dat_saida'];



/*
if(isset($id)){
$update = mysqli_query($conn,"UPDATE `internamento` SET `dat_saida`= now() WHERE id = '".$id."'");

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

*/
?>
