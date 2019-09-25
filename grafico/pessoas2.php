<?php

//Arquivo de configuração banco de dados
  require_once "../config/config.php";


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
            type: 'bar',
			style: {
            	fontSize: '10px' // Aummenta a fonto da legenda "Quandidade de pessoas" na barra
        	}

        },
        title: {
            text: 'Quantitativos de pessoas ativas',
			style: {
            	fontSize: '25px'
        	}
        },
        //subtitle: {
        //    text: 'Ipaseal Saude'
        //},
        xAxis: {
            categories: [
<?php

		/*
			  Contrato_contrato.ativo / Contrato_contrato.bloqueado
							V					V					=> 			ATIVO
							V					F					=> 			BLOQUEADO (continua pagando)
							F					V					=> 			CANCELADO
							F					F					=>			CANCELADO

        
		*/
        if(!isset($_SESSION["pessoas_ativas"])){                        
        //TOTAL DE PESSOAS ATIVAS / CONTRATO ATIVO/ COM ODONTOL�GICO
        $sql=myslq_query($conn,"select MONTH(dat_entrada) as mes, COUNT(*) as Qtd from pronto_atendimento GROUP by mes
");
		
		
     
        //Fechar conexao
		mysqli_close($conn);
        
        
        
        //TESTE DE CONSULTA
        if (!$sql) {
        echo "Erro na consulta <br>";
        }
        
		
        while( $row = pg_fetch_array( $sql ) ) {
        $_SESSION["comodonto"] = $row [0] ;
        }
	    
        }
       //$pessoas_ativas = $pessoas_ativas + $agregado;
			
        $ressult =  $_SESSION["semodonto"];

        foreach($ressult as $indice=> $valor){
			
?>
			
			['<?php echo $indice ?>'],
			
<?php
}
?>
			
			],
            title: {
                text: null
            },
			labels: {
                overflow: 'justify',
				 style: {
				 	fontSize: '18px' //Aumenta a fonte dos valores da escala Y no grafico
				 }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Pessoas(Qtd)',
                align: 'high'
            },
            labels: {
                overflow: 'justify',
				style: {
				 	fontSize: '14px' //Aumenta a fonte dos valores da escala no grafico
				}
            }
        },
        tooltip: {
            valueSuffix: 'pessoas'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
					style: {
            			fontSize: '15px' //Aumenta o tamanho da fonte do valor na barra
        			}
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 300,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'total',
            data: [
			<?php
            
            // VALOR DO GRAFICO                       
            foreach($ressult as $indice=> $valor){	
                                
            ?>
            			
			[<?php echo $valor ?>],
		
<?php
}
?>			
			]
        }]
    });
});
		</script>
	</head>
	<body style="zoom:80%;">
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 1000px; height: 350px; margin: 0 auto"></div>
<br>

	</body>
</html>
