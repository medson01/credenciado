 <?php 
 
 	if(isset($_GET['id'])){

	 
    $query = mysqli_query($conn,"SELECT `id`,`nome`,`nome_fantasia`,`cpf_cnpj`, `codigo`, `data_inc`, `telefone`, `celular`, `email`, `endereco`, `numero`, `bairro`, `cep`, `cidade` FROM `credenciado` WHERE id = '".$_GET['id']."'") or die("erro ao carregar consulta");
	
	

               while($registro = mysqli_fetch_row($query)){

                                  $id = $registro[0];
                                  $nome = $registro[1];
                                  $nome_fantasia = $registro[2];
                                  $cpf_cnpj = $registro[3];
                                  $codigo = $registro[4];
                                  $data_inc = $registro[5];
                                  $telefone = $registro[6];
                                  $celular = $registro[7];
                                  $email = $registro[8];
                                  $endereco = $registro[9];
                                  $numero = $registro[10];
                                  $bairro = $registro[11];
                                  $cep = $registro[12];
                                  $cidade = $registro[13];
                                

                                   
               }
   }            
	
	?>
	
  <!-- Mascara campos -->
   <script type="text/javascript">
    $("#cnpj_cpf").mask("000000000000000");
	$("#cep").mask("00000-000");
	$("#telefone").mask("(00)0000-0000");
	$("#celular").mask("(00)00000-0000");
	$("#conta").mask("00000000000");
	$("#operacao").mask("000");
	$("#agencia").mask("0000000");

    </script>


<!-- Perguntar antes de excluir -->
<script language="Javascript">
function reset() {
 
          window.location.href = "credenciado.php?id=''";
}
</script>



                     <form name="credenciado" id="credenciado" action ="credenciado_cadastro.php" method="post"  data-parsley-validate class="form-horizontal form-label-left">
                     <style type="text/css">
