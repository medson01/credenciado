 <?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];
  
          $sql = "SELECT  prorrogacao.medico_solicitante, prorrogacao.crm, prorrogacao.dias_solicitados, 
                               prorrogacao.motivo, prorrogacao.id as id_prorrogacao, prorrogacao.status
                        FROM internamento

                        INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id

                        WHERE internamento.id =".$id;

          $query = mysqli_query($conn,$sql) or die("erro ao carregar consulta");
                   
                                while($registro = mysqli_fetch_row($query)){


                                  $medico_pro = $registro[0];
                                  $crm_pro = $registro[1];
                                  $dias_pro = $registro[2];
                                  $motivo_pro = $registro[3];
                                  $id_prorrogacao = $registro[4];
                                  $status = $registro[5];
                                   
                             }
                    

                                 if(isset($status)){
                                  switch ($status) {
                                    case '1':


                                         if(($_SESSION["perfil"] == "medico")){ 
                                         echo '  <br>  <div class="panel with panel-danger class ">
                                                  <div class="panel-heading">
                                                   Aguardando aprovação.  
                                                  </div>
                                                        
                                              </div>';
                                         }else{

                                         echo '  <br>  <div class="panel with panel-danger class ">
                                                  <div class="panel-heading"> Prorrogação já solicitada, 
                                                   aguardando aprovação.  </div>
                                                        
                                              </div>';
                                         }

                                      break;
                                    
                                    case '2':
                                         echo '  <br>  <div class="panel with panel-info class ">
                                                  <div class="panel-heading"> Não há prorrogações.  </div>
                                                        
                                              </div>';

                                      break;
                                  }
                                }

                               

                                  ?> 
  
<form enctype="multipart/form-data" action="imagem_upload.php" method="post">
<div>Internação/PA <br> <input name="evento" type="text"/></div>
<div>Descrição do exame (imagem)<br> <input name="descricao" type="textarea"/></div>    
<input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
    <div><input name="imagem" type="file"/></div>
    <div><input type="submit" value="Salvar"/></div>
</form>
<br />
<table border="1">
    <tr>
        <td align="center">
            Código
        </td>
        <td align="center">
            Evento
        </td>
        <td align="center">
            Descrição
        </td>
        <td align="center">
            Nome da imagem
        </td>
        <td align="center">
            Tamanho
        </td>
        <td align="center">
            Visualizar imagem
        </td>
<td align="center">
            Excluir imagem
        </td>
    </tr>
    <?php

    // Arquivo de configuração
  require_once "../config/config.php";
  
    $querySelecao = "SELECT id, nome, evento, descricao, tamanho, tipo, imagem FROM imagem";
    $resultado = mysqli_query($conn, $querySelecao);
  	
    while ($aquivos = mysqli_fetch_array($resultado, MYSQLI_ASSOC) ) { ?>
    <tr>    
        <td align="center">
        <?php echo $aquivos['id']; ?>
    </td>
        <td align="center">
        <?php echo $aquivos['evento']; ?>
    </td>
        <td align="center">
        <?php echo $aquivos['descricao']; ?>
    </td>
        <td align="center">
        <?php echo $aquivos['nome']; ?>
    </td>
        <td align="center">
        <?php echo $aquivos['tamanho']; ?>
    </td>
        <td align="center">
        <?php echo '<a href="imagem_exibir.php?id='.$aquivos['id'].'"  target="_blank">Imagem '.$aquivos["id"].'</a>'; ?>
    </td>
    <td align="center">
        <?php echo '<a href="imagem_excluir.php?id='.$aquivos['id'].'">Imagem'.$aquivos['id'].'</a>'; ?>
    </td>
</tr>
    <?php } ?>
</table>
