
<script>
function pegarMatricula() {

  var matric = document.getElementById("matricula").value;
  var pa = 1;

  window.location.href = "verficar_matricula.php?pa="+pa+"&matric="+matric;

  //alert("The input value has changed. The new value is: " + matric);
}
</script>

<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>

                     <form name="atendiemtno" id="atendimento" action ="pronto_atendimento_cadastro.php" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      <label> </label>
                      <div align="center">
                        </p>
                        <table width="549" border="0" align="center">
                          <tr>
                            <td width="179" >Matr&iacute;cula</td>
                            <td width="360">
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
                            <td >Motivo do atendimento </td>
                            <td>
                              <textarea class="form-matric" name="motivo"  style="margin: 0px; height: 100px; width: 100%;" form="atendimento" placeholder="Entre com o texto aqui..."> </textarea>                            </td>
                            </tr>
                            <tr>
                            
                            <td></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >Médico atendente </td>
                            <td><input name="medico" class="form-matric" id="medico" size="60"  minlength="4" required="required" placeholder="Digite o nome do médico atendente"/></td>
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


                                <input name="submit" type="Submit" value="Cadastrar" class="btn btn-primary "/> </strong>                              </div>
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

  