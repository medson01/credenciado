
<?php
// Arquivo de configuração
 require_once "../config/config.php";
 


if(isset($_GET['matric'])){

     $matricula = $_GET['matric'];

     $id = '1';

	
	 $tipreg = substr($_GET['matric'], 16	);
	 
	 $matric = substr($_GET['matric'], 9, -3);


	 $query = mysqli_query($conn,"SELECT nome, cpf FROM `beneficiarios` WHERE matricula = '".$matric."' AND tipreg = '".$tipreg."'") or die("erro ao carregar consulta");


	 if(isset($_GET['pa'])){

        

        		if (mysqli_num_rows($query)<=0) {

        		    	echo "<script>location.href=\"pronto_atendimento.php?id=".$id."\"</script>";
        			
        		}else{

        	    		
	        			while($registro = mysqli_fetch_assoc($query)){
	                        
	                     $nome = $registro["nome"];
	                     $cpf = $registro["cpf"];
	     
	                        
	                   }

                  
       					echo "<script>location.href=\"pronto_atendimento.php?id=".$id."&matricula=".$matricula."&nome=".$nome."&cpf=".$cpf."\"</script>";
   
        	   	}
      }



    if(isset($_GET['int'])){

		
		        		if (mysqli_num_rows($query)<=0) {

		        		    	echo "<script>location.href=\"internacao.php?id=".$id."\"</script>";
		        			
		        		}else{

		        	    		
			        			while($registro = mysqli_fetch_assoc($query)){
			                        
			                     $nome = $registro["nome"];
			                     $cpf = $registro["cpf"];
			     
			                        
			                   }

		                  
		       					echo "<script>location.href=\"internacao.php?id=".$id."&matricula=".$matricula."&paciente=".$nome."&cpf=".$cpf."\"</script>";
		   
		        	   	}


      }
       
   }     
?>
