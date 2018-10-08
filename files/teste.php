<!-- <html>
    <head>
        <script language="javascript"> 
            var num;
            do{
            num = prompt ("digite um valor maior que 5:");
        }while (num <= 5)
          alert ("O valor digitado maior que 5 foi: " +num);
        </script>
    <head>
    <body></body>
</html>
-->


<?php

	include "../config/config.php";

	   $query = mysqli_query($conn,"SELECT internamento.id as autorizacao, internamento.nome as paciente, internamento.matricula as matricula, internamento.solicitante as solicitante, internamento.crm as crm, internamento.dat_entrada as dat_entrada, internamento.dat_saida as dat_saida , cid.cid ,usuarios.nome as credenciado, cid.dias as dias FROM `internamento` INNER JOIN usuarios on usuarios.id = internamento.id_usuario INNER JOIN cid on cid.id = internamento.id_cid WHERE internamento.dat_saida = '00000-00-00' or (Month(internamento.dat_entrada) = ".date("m")." and Year(internamento.dat_entrada) = ".date("Y").") order by internamento.id") or die("erro ao carregar consulta");

$i = 0;
                 
                  while($registro = mysqli_fetch_assoc($query)){
                         
                      
                  						echo $dat_entrada[$i] = date("Y-n-j",strtotime($registro["dat_entrada"]))."<br>";
                        

                                      	echo date("j/n/Y", strtotime(date("Y-n-j",strtotime($registro["dat_entrada"]))."+1 days"))."<br>";

                                                     



                                 echo $i++;
                     }



?>