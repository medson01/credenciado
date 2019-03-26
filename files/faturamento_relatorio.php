<?php 
  
  //Arquivo de configuração
  include "cabecalho.php";
  
  include "faturamento_envio.php"; 

 ?>
 
<style type="text/css">
<!--
.style3 {font-size: 9px}
.style9 {font-family: Arial, Helvetica, sans-serif}

page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;
}
@media print
{
body
{
background: #FFF;
border: none;
width:800px;
}
}
.style13 {font-size: 10px}
.style14 {font-size: 10px; font-weight: bold; }
.style15 {font-size: 9px; font-weight: bold; }
-->
</style>
        
            <td width="898" id="portal-column-content">

                  <div class="documentContent style3" id="region-content">
                                      
                    <div id="viewlet-above-content">
                      <div align="center"><img src="../imagem/timbre.png" width="365" height="79" /></div>
                    </div>
                    
                    <table width="712"border="0"align="center">
                                <tr>
                                  <td colspan="11"><div align="center"><span style="text-align:right;font-size: 10px">Ilmo. Sr. DIRETOR PRESIDENTE DO IPASEAL SAÚDE</span></div></td>
                                </tr>
                                <tr>
                                  <td width="78">&nbsp;</td>
                                  <td width="1">&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                  <td width="1">&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="3"> <br />                                  </td>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><input style="text-align:right;font-size: 10px" class="form-control input-sm" type="text" size="50" value="Processo: 4701-                /20       "/></td>
                                </tr>
                                
                                <tr>
                                  <td colspan="11">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="11"><div align="justify" class="style14">O Credenciado(a) infra qualificado vem requerer à V. Sa., o pagamento da importância correspondente aos serviços discriminados na  planilha abaixo:</div></td>
                                </tr>
                                
                                <tr>
                                  <td class="style13" style="border-top:ridge">Código<br />
                                    <input name="codigo" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $codigo;  ?>" size="12" /></td>
                                  <td style="border-top:ridge">&nbsp;</td>
                                  <td colspan="3" style="border-top:ridge"><span class="style13">Credenciado</span><br />
                                    <input name="credenciado" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $credenciado ?>" size="44" /></td>
                                  <td style="border-top:ridge">&nbsp;</td>
                                  <td width="294" style="border-top:ridge"><span class="style13">Competência</span><br />
                                    <input name="codigo2" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $prod_mes." / ".$prod_ano;  ?>" size="30" /></td>
                                </tr>
                                <tr>
                                  <td colspan="11">                                    <input name="id" id="id"   type="hidden" class="form-control input-sm" style="background:#faffbd;font-size: 10px" size="50" value="<?php echo $_SESSION["id"]; ?>" />                                  </td>
                                </tr>
                                
                                <tr>
                                  <td><span class="style13">CPF / CNPJ</span><br />                                    <input name="cpf_cnpj" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $cpf_cnpj; ?>" size="12" />                                  </td>
                                  <td>&nbsp;</td>
                                  <td width="147"><span class="style13">Fone Comercial</span><br />                                    <input name="telefone" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $telefone; ?>" size="18" />                                  </td>
                                  <td width="3">&nbsp;</td>
                                  <td width="125"><span class="style13">Celular</span><br />                                      <input name="celular" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $celular; ?>" size="18" />                                  </td>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><span class="style13">E-mail</span><br />
                                    <input name="email" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $email; ?>" size="30" />                                  </td>
                                </tr>
								                               
								                                <tr>
                                  <td colspan="9"><span class="style13">Endereço</span><br />                                    <input name="cpf_cnpj" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php echo $_SESSION["endereco"].",".$_SESSION["numero"].",". $_SESSION["cep"].",".$_SESSION["cidade"].",".$_SESSION["estado"]; ?>" size="104" />                                  </td>
                                </tr>
								                       
								                                <tr>
                                  <td><span class="style13">Banco Autorizado </span><br />                                    <input name="cpf_cnpj" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" size="12" />                                  </td>
                                  <td>&nbsp;</td>
                                  <td width="147"><span class="style13">Agência</span><br />                                    <input name="telefone" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" size="18" />                                  </td>
                                  <td width="3">&nbsp;</td>
                                  <td width="125"><span class="style13">Operação</span><br />                                      <input name="celular" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" size="18" />                                  </td>
                                  <td>&nbsp;</td>
                                  <td colspan="3"><span class="style13">Conta Corrente </span><br />
                                    <input name="email" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" size="30" />                                  </td>
                                </tr>
				    </table>
					<table width="712"border="0"align="center">
					  <tr>
					    <td colspan="5" class="style13">&nbsp;</td>
				      </tr>
					  <tr>
                        <td colspan="5" class="style13"><div align="center" class="style15"><strong>Estão anexas todas as planilhas indispensáveis à análise da produção</strong></div></td>
				      </tr>
					  
                                <tr>
                                  <td colspan="2" style="border-top:ridge"><span class="style13">Data e local
                                      <input name="cpf_cnpj2" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" value="<?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
