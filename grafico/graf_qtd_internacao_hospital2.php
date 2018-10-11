<!-- grafFunbdeb -->

<?php 


   // Arquivo de configuração
   require_once "../config/config.php";
            

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



     $query = mysqli_query($conn,"SELECT MONTH(dat_entrada) as mes, COUNT(*) FROM `internamento` GROUP BY mes) or die("erro ao selecionar");
     

     

                $i = 1;

                while($row = mysqli_fetch_array($query)){
        
                    $mes[$i] = $row['mes'];
                    $periodo[$i] = $row['periodo'];
                    $valor[$i] = $row['valor'];

                    $i++;
                }

     //Fechar conexao
     mysqli_close($conn);

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
            text: 'Receita'
        },
        subtitle: {
            text: 'Lançamento X Período'
        },
        xAxis: {
            categories: [

               //'Africa', 'America', 'Asia'
                <?php 

                 // Função array duplicidade
                    $result = array_unique($mes);

                        $x = end($result);

                    foreach ($result as $value) {  

                            if($x <> $value){    
                                    echo "'".$mes_extenso[$value]."',";
                            }else{
                                    echo "'".$mes_extenso[$value]."'";
                            }
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
                text: 'Valor R$',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' milhões'
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
            name: '10 dias',
            data:   [<?php

                            for ($x=1; $x < $i ; $x++) { 
                                
                                if ($periodo[$x] == 10) {
                                    echo $valor[$x].",";
                                }

                            }

                     ?>]



        }, {
            name: '20 dias',
            data: [<?php 
                            for ($x=1; $x < $i ; $x++) { 
                                
                                if ($periodo[$x] == 20) {
                                    echo $valor[$x].",";
                                }

                            }


                    ?>]
        }, {
            name: '30 dias',
            data: [<?php
                            for ($x=1; $x < $i ; $x++) { 
                                
                                if ($periodo[$x] == 30) {
                                    echo $valor[$x].",";
                                }

                            }


                    ?>]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="Highcharts-4.1.5/js/highcharts2.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 100%; height: 400px; margin: 0 auto"></div>

	</body>
</html>
