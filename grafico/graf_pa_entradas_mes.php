<?php  

//Desativar erros
error_reporting(0);

//Arquivo de configuração banco de dados
  require_once "../config/config.php";

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");


    $sql = mysqli_query($conn,"

SELECT paciente, matricula, COUNT(matricula) as qtd FROM (SELECT pronto_atendimento.matricula as matricula, pronto_atendimento.nome as paciente, pronto_atendimento.dat_entrada as dat_entrada FROM `pronto_atendimento` INNER JOIN usuarios on usuarios.id = pronto_atendimento.id_usuario INNER JOIN credenciado on credenciado.id = usuarios.id_credenciado) as TABELA WHERE MONTH(dat_entrada) = '8' AND YEAR(dat_entrada)=".$ano." GROUP by matricula ORDER BY qtd DESC LIMIT 10"

);

    mysqli_close($conn);   




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





?>

  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<table width="435" align="center" class="table table-sm" style="font-size: 9px">
               <tr>
                 <td colspan="12" style="text-align: center; text-decoration-style: solid;"> <strong> Os 10 pacientes que tiveram mais de uma entradas mês <?php echo $mes; ?>  </strong></td>
               </tr>
               <tr  style='font-weight:bold;'>
                 <!-- <td width="27"><div align="center">Status</div></td> -->
                 <td ><div align='left' >Paciente</div></td>
                 <td ><div align="right">Matrícula</div></td>
                 <td ><div align="right">Quantidade</div></td>
                 
              
</tr>
<?php

            while($registro = mysqli_fetch_assoc($sql)){
                         

                         echo     "<tr>
                                    <td ><div align='left'>".$registro["paciente"]."</div></td>
                                    <td ><div align='right'>".$registro["matricula"]."</div></td>
                                    <td ><div align='right'>".$registro["qtd"]."</div></td>
                                     <td >
                                      <div align='center'>

                                    </tr>";

          }                        

?>
</table>