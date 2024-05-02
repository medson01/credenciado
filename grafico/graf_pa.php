<?php  

//Desativar erros
error_reporting(0);

//Arquivo de configura?o banco de dados
  require_once "../config/config.php";


    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");


    $query = mysqli_query($conn,"select MONTH(dat_entrada) as mes, COUNT(*) as qtd from pronto_atendimento where YEAR(dat_entrada)=".$ano." GROUP by mes
");

     



      // Mes por extenso
      $mes_extenso = array(
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Mar?',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro');



?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Gráfico Pronto Atendimento'
        },
       
        xAxis: {
            categories: [

              <?php                   


              $x = 0;
		
            
                  while ($row = mysqli_fetch_object($query)) {
			
                              
                       	echo "'". $mes_extenso[$row->mes]."',"; 
                    
                         
                        $qtd[$x] = $row->qtd;

                        $x++;
                     }


 
               ?>

            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'atendimentos',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' atendimentos'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 40,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '<?php  echo $ano; ?>',
            data: [

            <?php

                  foreach( $qtd as $indice=> $valor){

                           echo $valor.",";
	                  
                  }

            ?>

            ]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

<br>
<br>
<br>
<br>

<?php
    require_once("graf_pa_entradas_mes.php");
?>



	</body>
</html>
