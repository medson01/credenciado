
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
        				echo "<script>alert('Matr\u00edcula n\u00e3o exite!');location.href=\"painel.php?lab=1&id=".$id."\"</script>";
		        			
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
	                        
	         }

	        
	        if($contrato_ativo <> 1){

	        		if(isset($_GET['pa'])){  

        		    	echo "<script>alert('Contrato bloqueado!');location.href=\"painel.php?pa=1&id=".$id."\"</script>";
        		    }
        		    if(isset($_GET['int'])){
        		    	
        		    	echo "<script>alert('contrato bloqueado!!');location.href=\"painel.php?int=1&id=".$id."\"</script>";

        		    }
        		    if(isset($_GET['lab'])){
        		    	
        		    	echo "<script>alert('contrato bloqueado!!');location.href=\"painel.php?lab=1&id=".$id."\"</script>";

        		    }

	        }elseif ($pessoa_ativa <> 1) {
	        		
	        		if(isset($_GET['pa'])){  

        		    	echo "<script>alert('Usuário bloqueado!');location.href=\"painel.php?pa=1&id=".$id."\"</script>";
        		    }
        		    if(isset($_GET['int'])){
        		    	
        		    	echo "<script>alert('Usuário bloqueado!!');location.href=\"painel.php?int=1&id=".$id."\"</script>";

        		    }
                   if(isset($_GET['lab'])){
        		    	
        		    	echo "<script>alert('Usuário bloqueado!!');location.href=\"painel.php?lab=1&id=".$id."\"</script>";

        		    }
	        }else{
			        
		            if(isset($_GET['pa'])){      
		       					echo "<script>location.href=\"painel.php?pa=1&id=".$id."&matricula=".$matricula."&nome=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."\"</script>";
		        	}
		        	if(isset($_GET['int'])){
		        	 			echo "<script>location.href=\"painel.php?int=1&id=".$id."&matricula=".$matricula."&paciente=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."\"</script>";
		        	}
		          if(isset($_GET['lab'])){
		        	 			echo "<script>location.href=\"painel.php?lab=1&id=".$id."&matricula=".$matricula."&paciente=".$nome."&cpf=".$cpf."&id_beneficiarios=".$id_beneficiarios."&data_nascimento=".$data_nascimento."&deficiente=".$deficiente."\"</script>";
		        	}

        	}

			


        }
   }  
   
     
?>
