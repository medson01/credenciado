 <!-- Perguntar antes de excluir -->
<script language="Javascript">
function excluir(id,id_imagem,id_prorrogacao) {
     var resposta = confirm("Deseja remover esse registro?");
     
     if (resposta == true) {
          window.location.href = "imagem_excluir.php?id="+id+"&id_imagem="+id_imagem+"&id_prorrogacao="+id_prorrogacao;
     }
}
</script>

 <?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];
  
          $sql = "SELECT prorrogacao.medico_solicitante, prorrogacao.crm, prorrogacao.dias_solicitados, 
                               prorrogacao.motivo, prorrogacao.id as id_prorrogacao, prorrogacao.status, 
                               prorrogacao.id_internamento, prorrogacao.qtd_respiratoria, prorrogacao.qtd_motora
                        FROM internamento

                        INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id
                        WHERE prorrogacao.status <> 2 and internamento.id =".$id;

          $query = mysqli_query($conn,$sql) or die("erro ao carregar consulta");
                   
                  
                                while($registro = mysqli_fetch_row($query)){


                                  $medico_pro = $registro[0];
                                  $crm_pro = $registro[1];
                                  $dias_pro = $registro[2];
                                  $motivo_pro = $registro[3];
                                  $id_prorrogacao = $registro[4];
                                  $status = $registro[5];
                                  $id_internamento = $registro[6];
                                  $qtd_respiratoria = $registro[7];
                                  $qtd_motora = $registro[8];


                                

                             }
                    

                             require_once "internacao_prorrogacao_permissao.php";




                               

?> 

