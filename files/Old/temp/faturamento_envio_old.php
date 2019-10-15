
<?php 

	// Arquivo de configuração
 require_once "../config/config.php";

$id_usuario =  $_POST["id"];
$prod_mes = $_POST["prod_mes"];
$prod_ano = $_POST["prod_ano"];
$qtd_lote = $_POST["qtd_lote"];
$valor = $_POST["valor"];

        $query = "INSERT INTO faturamento (id, id_usuario, mes, ano, qtd_lote, valor) VALUES (null,'$id_usuario','$prod_mes','$prod_ano','$qtd_lote', '$valor')";
      

        $insert = mysqli_query($conn, $query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Faturamento cadastrado com sucesso!');window.location.href='form_faturamento_envio.php'</script>";
		  
		     if(isset($_FILES['fileUpload']))
				   {
					  date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
				
					  $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
					  $new_name = $_SESSION["credenciado"]." - ". date("d.m.Y-H.i.s") . $ext; //Definindo um novo nome para o arquivo
					  $dir = '../producao/'; //Diretório para uploads
				
					  move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
				   }
		  
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Faturamento não cadastrado com sucesso!');window.location.href='form_faturamento_envio.php'</script>";

        }
  
     
  
?>