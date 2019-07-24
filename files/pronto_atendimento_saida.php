
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 
$id = $_GET['id'];

if(isset($_GET['paciente'])){
		$paciente = $_GET['paciente'];
}
if(isset($_GET['id_beneficiarios'])){
		$id_beneficiarios = $_GET['id_beneficiarios'];
}
if (isset($_GET['matricula'])){
	    $matricula = $_GET['matricula'];
}
        
if(!empty($_GET['motivo_saida'])){
	$motivo_saida = $_GET['motivo_saida'];
}



if(isset($_GET['prorrogacao'])){
	$prorrogacao = $_GET['prorrogacao'];
	$update = mysqli_query($conn,"UPDATE `pronto_atendimento` SET `dat_saida`= now(), `prorrogacao`= '".$prorrogacao."' WHERE id = '".$id."'");
	
}else{

	$update = mysqli_query($conn,"UPDATE `pronto_atendimento` SET `dat_saida`= now(), `motivo_saida`= '".$motivo_saida."'  WHERE id = '".$id."'");
	
}



if(!isset($_GET['matricula'])){
		if($update == ''){
			echo "<script>alert('Houve um erro ao atualizar!');
			location.href=\"painel.php?pa=1\"</script>";
			}else{
			echo "<script>alert('Saída efetuada com sucesso!');
			location.href=\"painel.php?pa=1\"</script>";
		}
}else{
 	if($update == ''){

 

					echo "<script>alert('Houve um erro ao atualizar!');
			location.href=\"painel.php?pa=1&id=".$id."&matricula=".$matricula."&paciente=".$paciente."\"</script>";
			
			}else{
				
					echo "<script>alert('Pronto atendimento encerrado com sucesso! \\n Favor preencher os dados da internação');
			location.href=\"painel.php?int=1&id=".$id."&matricula=".$matricula."&id_beneficiarios=".$id_beneficiarios."&paciente=".$paciente."\"</script>";

			
		}

}


	

?>
