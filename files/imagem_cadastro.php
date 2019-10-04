 <?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];
  
          $sql = "SELECT  prorrogacao.medico_solicitante, prorrogacao.crm, prorrogacao.dias_solicitados, 
                          prorrogacao.motivo, prorrogacao.id as id_prorrogacao, prorrogacao.status
                        FROM internamento

                        INNER JOIN prorrogacao on prorrogacao.id_internamento = internamento.id
						INNER JOIN imagem on imagem.id_internamento = internamento.id

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
                                                   <center> Aguardando aprovação.  </center>
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

								  
                        <table width="100% " border="0" align="center">
                          

                              <td colspan="3" bordercolor="#999999" bgcolor="#999999"><div align="center" class="style5">Prorrogar Internação</div></td>								  
  					     </table>
<form enctype="multipart/form-data" action="imagem_upload.php" method="post"><br>
<div>Descrição da imagem<br> 
<input name="descricao" id ="descricao" type="text" class="form-control input-sm" value="Atesto de prorrogação" readonly="true"  >
    </div> 
<br>
<input name="evento" type="hidden"  value="int" />  
<input name="id" type="hidden"  value="<?php echo $id; ?>" />  
<input type="hidden" name="MAX_FILE_SIZE" value="99999999" />


    <div><input name="imagem" type="file" class="form-control-file"/></div>
	<br>
    <div>
      <input type="submit" value="Adicionar Imagem" class="btn btn-primary "  <?php if($_SESSION["perfil"] == "medico"){ echo 'disabled'; } ?>   /></div>
</form>
<br />
<table border="1"  class="table table-bordered" >
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
        <?php
        if(!($_SESSION["perfil"] == "medico")){
          echo "<td align='center'>
            Excluir imagem
          </td>";
        }
        ?>
        
    </tr>
    <?php

  	//Consulta imagem
    $querySelecao = "SELECT id, nome, evento, descricao, tamanho, tipo, imagem FROM imagem where id_internamento=".$id;
    $resultado = mysqli_query($conn, $querySelecao);
  	
    while ($aquivos = mysqli_fetch_array($resultado, MYSQLI_ASSOC) ) { ?>
    <tr>    
        <td align="center">
        <?php echo $aquivos['id']; ?>
    </td>
        <td align="center">
        <?php 
            switch ($aquivos['evento']) {
              case 'int':
                echo "Prorrogação internamento";
                break;
              
              case 'pa':
                echo "Exame Pronto Atendimento";
                break;
            }
              
        ?>
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
    <?php
        if(!($_SESSION["perfil"] == "medico")){
              echo '<td align="center">
                    <a href="imagem_excluir.php?id='.$aquivos['id'].'">Imagem'.$aquivos['id'].'</a>
              </td>';
        }
    ?>
</tr>
    <?php } ?>
</table>

<br>
