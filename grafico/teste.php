<?php  

//Arquivo de configuração banco de dados
  require_once "../config/config.php";


    $query = mysqli_query($conn,"select MONTH(dat_entrada) as mes, COUNT(*) as qtd from pronto_atendimento GROUP by mes
");

    mysqli_close($conn);   

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");


      // Mes por extenso
      $mes_extenso = array(
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro');

      $x = 0;
            
                  while ($row = mysqli_fetch_object($query)) {

                                    
                        echo "'".$row->mes."',"; 
                        
                         
                        $qtd[$x] = $row->qtd;

                        $x++;
                     }


                 foreach( $qtd as $indice=> $valor){
   
                                        echo "'".$valor."',10";
                               
                  }

?>
