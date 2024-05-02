<?php  

//Desativar erros
error_reporting(0);

//Arquivo de configura?o banco de dados
  require_once "../config/config.php";


    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");


    $sql = mysqli_query($conn,"SELECT nome, (DATEDIFF(CURDATE(), dat_entrada)) as dias FROM `internamento` where YEAR(dat_entrada)=".$ano." and dat_saida is null ORDER by dias DESC");

?>

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
            text: 'Gráfico Dias Internados'
        },
       
        xAxis: {
            categories: [

              <?php                   


              $x = 0;
		
            
                  while ($row = mysqli_fetch_object($sql)) {
			
                              
                       	echo "'". $row->nome."',"; 
                    
                         
                        $dias[$x] = $row->dias;

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
                text: 'Dias',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' dias'
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
            y: 5,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Internado',
            data: [

            <?php

                  foreach( $dias as $indice=> $valor){

                           echo $valor - 1 .",";
	                  
                  }

            ?>

            ]
        }]
    });
});
		</script>

<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>


