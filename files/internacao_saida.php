
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 $id_usuario_out = $_SESSION["id"];
 
 if(isset($_GET['id'])){ 
	$id = $_GET['id'];
}else{
	$id = $_POST['id'];
}

if(!empty($_POST['motivo_saida'])){
	$motivo_saida = $_POST['motivo_saida'];
}else{
	$motivo_saida = '';
}

if(!empty($_POST['data'])){
	$dat_saida = $_POST['data'];
	$time = $_POST['time'];

	$dat_saida = $dat_saida." ".$time;

}else{

	$dat_saida = date("Y-m-d H:i:s");

}


if(isset($_GET['prorrogacao'])){
	$prorrogacao = $_GET['prorrogacao'];
	$update = mysqli_query($conn,"UPDATE `internamento` SET `id_usuario_out`= '".$id_usuario_out."', `dat_saida`= '".$dat_saida."', `prorrogacao`= '".$prorrogacao."' WHERE id = '".$id."'");
	//echo "existe";
}else{

	$update = mysqli_query($conn,"UPDATE `internamento` SET `id_usuario_out`= '".$id_usuario_out."', `dat_saida`= '".$dat_saida."', `motivo_saida`= '".$motivo_saida."' WHERE id = '".$id."'");
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
