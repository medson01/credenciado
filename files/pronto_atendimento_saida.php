
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];


if(isset($_GET['prorrogacao'])){
	$prorrogacao = $_GET['prorrogacao'];
	$update = mysqli_query($conn,"UPDATE `pronto_atendimento` SET `dat_saida`= now(), `prorrogacao`= '".$prorrogacao."' WHERE id = '".$id."'");
	//echo "existe";
}else{

	$update = mysqli_query($conn,"UPDATE `pronto_atendimento` SET `dat_saida`= now() WHERE id = '".$id."'");
	//echo "Não existe";
}



if($update == ''){
echo "<script>alert('Houve um erro ao atualizar!');
location.href=\"pronto_atendimento.php\"</script>";
}else{
echo "<script>alert('Registro atulizado com sucesso!');
location.href=\"pronto_atendimento.php\"</script>";
}


?>
