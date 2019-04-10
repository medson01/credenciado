
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];
$paciente = $_GET['paciente'];
$matricula = $_GET['matricula'];


if(isset($_GET['prorrogacao'])){
	$prorrogacao = $_GET['prorrogacao'];
	$update = mysqli_query($conn,"UPDATE `pronto_atendimento` SET `dat_saida`= now(), `prorrogacao`= '".$prorrogacao."' WHERE id = '".$id."'");
	//echo "existe";
}else{

	$update = mysqli_query($conn,"UPDATE `pronto_atendimento` SET `dat_saida`= now() WHERE id = '".$id."'");
	//echo "Não existe";
}


if(!isset($_GET['matricula'])){
		if($update == ''){
			echo "<script>alert('Houve um erro ao atualizar!');
			location.href=\"pronto_atendimento.php\"</script>";
			}else{
			echo "<script>alert('Saída efetuada com sucesso!');
			location.href=\"pronto_atendimento.php\"</script>";
		}
}else{
 	if($update == ''){
			echo "<script>alert('Houve um erro ao atualizar!');
			location.href=\"internacao.php?id=".$id."&matricula=".$matricula."&paciente=".$paciente."\"</script>";
			}else{
			echo "<script>alert('Pronto atendimento encerrado com sucesso! \\n Favor preencher os dados da internação');
			location.href=\"internacao.php?id=".$id."&matricula=".$matricula."&paciente=".$paciente."\"</script>";
		}

}

?>