<!--
.style1 {font-size: 9px}
-->
                     </style>
                     
                      <label> </label>
                      <div align="center">
                        </p>
                        <table width="589" border="0" align="center">
                          <tr>
                            <td width="200" >Código</td>
                            <td width="1" >&nbsp;</td>
                            <td colspan="7">
                            <input  required="required" type="text" name="codigo" minlength="6" class="form-matric" id="codigo" size="20" maxlength="6"placeholder="000000" <?php if(isset($_GET['id'])){ echo "value='".$codigo."'"; }?>   /></td>
                          </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                              <td>CNPJ</td>
                              <td>&nbsp;</td>
                              <td colspan="7"><input name="cpf_cnpj" type="text" class="form-matric" id="cnpj" size="20" maxlength="14" required="required" minlength="11" <?php if(isset($_GET['id'])){ echo "value='".$cpf_cnpj."'"; }?> /></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Nome</td>
                              <td >&nbsp;</td>
                              <td colspan="7"><input  minlength="4" name="nome" class="form-matric" required="required" placeholder="Digite o nome da empresa" size="60"  <?php if(isset($_GET['id'])){ echo "value='".$nome."'"; }?>/></td>
                            </tr>
                            <tr>
                            <td colspan="2" class="style3">&nbsp;</td>
                            <td colspan="7">&nbsp;</td>
                            </tr>

                            <tr>
                              <td >Nome fantasia </td>
                              <td >&nbsp;</td>
                              <td colspan="7"><input name="nome_fantasia" class="form-matric" id="nome_fantasia" size="60"  minlength="4" required="required" placeholder="Digite o nome fantasia "  <?php if(isset($_GET['id'])){ echo "value='".$nome_fantasia."'"; }?> /></td>
                            </tr>
                            <tr>
                              <td colspan="2" >&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Endereço</td>
                              <td >&nbsp;</td>
                              <td colspan="7"><input  type="text" minlength="4"  name="endereco" class="form-matric" id="endereco" size="60" required="required"  <?php if(isset($_GET['id'])){ echo "value='".$endereco."'"; }?> /></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td >Número</td>
                            <td >&nbsp;</td>
                            <td colspan="2"><input  name="numero"  type="text" class="form-matric" id="numero" size="20" maxlength="10" required="required"  <?php if(isset($_GET['id'])){ echo "value='".$numero."'"; }?> /></td>
                            <td width="17">&nbsp;</td>
                            <td colspan="2">Bairro</td>
                            <td colspan="2"><input  class="form-matric" minlength="4" name="bairro" type="text"id="bairro"size="21"maxlength="20" required="required"  <?php if(isset($_GET['id'])){ echo "value='".$bairro."'"; }?> /></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2">Cep</td>
                              <td colspan="7"><input  class="form-matric" minlength="4" name="cep" id="cep" type="text" size="20"maxlength="10" required="required"  <?php if(isset($_GET['id'])){ echo "value='".$cep."'"; }?> /></td>
                            </tr>
                            <tr>
                            <td colspan="2">&nbsp;</td>
                            <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Cidade</td>
                              <td >&nbsp;</td>
                              <td colspan="2"><input  class="form-matric" minlength="4" name="cidade" type="text"id="cidade"size="20"maxlength="10" required="required"  <?php if(isset($_GET['id'])){ echo "value='".$cidade."'"; }?> /></td>
                              <td>&nbsp;</td>
                              <td colspan="2">Estado</td>
                              <td colspan="2">
							  	<select class="form-matric"  id="estado" name="estado">
									<option value="AC">Acre</option>
									<option value="AL" selected="selected">Alagoas</option>
									<option value="AP">Amapá</option>
									<option value="AM">Amazonas</option>
									<option value="BA">Bahia</option>
									<option value="CE">Ceará</option>
									<option value="DF">Distrito Federal</option>
									<option value="ES">Espírito Santo</option>
									<option value="GO">Goiás</option>
									<option value="MA">Maranhão</option>
									<option value="MT">Mato Grosso</option>
									<option value="MS">Mato Grosso do Sul</option>
									<option value="MG">Minas Gerais</option>
									<option value="PA">Pará</option>
									<option value="PB">Paraíba</option>
									<option value="PR">Paraná</option>
									<option value="PE">Pernambuco</option>
									<option value="PI">Piauí</option>
									<option value="RJ">Rio de Janeiro</option>
									<option value="RN">Rio Grande do Norte</option>
									<option value="RS">Rio Grande do Sul</option>
									<option value="RO">Rondônia</option>
									<option value="RR">Roraima</option>
									<option value="SC">Santa Catarina</option>
									<option value="SP">São Paulo</option>
									<option value="SE">Sergipe</option>
									<option value="TO">Tocantins</option>
									<option value="ES">Estrangeiro</option>
								</select>							  </td>
                            </tr>
                            <tr>  <td colspan="2" >&nbsp;</td>
                                <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                            
                            <td colspan="2"></td>
                          </tr>
                            <tr>
                              <td >Telefone</td>
                              <td >&nbsp;</td>
                              <td colspan="2"><input  class="form-matric" minlength="4" name="telefone" type="text"id="telefone"size="20"maxlength="10"  <?php if(isset($_GET['id'])){ echo "value='".$telefone."'"; }?>/></td>
                              <td>&nbsp;</td>
                              <td colspan="2">Celular</td>
                              <td colspan="2"><input  class="form-matric" minlength="4" name="celular" type="text"id="celular"size="21"maxlength="20"  <?php if(isset($_GET['id'])){ echo "value='".$celular."'"; }?> /></td>
                            </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                            <td colspan="7">&nbsp;</td>
                          </tr>
                            <tr>
                            
                            <td colspan="2"></td>
                          </tr>
                            <tr>
                              <td >E-mail</td>
                              <td >&nbsp;</td>
                              <td colspan="7"><input name="email" type="text"  class="form-matric"id="email"size="60" minlength="4" required="required"  <?php if(isset($_GET['id'])){ echo "value='".$email."'"; }?> /></td>
                            </tr>
                            <tr>
                              <td colspan="2" >&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>

                            <!--
                            <tr>
                              <td colspan="2" >Banco</td>
                              <td colspan="3"><input  class="form-matric" minlength="4" name="banco" type="text"id="banco"size="12"maxlength="10"   <?php if(isset($_GET['id'])){ echo "value='".$banco."'"; }?> /></td>
                              <td colspan="2">&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" >&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            
                            <tr>
                              <td >Agência</td>
                              <td >&nbsp;</td>
                              <td width="72"><input  class="form-matric" minlength="4" name="agencia" type="text"id="agencia"size="12"maxlength="10"   <?php if(isset($_GET['id'])){ echo "value='".$agencia."'"; }?> /></td>
                              <td width="37"><div align="right">Op.</div></td>
                              <td>&nbsp;</td>
                              <td width="42"><input  class="form-matric" minlength="3" name="operacao" type="text"id="operacao"size="3"maxlength="3"   <?php if(isset($_GET['id'])){ echo "value='".$operacao."'"; }?> /></td>
                              <td width="1">&nbsp;</td>
                              <td width="53"><div align="right">&nbsp;&nbsp;&nbsp;Conta</div></td>
                              <td width="242">&nbsp;&nbsp;<input  class="form-matric" minlength="4" name="conta" type="text"id="conta"size="12"maxlength="11"   <?php if(isset($_GET['id'])){ echo "value='".$conta."'"; }?>/></td>
                            </tr>
                            <tr>
                            -->
                              <td colspan="2" >&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" >&nbsp;</td>
                              <td colspan="7">&nbsp;</td>
                            </tr>
                          <tr>
                            <td colspan="2" >&nbsp;</td>
                            <td colspan="7"><div align="right" class="style3">
                              <div align="right">
                                <strong>

                                 
                                                              

                                <?php 

                                  if(empty($_GET['id'])){

                                      echo "<input type='hidden' id='id' name='id' value='".$_GET['id']."'> ";
                                      echo"<input name='submit' type='Submit' value='Cadastrar' class='btn btn-primary '/>";
                                      
                                      
                                  }elseif($id ==''){

                                     
                                      echo"<input name='submit' type='Submit' value='Cadastrar' class='btn btn-primary '/> 
                                      &nbsp;&nbsp;";
                                      echo "<a class='btn btn-primary' onclick='reset()'> Novo </center>  </a>";

                                  }else{ 

                                      echo "<input type='hidden' id='id' name='id' value='".$_GET['id']."'> ";
                                      echo "<input name='submit' type='Submit' value='Atualizar' class='btn btn-primary '/>
                                       &nbsp;&nbsp;";
                                      echo "<a class='btn btn-primary' onclick='reset()'> Novo </center>  </a>";
                                  } 
                              
                                ?>
                                &nbsp;&nbsp;
                                <a  class='btn btn-danger'  href='painel.php?cred=1' > <center> Cancelar </center>  </a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								 </strong>                              </div>
                            </div></td>
                          </tr>
                        </table>
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
                   

			       
					
	