<!-- Esconde o que está dentro da div na impressão -->
<style type="text/css">
<!--
.text1 {
	font-size: 9px;
	font-style: italic;
}
.style2 {font-size: 9px; font-style: italic; color: #FF0000; }
-->
</style>


<div class="visible-print">
  <center>
<?php echo "Relatório de Prorrogações" ?>
  </center>
</div>

<div class="hidden-print">
								  
                        <table width="100% " border="0" align="center">
                          
                          <tr>
                              <td colspan="3" bgcolor="#CCCCCC">
                                <div align="center" class="style5">
                                  Documento digitalizado
                                </div>
                            </td>	
                         </tr>

                         <?php if(isset($aviso)){echo $aviso;} ?>

  </table>
<form id="formulario" name="formulario" enctype="multipart/form-data" action="imagem_upload.php" method="post"><br>
          <div>Descrição da imagem<br> 
          <input name="descricao" id ="descricao" type="text" class="form-control input-sm" value="Atesto de prorrogação" readonly="true"  >
    </div> 
          <br>
          <input name="evento" type="hidden"  value="int" />  
          <input name="id" type="hidden"  value="<?php echo $id; ?>" />  
          <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />


              <div><input name="imagem" type="file" class="form-control-file" required /></div>
          	<br>
              <div>
              <input type="submit" value="Adicionar Imagem" class="btn btn-primary "  <?php if( ($_SESSION["perfil"] == "medico")  || (isset($status)) ){ echo 'disabled'; } ?>   /></div>


</form>

</div>

<br />
<table border="1"  class="table table-bordered" >
    <tr style="font-size: 12px">
      <td colspan="12" align="center" class="info">Solicitações de prorrogação </td>
    </tr>
    <tr style="font-size: 10px">
   
      <td align="center">
            Id        </td>
        <td align="center">
            Data        </td>
        <td align="center">Dias Sol.</td>
        <td align="center">Dias Aut.</td>
        <td align="center">F.M.</td>
        <td align="center">F.R.</td>
        <td align="center">
            Medico solicitante        </td>  
        <td align="center">
            Motivo        </td>
        <td align="center">
             Imagem        </td>
        <td align="center">

             Status        </td>
        <td align="center">
             Obs.        </td>
        <td align='center'>
          </td>

    </tr>
    <?php

  	//Consulta imagem

    // resolver essa consulta Edson

   $querySelecao = "SELECT imagem.id as id_imagem, imagem.nome, imagem, prorrogacao.medico_solicitante, data, prorrogacao.id as id_prorrogacao, prorrogacao.medico_solicitante, prorrogacao.motivo, prorrogacao.motivo_medico, prorrogacao.status, prorrogacao.dias_solicitados, prorrogacao.dias_autorizados, prorrogacao.qtd_motora, prorrogacao.qtd_respiratoria  FROM imagem  LEFT JOIN prorrogacao on prorrogacao.id = imagem.id_prorrogacao WHERE imagem.id_internamento=".$id;
   $resultado = mysqli_query($conn, $querySelecao);
  
  

    while ($aquivos = mysqli_fetch_array($resultado, MYSQLI_ASSOC) ) { 
         
          $id_imagem = $aquivos['id_imagem'];
    ?>
    
    <tr style="font-size: 10px; text-align: justify">    
        <td align="center">
         <?php echo  $aquivos['id_prorrogacao']; ?>    </td>
    <td align="center">
        <?php echo date("j/n/Y,  H:i:s",strtotime($aquivos['data'])); ?>    
    </td>
    <td align="center">
       <div align="center"><?php echo $aquivos['dias_solicitados']; ?>          </div>   
    </td>
    <td >
      <div align="center"><?php echo $aquivos['dias_autorizados']; ?>          </div>
    </td>
    <td >
	<div align="center"><?php if(isset($aquivos['qtd_motora'])){ echo  $aquivos['qtd_motora'];}else{ echo "0";} ?>  </div>
    </td>
    <td ><div align="center"><?php if(isset($aquivos['qtd_respiratoria'])){echo  $aquivos['qtd_respiratoria'];}else{ echo "0"; } ?>  </div>
	</td>
    <td >
        <?php echo $aquivos['medico_solicitante']; ?>    </td>
   
    <td >
        <?php echo $aquivos['motivo']; ?>    </td>
        <td align="center">
     <!-- Campo Imagem --> 
        <?php 

        echo '<a class="hidden-print" href="imagem_exibir.php?id='.$aquivos['id_imagem'].'"  target="_blank">Imagem '.$aquivos["id_imagem"].'</a>'; 

        echo '<span class="visible-print">Imagem '.$aquivos["id_imagem"].'</span>';
        ?>    </td>
      <td align="center">
      <!-- Campo Autorização --> 
        <?php
	/* 
            if( $aquivos['status'] == 1 ){ 
              echo "Em an&aacute;lise"; 
            }elseif (is_null($aquivos['status'])){
              echo "";
            }elseif ($aquivos['dias_autorizados'] == 0){
              echo "<strong style='color: #FF4000' > Glosado </strong>";  
	     }elseif ( ($aquivos['dias_autorizados'] <> 0) && ($aquivos['dias_autorizados'] <> $aquivos['dias_solicitados']) ){
              echo "<strong style='color: #008000' > Parcialmente autorizado </strong>";
            }else {           
              echo "<strong style='color: #008000' > Autorizado </strong>";
            }
	*/
            if( $aquivos['status'] == 1 ){ 
              echo "<strong> Em an&aacute;lise </strong>"; 
            }elseif (is_null($aquivos['status'])){
              echo "";
            }else {           
              echo "<strong style='color: #008000' > Autorizado </strong>";
            }

        ?>       
	</td>
        <td >
          <!-- Campo Obs --> 
            <?php echo $aquivos['motivo_medico']; ?>    
        </td>
        <td class="hidden-print" align="center">
    <?php

                  if( ($aquivos['status'] == 1)  && ($_SESSION["perfil"] <> "medico")){   
                    echo '<a   class="hidden-print" onclick="excluir('.$id.','.$aquivos['id_imagem'].','.$aquivos['id_prorrogacao'].' )"> 
                           <button type="button" class="btn btn-danger glyphicon glyphicon-remove"></button> </a>';
                   }

    ?>
    </td>
   <!--  <td class="hidden-print" align="center"> Imagem '.$aquivos['id_imagem'].'</tr>  -->
</tr>
    <?php 
            $w = $aquivos['id_prorrogacao'];
              } ?>


</table>
     
      <span class="style2">*F.M.: Fisioterapia Motora<br />
                           &nbsp; F.R.: Fisioterapia Respitarória </span><br />
       <center>

        <button style="right: all;" class="btn btn-default glyphicon glyphicon-print hidden-print" onclick="javascript:print();"> Imprimir </button>
      </center> 
<br>
<?php
         
          If(empty($w)){
          echo "<div class='alert alert-warning' style='text-align:center'>
                                    É necessário preencher os dados abaixo para que a solicitação seja atendida.
                   
                </div>";
        }
?>
