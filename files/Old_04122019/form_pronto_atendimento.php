<?php 
  
#Arquivo de configuração
  include "cabecalho.php";
  

 ?>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-style: italic;
}
-->
</style>
        
            <td width="898" id="portal-column-content" style="width: 600px; ">

              
                <div class="">
                  <div id="region-content" class="documentContent">
                    

                                      
                    <div id="viewlet-above-content"></div>

                    
                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading"> Pronto Atendimento </h1>
								</div>
                    </div>

 
                    <p><br />
		            </p>
                     <div class="x"></div>
			<div id="feature"></div>
  </div>		
<!-- Conteudo -->
				

                     <form name="atendiemtno" id="atendimento" action ="cadastro_atendimento.php" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <label> </label>
                      <div align="center">
                        </p>
                        <table width="549" border="0" align="center">
                          <tr>
                            <td width="179" >Matr&iacute;cula</td>
                            <td width="360">
                            <input required="required" type="text" name="matricula" minlength="16" class="form-matric" id="matricula" size="20" maxlength="16"placeholder="00000000.000000.00"/></td>
                          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td >Nome</td>
                              <td><input  minlength="4" name="nome" class="form-matric" required="required" placeholder="Digite o nome do paciente" size="60"/></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
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
                            <td >Motivo do atendimento </td>
                            <td>
                              <textarea class="form-matric" name="motivo"  style="margin: 0px; height: 100px; width: 100%;" form="internamento" placeholder="Entre com o texto aqui..."> </textarea>                            </td>
                            </tr>
                            <tr>
                            
                            <td></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td><div align="right" class="style3">
                              <div align="right">
                                <strong>

                                  <input type="hidden" id="cid" name="cid">
                                  <input type="hidden" id="cid_desc" name="cid_desc">

                                <input name="submit" type="Submit" value="Cadastrar" class="btn btn-primary "/> </strong>                              </div>
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
                   
<!--/ Coonteudo -->                      
                      </p>
              </div>
           
          </tr>
        </tbody>
    </table>

</div>
  
  
 <?php
 
 	  include "rodape.php";
 ?>     