  <?php
  
  // Dados do Banco de Dados 
      // $connexao = date("m.d.y");
       $banco = 'Banco - IPASEAL';
       $user = 'sa';
       $pass = 'p@ssw0rd';     
   
    
  //  Conex�o com o banco de dados via ODBC; 

       $con = odbc_connect($banco, $user, $pass) or die("N�o foi poss�vel a conex�o com o servidor");
       
 

// if ($connexao  == "09.18.17"){
//    $con = "porta= 5432";   
// }
	   
  ?>
