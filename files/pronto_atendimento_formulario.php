
<script>
function pegarMatricula() {

  var matric = document.getElementById("matricula").value;
  var pa = 1;

  window.location.href = "verficar_matricula.php?pa="+pa+"&matric="+matric;

  //alert("The input value has changed. The new value is: " + matric);
}
</script>


<?php
// Modal Biometria
if(isset($_GET['matricula'])){ 
  echo"  <script type='text/javascript' src='../js/modal_sair.js'></script>";
}
?>



<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>

<?php
 function calc_idade($nascimento) {
            $nascimento = date("d/m/Y", strtotime($nascimento));
            $nascimento=date($nascimento);
            $nascimento=explode('/',$nascimento); //Cria um array com os campos da data de nascimento  
            $data=date('d/m/Y'); 
            $data=explode('/',$data); //Cria um array com os campos da data atual 
            $anos=$data[2]-$nascimento[2]; //ano atual - ano de nascimento 
            if($nascimento[1] > $data[1]){
               return $anos-1;
            } //Se o mês de nascimento for maior que o mês atual, diminui um ano 
            if($nascimento[1] == $data[1]){ 
            //se o mês de nascimento for igual ao mês atual, precisamos ver os dias 
                  if($nascimento[0] <= $data[0]) {
                      return $anos; 
                  }else{
                      return $anos-1; 
                  }
            }
              
          return $anos; 
        
}

?>

                     <form name="atendiemtno" id="atendimento" action ="pronto_atendimento_cadastro.php" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      <label> </label>
                      <div align="center">
                        </p>
                        <table width="625" border="0" align="center">
                          <tr>
                            <td width="212" >Matr&iacute;cula</td>
                            <td width="403">
                            <input required="required" type="text" name="matricula" minlength="16" class="form-matric" id="matricula" size="20" maxlength="16"placeholder="00000000.000000.00" onchange="pegarMatricula()" <?php if(isset($_GET['matricula'])){ echo "value=".$_GET['matricula'];} ?> ></td>
                          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Nome</td>
                              <td><input  id="nome" name="nome" readonly="readonly" class="form-control col-md-7 col-xs-12" required="required"  size="60" <?php if(isset($_GET['nome'])){ echo "value='".$_GET['nome']."'";} ?> ></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style3">Data de nascimento </span></td>
                              <td><input required="required" type="text" name="data_nascimento" minlength="16" class="form-control col-md-7 col-xs-12" id="data_nascimento"  readonly="readonly" <?php if(isset($_GET['data_nascimento'])){ echo "value=".date("d/m/Y", strtotime($_GET['data_nascimento']));} ?> /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style3">Idade</span></td>
                              <td><input required="required" type="text" name="idade" minlength="16" class="form-control col-md-7 col-xs-12" id="idade"   readonly="readonly" <?php if(isset($_GET['data_nascimento'])){ echo "value=".calc_idade($_GET['data_nascimento']);} ?> /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style3">Deficiente</span></td>
                              <td><input type="checkbox" name="deficiente" class="form-check-input" onclick="return false;" 
								<?php

										if( $_GET['deficiente'] == 1 ){
											echo " value='1' checked ";
										}else{
											echo " value='0' ";
										
										}
								
								?> /></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style3">Contato</span></td>
                              <td><input required="required" type="text" name="contato"  class="form-control col-md-7 col-xs-12" id="contato"   /></td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>
                            <td >Motivo do atendimento </td>
                            <td>
                              <textarea required class="form-matric" name="motivo"  style="margin: 0px; height: 100px; width: 100%;" form="atendimento" ></textarea>                            </td>
                            </tr>
                            <tr>
                            
                            <td></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >Médico atendente Dr(a)</td>
                            <td><input name="medico" class="form-matric" id="medico" size="60"  minlength="4" required="required" placeholder="Digite o nome do médico atendente"/></td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td><div align="right" class="style3">
                              <div align="right">
                                <strong>

                                <input type="hidden" id="id_usuario" name="id_usuario" <?php if(isset($_SESSION["id"])){ echo "value=".$_SESSION["id"];} ?>>
								                  
                                <?php 

                                echo $id_usuario;
                                
                                ?>

								                <input type="hidden" id="id_beneficiarios" name="id_beneficiarios" <?php if(isset($_GET['id_beneficiarios'])){ echo "value=".$_GET['id_beneficiarios'];}  ?>>

                                <input name="submit" type="Submit" value="Cadastrar" class="btn btn-primary "/> 
                                </strong>                              </div>
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2" >&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2" ><div align="center"><img src="../imagem/alarme.png" width="30" height="30" /> Atenção:</div></td>
                          </tr>
                          <tr>
                            <td colspan="2" >&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2" ><p align="justify" class="style1">Caro credenciado, é considerado pronto atendimento a permanencia de 12 horas do usuário do plano no hospital.</p>
                            <p align="justify" class="style1">Caso o mesmo necessite permanecer além do prazo, o atendente deverá cadastrá-lo  no sistema de internação, através do botão internação.</p></td>
                          </tr>
                        </table>
                        <p>&nbsp;</p>
                        <p align="justify"><br /> 
                          <br />
                        </p>
                       </div>
	
                        <br />
                        <br /> 
                      
                      <div align="center"><br />
                        <br />
                        <br />
                        <br />
                      
                        <br />
                        <br />
                        <br />
                      </div>
                    </form>

                

  <?php

  //  Acesso Modal Biometria
   if(isset($_GET['matricula'])){
      include("modal_biometria.php");
  }
  ?>
  
 