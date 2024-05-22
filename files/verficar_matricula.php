
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 


if(isset($_GET['matric'])){

     $matricula = $_GET['matric'];

     $id = '0';

	
	 $tipreg = substr($_GET['matric'], 16	);
	 
	 $matric = substr($_GET['matric'], 9, -3);



	 $query = mysqli_query($conn,"SELECT * FROM `beneficiarios` WHERE matricula = '".$matric."' AND tipreg = '".$tipreg."'") or die("erro ao carregar consulta");

	 	//Beneficiaário não existe
        if (mysqli_num_rows($query)<=0) {


		     if(isset($_GET['pa'])){	
        		    	echo "<script>alert('Matrícula não exite!');location.href=\"painel.php?pa=1&id=".$id."\"</script>";
		     }

		     if(isset($_GET['int'])){
        				echo "<script>alert('Matr\u00edcula n\u00e3o exite!');location.href=\"painel.php?int=1&id=".$id."\"</script>";
		        			
		     }

		     if(isset($_GET['lab'])){
			 		if($_GET['lab'] == "consulta"){
						echo "<script>alert('Matr\u00edcula n\u00e3o exite!');location.href=\"painel.php?lab=consulta&id=".$id."\"</script>";
        			}else{
						echo "<script>alert('Matr\u00edcula n\u00e3o exite!');location.href=\"painel.php?lab=exame&id=".$id."\"</script>";
		        	}		
		     }

		//Beneficiário existe
        }else{
        	    		
	        while($registro = mysqli_fetch_assoc($query)){
			
	        	$id_beneficiarios = $registro["id"];                
	         	$data_nascimento = $registro["data_nascimento"];
				$nome = $registro["nome"];
	            $cpf = $registro["cpf"];
	     		$contrato_ativo = $registro["contrato_ativo"];
	     		$pessoa_ativa = $registro["pessoa_ativa"];
	     		$deficiente = $registro["deficiente"];
		    	$data_inclusao = $registro["data_inclusao"];
	                        
	         }

	        
	        if($contrato_ativo <> 1){

	        		if(isset($_GET['pa'])){  

        		    	echo "<script>alert('Contrato bloqueado!');location.href=\"painel.php?pa=1&id=".$id."\"</script>";
        		    }
        		    if(isset($_GET['int'])){
        		    	
        		    	echo "<script>alert('contrato bloqueado!!');location.href=\"painel.php?int=1&id=".$id."\"</script>";

        		    }
        		    if(isset($_GET['lab'])){
        		    	if($_GET['lab'] == "consulta"){
        		    		echo "<script>alert('contrato bloqueado!!');location.href=\"painel.php?lab=consulta&id=".$id."\"</script>";
						}else{
							echo "<script>alert('contrato bloqueado!!');location.href=\"painel.php?lab=exame&id=".$id."\"</script>";
						}
        		    }

	        }elseif ($pessoa_ativa <> 1) {
	        		
	        		if(isset($_GET['pa'])){  

        		    	echo "<script>alert('Usuário bloqueado!');location.href=\"painel.php?pa=1&id=".$id."\"</script>";
        		    }
        		    if(isset($_GET['int'])){
        		    	
        		    	echo "<script>alert('Usuário bloqueado!!');location.href=\"painel.php?int=1&id=".$id."\"</script>";

        		    }
                   if(isset($_GET['lab'])){
        		    	if($_GET['lab'] == "consulta"){
        		    		echo "<script>alert('Usuário bloqueado!!');location.href=\"painel.php?lab=consulta&id=".$id."\"</script>";
						}else{
							echo "<script>alert('Usuário bloqueado!!');location.href=\"painel.php?lab=exame&id=".$id."\"</script>";
						}

        		    }
	        }else{		
			        $date = $data_inclusao;
					$date = str_replace('/', '-', $date);
					
					
		            if(isset($_GET['pa'])){      
		       					echo "<script>location.href=\"painel.php?pa=1&id=".$id."&matricula=".$matricula."&nome=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."&data_inclusao=".$$data_inclusao."\"</script>";
		        	}
		        	if(isset($_GET['int'])){
		        	 			echo "<script>location.href=\"painel.php?int=1&id=".$id."&matricula=".$matricula."&paciente=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."&data_inclusao=".$data_inclusao."\"</script>";		        	}
		          if(isset($_GET['lab'])){
						if($_GET['lab'] == "consulta"){
									echo "<script>location.href=\"painel.php?lab=consulta&id=".$id."&matricula=".$matricula."&paciente=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."&data_inclusao=".$data_inclusao."\"</script>";
						}else{
									echo "<script>location.href=\"painel.php?lab=exame&id=".$id."&matricula=".$matricula."&paciente=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."&data_inclusao=".$data_inclusao."\"</script>";
						}
		          }

        	}

			


        }
   }  
   
     
?>