echo $_SESSION["cidade"].",".strftime('%d de %B de %Y', strtotime('today'));?>" size="50" />
                                  </span></td>
                                  <td style="border-top:ridge">&nbsp;</td>
                                  <td colspan="2" style="border-top:ridge"><span class="style13">Assinatura do credenciado
                                      <input name="cpf_cnpj22" type="text" class="form-control input-sm" style="background:#faffbd;font-size: 10px" readonly="true" size="50" />
                                  </span></td>
                                </tr>
                          
				    </table>
					 
					 <table width="712"border="0"align="center">
                       <tr>
                         <td colspan="13" class="style13">&nbsp;</td>
                       </tr>
                       <tr>
                         <td colspan="13" class="style13"><div align="center" class="style15">FATURA DOS SERVIÇOS MÉDICO – HOSPITALARES</div></td>
                       </tr>
                     
                       <tr >
                         <td style="border-top:ridge">&nbsp;</td>
                         <td colspan="3" style="border-top:ridge"><div align="left">
                             <div align="center" class="style13">Uso do Credenciado </div>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td colspan="3" style="border-top:ridge"><div align="center"><span class="style13">Uso do Ipaseal</span></div></td>
                         <td width="172" style="border-top:ridge">&nbsp;</td>
					   </tr>
                       <tr>
                         <td width="153" class="style13">Consultas</td>
                         <td width="83"><div align="right" class="style13">
                             <div align="center">Quantidade</div>
                         </div></td>
                         <td width="3">&nbsp;</td>
                         <td width="83"  class="style13"><div align="center">Faturado</div></td>
                         <td width="11">&nbsp;</td>
                         <td width="83"><div align="center"><span class="style13">Valor Glosado</span></div></td>
                         <td width="3">&nbsp;</td>
                         <td width="83"><div align="center"><span class="style13">À pagar</span></div></td>
                         <td colspan="7" class="style13">&nbsp;</td>
                       </tr>
                       <tr>
                         <td style="border-top:ridge"><span class="style13">Eletivas</span></td>
                         <td style="border-top:ridge"><input name="qtd_eletivas" readonly="true" type="text" class="form-control input-sm" id="qtd_eletivas" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_eletivas;  ?>"   size="20"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_eletivas"type="text"  class="form-control input-sm" id="val_eletivas" style="background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_eletivas;  ?>" size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="glosa_eletivas2" readonly="true" type="text" class="form-control input-sm" id="glosa_eletivas2" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()"   size="20"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_eletivas2"type="text"  class="form-control input-sm" id="val_eletivas2" style="background:#faffbd;font-size: 10px" onblur="calcular()" size="20" readonly="true"/></td>
                         <td width="172" style="border-top:ridge">&nbsp;</td>
                       </tr>
                       <tr>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                       </tr>
                       <tr>
                         <td><span class="style13">Emergências</span></td>
                         <td width="83"><input name="qtd_emergencias"type="text" class="form-control input-sm" id="qtd_emergencias" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_emergencias;  ?>"  size="20" readonly="true"/></td>
                         <td width="3">&nbsp;</td>
                         <td width="83"><div align="left">
                             <input name="val_emergencias" type="text" class="form-control input-sm" id="val_emergencias" style="background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_emergencias;  ?>" size="20" readonly="true"/>
                         </div></td>
                         <td>&nbsp;</td>
                         <td><input name="qtd_emergencias2"type="text" class="form-control input-sm" id="qtd_emergencias2" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()"  size="20" readonly="true"/></td>
                         <td>&nbsp;</td>
                         <td><input name="val_emergencias2" type="text" class="form-control input-sm" id="val_emergencias2" style="background:#faffbd;font-size: 10px" onblur="calcular()" size="20" readonly="true"/></td>
                         <td><div align="left"></div></td>
                       </tr>
                       <tr>
                         <td colspan="8">&nbsp;</td>
                       </tr>
                       <tr>
                         <td><span class="style13">Visita Hospitalar</span><span class="style9"><br />
                               <br />
                         </span></td>
                         <td width="83"><input name="qtd_visitas" type="text" class="form-control input-sm" id="qtd_visitas" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_visitas;  ?>"   size="20"  readonly="true"/></td>
                         <td width="3">&nbsp;</td>
                         <td width="83"><div align="left">
                             <input name="val_visitas" type="text" class="form-control input-sm" id="val_visitas" style="background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_visitas;  ?>"   size="20" readonly="true"/>
                         </div></td>
                         <td>&nbsp;</td>
                         <td><input name="qtd_visitas2" type="text" class="form-control input-sm" id="qtd_visitas2" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()"   size="20"  readonly="true"/></td>
                         <td>&nbsp;</td>
                         <td><input name="val_visitas2" type="text" class="form-control input-sm" id="val_visitas2" style="background:#faffbd;font-size: 10px" onblur="calcular()"   size="20" readonly="true"/></td>
                         <td><div align="left"></div></td>
                       </tr>
                       
                       <tr>
                         <td colspan="4" class="style13">Exames / Raio X </td>
                         <td>&nbsp;</td>
                         <td colspan="8">&nbsp;</td>
                       </tr>
                       <tr>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="qtd_raix" type="text" class="form-control input-sm" id="qtd_raix" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_raix;  ?>"   size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><div align="right">
                             <input name="val_raix2" type="text" class="form-control input-sm" id="val_raix2" style="background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_raix;  ?>"  size="20" readonly="true"/>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="qtd_raix2" type="text" class="form-control input-sm" id="qtd_raix2" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()"   size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_raix" type="text" class="form-control input-sm" id="val_raix" style="background:#faffbd;font-size: 10px" onblur="calcular()"  size="20" readonly="true"/></td>
                         <td style="border-top:ridge"><div align="left"></div></td>
                       </tr>
                       <tr>
                         <td colspan="4" class="style13">Exames prévios </td>
                         <td>&nbsp;</td>
                         <td colspan="8">&nbsp;</td>
                       </tr>
                       <tr>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_previos" type="text" class="form-control input-sm" id="val_previos" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_previos;  ?>" size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><div align="left">
                             <input name="qtd_previos" type="text" class="form-control input-sm" id="qtd_previos" style="text-align:left; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_previos;  ?>"  size="20" readonly="true"/>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="qtd_previos2" type="text" class="form-control input-sm" id="qtd_previos2" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()"  size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_previos2" type="text" class="form-control input-sm" id="val_previos2" style="background:#faffbd;font-size: 10px" onblur="calcular()" size="20" readonly="true"/></td>
                         <td style="border-top:ridge"><div align="left"></div></td>
                       </tr>
                       <tr>
                         <td colspan="4" class="style13">Procedimentos</td>
                         <td>&nbsp;</td>
                         <td colspan="8">&nbsp;</td>
                       </tr>
                       <tr>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="qtd_procedimento" type="text" class="form-control input-sm" id="qtd_procedimento" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_procedimento;  ?>"   size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><div align="right">
                             <input name="val_procedimento2" type="text" class="form-control input-sm" id="val_procedimento2" style="background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_procedimento;  ?>" size="20" readonly="true"/>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_procedimento" type="text" class="form-control input-sm" id="val_procedimento" style="background:#faffbd;font-size: 10px" onblur="calcular()" size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_procedimento22" type="text" class="form-control input-sm" id="val_procedimento22" style="background:#faffbd;font-size: 10px" onblur="calcular()" size="20" readonly="true"/></td>
                         <td style="border-top:ridge" ><div align="left"></div></td>
                       </tr>
					   <tr>
                         <td colspan="4" class="style13">Pronto Atendimento - P.A. </td>
					     <td>&nbsp;</td>
					     <td colspan="8">&nbsp;</td>
				       </tr>
                       <tr>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="qtd_pa" type="text" class="form-control input-sm" id="qtd_pa" style="text-align:right; background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $qtd_pa;  ?>"   size="20"  readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><div align="right">
                             <input name="val_pa2" type="text" class="form-control input-sm" id="val_pa2" style="background:#faffbd;font-size: 10px" onblur="calcular()" value="<?php echo $val_pa;  ?>"  size="20" readonly="true"/>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_pa" type="text" class="form-control input-sm" id="val_pa" style="background:#faffbd;font-size: 10px" onblur="calcular()"  size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_pa22" type="text" class="form-control input-sm" id="val_pa22" style="background:#faffbd;font-size: 10px" onblur="calcular()"  size="20" readonly="true"/></td>
                         <td style="border-top:ridge"><div align="left"></div></td>
                       </tr>
                       <tr>
                         <td colspan="4" class="style13">Auditoria</td>
                         <td>&nbsp;</td>
                         <td colspan="8">&nbsp;</td>
                       </tr>
                       <tr>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="qtd_auditoria" type="text" class="form-control input-sm" id="qtd_auditoria" style="text-align:right; background:#faffbd;font-size: 10px"  onblur="calcular()" value="<?php echo $qtd_auditoria;  ?>" size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><div align="right">
                             <input name="val_auditoria2" type="text" class="form-control input-sm" id="val_auditoria2" style="background:#faffbd;font-size: 10px"  onblur="calcular()" value="<?php echo $val_auditoria;  ?>" size="20" readonly="true"/>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><input name="val_auditoria" type="text" class="form-control input-sm" id="val_auditoria" style="background:#faffbd;font-size: 10px"  onblur="calcular()" size="20" readonly="true"/></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><div align="left">
                             <input name="val_auditoria22" type="text" class="form-control input-sm" id="val_auditoria22" style="background:#faffbd;font-size: 10px"  onblur="calcular()" size="20" readonly="true"/>
                         </div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                       </tr>
                       <tr>
                         <td>&nbsp;</td>
                         <td><div align="right" class="style13">Quantidade</div></td>
                         <td>&nbsp;</td>
                         <td><div align="center"><span class="style13">Faturado</span></div></td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td><div align="left" class="style13"></div></td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                       </tr>
                       <tr>
                         <td style="border-top:ridge"><strong class="style13" >Total<br />
                         </strong></td>
                         <td style="border-top:ridge"><strong class="style13">
                           <input name="quantidade" type="text"  class="form-control input-sm" id="quantidade" style="text-align:right; background:#faffbd;font-size: 10px" value="<?php echo $quantidade;  ?>"  size="20" readonly/>
                         </strong></td>
                         <td>&nbsp;</td>
                         <td style="border-top:ridge"><div align="right"><strong class="style13">
                             <input name="valor"  type="text" class="form-control input-sm" id="valor" style="background:#faffbd;font-size: 10px" value="<?php echo $valor;  ?>"  size="20" readonly="readonly" required="required" />
                         </strong></div></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><strong class="style13">
                           <input name="valor22"  type="text" class="form-control input-sm" id="valor22" style="background:#faffbd;font-size: 10px"  size="20" readonly="readonly" required="required" />
                         </strong></td>
                         <td style="border-top:ridge">&nbsp;</td>
                         <td style="border-top:ridge"><strong class="style13">
                           <input name="valor2"  type="text" class="form-control input-sm" id="valor2" style="background:#faffbd;font-size: 10px"  size="20" readonly="readonly" required="required" />
                         </strong></td>
                         <td style="border-top:ridge"><div align="left"></div></td>
                       </tr>

                       <tr>
                         <td colspan="13" class="style13">&nbsp;</td>
                       </tr>
                       <tr>
                         <td colspan="13" class="style13"><div align="center"><strong>COORDENAÇÃO DE REVISÃO HOSPITALAR</strong></div></td>
                       </tr>
                       <tr>
                         <td colspan="13" class="style13"><div align="justify">Examinamos as planilhas da presente fatura, informamos que as mesmas foram autorizadas por este órgão, os valores apresentados foram submetidos a análise e glosados,  os não compatíveis com a Tabela do IPASEAL, como também por incompatibilidade técnica.</div></td>
                       </tr>
                       <!--  Informação de arquivos enviados 
                                <tr>
                                  <td><strong class="style13">Arquivos enviados</strong></td>
                                  <td><div align="right">
                                      <input name="quantidade" type="text"  class="form-control input-sm" id="quantidade" style="text-align:right; background:#faffbd;font-size: 10px" value="<?php //echo $x+1;  ?>"  size="20" readonly="readonly"/>
                                  </div></td>
                                  <td>&nbsp;</td>
                                  <td><div align="left"></div></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="2">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2">&nbsp;</td>
                                </tr>
								
                                
								<tr>
                                  <td colspan="5" style="border-top:ridge"><span class="style13">
                                    <?php 
									  
									/*  for ($x = 0; $x < $i; $x++) {
									  
									  		echo $nomeArqAntigo[$x]."</br>";
									  
									  }
									 */ 
									  ?>
                                  </span></td>
                                </tr>
                                
                               -->
                       <tr>
                         <td>&nbsp;</td>
                         <td colspan="12">&nbsp;</td>
                       </tr>
                       <tr>
                         <td><span class="style13">Valor R$:<strong class="style13"><br />
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________<br />
                         </strong></span></td>
                         <td colspan="12" class="style13"><p>Por Extenso:<br />
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________________________________________________________<br />
                         </p></td>
                       </tr>
                       <tr>
                         <td class="style13">&nbsp;</td>
                         <td colspan="12" class="style13"><div align="right">Maceió - AL, _________ de ____________________________ de 20______ </div></td>
                       </tr>
                       <tr>
                         <td class="style13">&nbsp;</td>
                         <td colspan="12" class="style13">&nbsp;</td>
                       </tr>
                       <tr>
                         <td colspan="13" class="style13"><div align="center">
                             <p>________________________________________________<br />
                           Auditor</p>
                         </div></td>
                       </tr>
                       <tr>
                         <td class="style13"><img src="../imagem/logo_ipaseal.png" width="39" height="40" /><img src="../imagem/alagoas.png" width="103" height="46" /></td>
                         <td colspan="12"><div align="right"><img src="../imagem/imagem.png" width="44" height="40" /></div></td>
                       </tr>
                       <tr>
                         <td class="style13">&nbsp;</td>
                         <td colspan="12"><div align="right">
                           <input class="btn btn-primary delete" type="submit"  onclick="window.print();" value="Imprimir" name="imprimir" />
                         </div></td>
                       </tr>
                     </table>
					 <div id="feature"></div>
  </div>		
<!-- Conteudo -->
					
			       
					
					
					
					
<!--/ Coonteudo -->                      
           
          </tr>
        </tbody>
    </table>

</div>
  
  
 <?php
 
 	  include "rodape.php";
 ?>     