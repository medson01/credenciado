<div class="hidden-print">
  <style type="text/css">
<!--
.style3 {color: #000000}
.style5 {color: #000000; font-weight: bold; }
.style13 {font-size: 10px}

input[type=checkbox]
{
  /* Tamanho checkbox */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 8px;
}

-->
                     </style>

					 </p>
			
				<button type="button" onclick="alterar()" class="btn btn-primary" style="width:87px"> Alterar </button>  
							 
					 
<?php  
	if($_SESSION["perfil"] <> "callcenter"){
 		echo '<a href="painel.php?proc"> 
				<button type="button" class="btn btn-primary" style="width:87px"> Novo </button>  
			  </a>';
		}
?>                      
  <br />
  <br />
<div align="center">
					  
<?php  

 require_once "../func/calc_idade.php";
 
 function unid_periodo ($valor){
	
	switch ($valor) {
		case 1:
			$unid = "dia(s)";
			break;
		case 2:
			$unid =  "mês(es)";
			break;
		case 3:
			$unid =  "ano(s)";
			break;
	}
 return $unid;
}
 

 if(isset($_GET['id'])){
 	$sql = "SELECT * FROM `procedimento` WHERE ID = ".$_GET['id'];
 	$stmt = $pdo->prepare($sql);
    $stmt->execute();
	 
	while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){     					
                      $id = $registro["id"];
					  $id_tabela = $registro["id_tabela"];
					  $codigo = $registro["codigo"];
					  $descricao = $registro["descricao"];
					  $carencia = $registro["carencia"];
					  $unid_carencia = $registro["unid_carencia"];
					  $quantidade = $registro["quantidade"];
					  $unid_quantidade = $registro["unid_quantidade"];
					  $periodicidade = $registro["periodicidade"];
					  $unid_periodicidade = $registro["unid_periodicidade"];
					  $valor_tabela = $registro["valor_tabela"];
					  $valor_cobrado = $registro["valor_cobrado"];
					  $complexidade = $registro["complexidade"];
					  $bloqueio = $registro["bloqueio"];
					  $observacao = $registro["observacao"];
								  								       				     		 
   		}
		$desativar = "readonly";
	}


             
					    
?>				
    <form name="procedimento" id="procedimento" action ="procedimento/procedimento_update.php" method="POST" data-parsley-validate class="form-horizontal form-label-left">
        <table width="100% " border="0" align="center">
                          
                            <tr>
                              <td colspan="3" bgcolor="#CCCCCC">
                                <div align="center" class="style5"> 
                              <div align="center"> Procedimento </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Código<br />
                                  <input name="codigo" id ="codigo" type="text" class="form-control input-sm" style="font-size: 10px" size="44" maxlength="8" required="required" <?php if (isset($codigo)) { echo "value='".$codigo." ' "; }  if(isset($desativar)){ echo $desativar;} ?>/>
                                  </span></td>
                              <td>&nbsp;</td>
                              <td>Data de inclusão <br />
                                  <input name="data_proc" id ="data_proc" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($data_proc)) { echo "value='".date('d / m / Y, H:i:s\h\s', strtotime($data_proc))."' "; }  if(isset($desativar)){ echo $desativar;} ?>/>
                                  </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3">Descrição <br />
                                <input name="descricao" id ="descricao" type="text" class="form-control input-sm" style="font-size: 10px" required="required" <?php if (isset($descricao)) { echo "value='".$descricao."' "; }  if(isset($desativar)){ echo $desativar;} ?>/>
                                </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Tabela<br />
                                <select nome="id_especialidade" id="id_especialidade" class="form-control input-sm"   required="required" <?php if(isset($desativar)){ echo 'disabled';}?> >
                                  <?php 

  $sql = "SELECT * FROM `tabela` ORDER BY `tabela`.`nome` ASC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){  
     echo' <option value="'.$registro["id"].'"';
     if( isset($id_tabela) && $registro["id"] == $id_tabela ){
       echo 'selected'; 
     } 
     echo '>';
     echo $registro["nome"].'</option>';

     
    }
