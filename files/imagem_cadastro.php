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

<div class="visible-print">
  <center>
<?php echo "Relatório de Prorrogações" ?>
  </center>
</div>

<div class="hidden-print">
								  
                        <table width="100% " border="0" align="center">
                          
                          <tr>
                              <td colspan="3" bordercolor="#999999" bgcolor="#999999">
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
   
      <td align="center">
            Id
        </td>
        <td align="center">
            Data da solicitação
        </td>
        <td align="center">
            Medico solicitante
        </td>  
        <td align="center">
            Motivo Solicitação
        </td>
        <td align="center">
             Imagem
        </td>
        <td align="center">

             Status
            
        </td>
        <td align="center">
             Obs.
            
        </td>
        <?php
       if( $_SESSION["perfil"] == "administrador" ){
          echo "<td align='center'>
            Excluir imagem
          </td>";
        }
        ?>
        
    </tr>
    <?php

  	//Consulta imagem

    // resolver essa consulta Edson

   $querySelecao = "SELECT imagem.id as id_imagem, imagem.nome, imagem, prorrogacao.medico_solicitante, data, prorrogacao.id as id_prorrogacao, prorrogacao.medico_solicitante, prorrogacao.motivo, prorrogacao.motivo_medico, prorrogacao.status  FROM imagem  LEFT JOIN prorrogacao on prorrogacao.id = imagem.id_prorrogacao WHERE imagem.id_internamento=".$id;
   $resultado = mysqli_query($conn, $querySelecao);
  
  

    while ($aquivos = mysqli_fetch_array($resultado, MYSQLI_ASSOC) ) { 
         
          $id_imagem = $aquivos['id_imagem'];
    ?>
    
    <tr style="font-size: 11px; text-align: justify">    
        <td align="center">
         <?php echo  $aquivos['id_prorrogacao']; ?>
    </td>
    <td align="center">
        <?php echo date("j/n/Y,  H:i:s",strtotime($aquivos['data'])); ?>
    </td>
    <td >
        <?php echo $aquivos['medico_solicitante']; ?>
              
        
    </td>
   
    <td >
        <?php echo $aquivos['motivo']; ?>
    </td>
        <td align="center">
     <!-- Campo Imagem --> 
        <?php 

        echo '<a class="hidden-print" href="imagem_exibir.php?id='.$aquivos['id_imagem'].'"  target="_blank">Imagem '.$aquivos["id_imagem"].'</a>'; 

        echo '<span class="visible-print">Imagem '.$aquivos["id_imagem"].'</span>';
        ?>

        
    </td>
      <td align="center">
      <!-- Campo Autorização --> 
        <?php 
            if( $aquivos['status'] == 1 ){ 
              echo "Em análise"; 
            }elseif (is_null($aquivos['status'])) 
            {
              echo "";
            }else { 
              
               echo "<strong style='color: #FF4000' > Autorizado </strong>";
            }
        ?>

      </td>
        <td >
          <!-- Campo Obs --> 
            <?php echo $aquivos['motivo_medico']; ?>


    </td>
    <?php
        if( $_SESSION["perfil"] == "administrador") {
         
              echo '<td class="hidden-print" align="center">
                    <a   href="imagem_excluir.php?id='.$id.'&id_imagem='.$aquivos['id_imagem'].'">Imagem'.$aquivos['id_imagem'].'</a>
              </td>';

              echo '<td class="visible-print" align="center"> Imagem '.$aquivos['id_imagem'].'</tr>';
        
        }


    ?>
</tr>
    <?php 
            $w = $aquivos['id_prorrogacao'];
              } ?>
</table>
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
