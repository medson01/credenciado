
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];


if(isset($_GET['prorrogacao'])){
	$prorrogacao = $_GET['prorrogacao'];
	$update = mysqli_query($conn,"UPDATE `internamento` SET `dat_saida`= now(), `prorrogacao`= '".$prorrogacao."' WHERE id = '".$id."'");
	//echo "existe";
}else{

	$update = mysqli_query($conn,"UPDATE `internamento` SET `dat_saida`= now() WHERE id = '".$id."'");
	//echo "Não existe";
}



if($update == ''){
echo "<script>alert('Houve um erro ao atualizar!');
location.href=\"painel.php?int=1\"</script>";
}else{
echo "<script>alert('Internamento finalizado com sucesso!');
location.href=\"painel.php?int=1\"</script>";
}


?>