$data_aut  = isset($_POST["data_aut"]) ? $_POST["data_aut"]: 'null';
?>
                                </select>
                              </span></td>
                              <td>&nbsp;</td>
                              <td><br />                                
                              </span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" bgcolor="#CCCCCC"><div align="center" class="style5">
                                  <div align="center"> Regras </div></td>
                            </tr>
                            <tr>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td bgcolor="#1ce6e6" >Carência<br />
                                <input id="carencia"  name="carencia" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php if (isset($carencia)) { echo "value='".$carencia."' "; }   if(isset($desativar)){ echo $desativar;} ?> /></td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">Unidadede<br />
							  <select id="unid_carencia" name="unid_carencia"class="form-control input-sm"    required="required" <?php if(isset($desativar)){ echo 'disabled';}?> >
                                  <option value="1" <?php if(isset($unid_carencia) && $unid_carencia == 1){echo 'selected';} ?> >Dia</option>
								  <option value="2" <?php if(isset($unid_carencia) && $unid_carencia == 2){echo 'selected';} ?> >Mês</option>
								  <option value="3" <?php if(isset($unid_carencia) && $unid_carencia == 3){echo 'selected';} ?> >Ano</option>
							 </select>
							</td>
                            </tr>
                            <tr>
                              <td bgcolor="#1ce6e6" >&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#1ce6e6" >Periodicidade<br />
                                <input name="periodicidade" id ="periodicidade" type="text" class="form-control input-sm" style="font-size: 10px" size="44" required="required" <?php if (isset($periodicidade)) { echo "value='".$periodicidade."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">Unidadede<br />
                             <select id="unid_periodicidade" name="unid_periodicidade"class="form-control input-sm"    required="required" <?php if(isset($desativar)){ echo 'disabled';}?> >
                                  <option value="1" <?php if(isset($unid_periodicidade) && $unid_periodicidade == 1){echo 'selected';} ?> >Dia</option>
								  <option value="2" <?php if(isset($unid_periodicidade) && $unid_periodicidade == 2){echo 'selected';} ?> >Mês</option>
								  <option value="3" <?php if(isset($unid_periodicidade) && $unid_periodicidade == 3){echo 'selected';} ?> >Ano</option>
							 </select>    
							</td>
                            </tr>
                            <tr>
                              <td bgcolor="#1ce6e6" >&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td bgcolor="#1ce6e6" >Quantidade de vezes utilizado <br />
                                <input name="quantidade" id ="quantidade" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($quantidade)) { echo "value='".$quantidade."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">Unidadede<br />
                              <select id="unid_quantidade" name="unid_quantidade"class="form-control input-sm"    required="required" <?php if(isset($desativar)){ echo 'disabled';}?> >
                                  <option value="1" <?php if(isset($unid_quantidade) && $unid_quantidade == 1){echo 'selected';} ?> >Dia</option>
								  <option value="2" <?php if(isset($unid_quantidade) && $unid_quantidade == 2){echo 'selected';} ?> >Mês</option>
								  <option value="3" <?php if(isset($unid_quantidade) && $unid_quantidade == 3){echo 'selected';} ?> >Ano</option>
							 </select>    </td>
                            </tr>
                            <tr>
                              <td bgcolor="#1ce6e6" >&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#1ce6e6" >&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                              <td bgcolor="#1ce6e6">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" bgcolor="#CCCCCC"><div align="center" class="style5">
                                  <div align="center"> Definição</div></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Valor Tabela<br />
                                  <input name="valor_tabela" id ="valor_tabela" type="number" step="0.010" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($valor_tabela)) { echo "value='".$valor_tabela."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
                              <td>&nbsp;</td>
                              <td>Valor Cobrado<br />
                                  <input name="valor_cobrado" id ="valor_cobrado" type="number" step="0.010" class="form-control input-sm" style="font-size: 10px" size="44"  <?php if (isset($valor_cobrado)) { echo "value='".$valor_cobrado."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Grau de Complexidade<br />
                                <select id="complexidade" name="complexidade"class="form-control input-sm"    required="required" <?php if(isset($desativar)){ echo 'disabled';}?> >
                                  <option value="baixa" <?php if(isset($complexidade) && $complexidade == "baixa"){echo 'selected';} ?> >Baixa</option>
								  <option value="media" <?php if(isset($complexidade) && $complexidade == "media"){echo 'selected';} ?> >Mádia</option>
								  <option value="alta" <?php if(isset($complexidade) && $complexidade == "alta"){echo 'selected';} ?> >Alta</option>
                                </select>
                                </span></td>
                              <td>&nbsp;</td>
                              <td>Bloqueado <br />
&nbsp;
							<div align="center">
<input type="checkbox" name="bloqueio" id="bloqueio" disabled="disabled"
								<?php
      									if (isset($bloqueio) ) {
      										if( $bloqueio == 1 ){
      											echo " value='1' checked ";
      										}else{ echo " disabled"; }
      									}
								?> />
							</div>
							</td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td colspan="3" >Observações sobre o procedimento
                                <textarea minlength="5" id="observacao" class="form-control input-sm" name="observacao"  style="text-align:left; font-size:12px; margin: 0px; height: 100px; width: 100%;" form="procedimento" <?php if(isset($desativar)){ echo $desativar; } ?> />
										<?php
											if(isset($observacao)){
											  echo $observacao;
											}
                                        ?></textarea>   							  </td>
                          </tr>
                        <tr>
                          <td colspan="3" >                              </td>
          </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
       </table>

      <table width="100% " border="0" align="center" > 
              <tr>
                         <td >&nbsp;</td>
                         <td>&nbsp;</td>
                         <td><div align="right"><strong>
                              <input name="id" type="hidden" value="<?php echo $id; ?>" />
                              <input name="id_imagem" type="hidden" value="<?php echo $id_imagem; ?>" />
                              <input name="id_prorrogacao" type="hidden" value="<?php echo $id_prorrogacao; ?>" />
                            
                              <?php 
 

                                   if( $_SESSION["perfil"] == "medico" ){

                                      if(isset($medico_pro)){
                                         echo " <input name='submit' type='submit' value='Confirmar' class='btn btn-primary '   />";
                                      }


                                    }else{

                                      if(!(isset($status))){

                                            echo " <input id='Confirmar' name='submit' type='submit' value='Confirmar' class='btn btn-primary '  />";
									
										   
                                      }else{

                                          echo " <input id='Confirmar' name='submit' type='submit' value='Confirmar' class='btn btn-primary ' disabled />";
										   
                                        }

                                    }


                              ?>

                              

                            </strong></div></td>
        </tr>

</table>



  </div>

                </form>
</div>

<script>
	function alterar() {

		document.getElementById("carencia").readOnly = false;
		document.getElementById("unid_carencia").disabled = false;
		document.getElementById("periodicidade").readOnly = false;
		document.getElementById("unid_periodicidade").disabled = false;
		document.getElementById("quantidade").readOnly = false;
		document.getElementById("unid_quantidade").disabled = false;
		document.getElementById("periodicidade").readOnly = false;
		document.getElementById("valor_tabela").readOnly = false;
		document.getElementById("valor_cobrado").readOnly = false;
		document.getElementById("observacao").readOnly = false;
		document.getElementById("complexidade").disabled = false;
		document.getElementById("bloqueio").disabled = false;
		document.getElementById("Confirmar").value = "Enviar";
	}
</script>
             
          
  