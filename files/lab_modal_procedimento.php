
<link rel="stylesheet" type="text/css" href="../css/modal.css"/>

<script type='text/javascript' src='../js/modal_sair.js'></script>


<script>
function pegarProcedimento(){
    var cod_proc = document.getElementById("cod_proc").value;
  	var id_especialidade = document.getElementById("id_especialidade").value;
	var cr = document.getElementById("cr").value;
	var medico_solicitante = document.getElementById("medico_solicitante").value;
	var codsig = document.getElementById("codsig").value;

  window.location.href = "verificar_procedimento.php?cod_proc="+cod_proc+'&id_especialidade='+id_especialidade+'&cr='+cr+'&medico_solicitante='+medico_solicitante+'&codsig='+codsig; 
}
</script>


<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>





<!-- Modal -->

<div class="modal" id="labModal">
	<div class="modal-dialog" style="margin-left:15%; width:85%">	
	  <div class="modal-content">
		<div class="modal-header">			 	 
			  <span class="close" id="fechar">&times;</span>			  	   
		</div>
		<div class="modal-body" >
        		<form nome="lab_procedimento_cadastro" id="lab_procedimento_cadastro" action="lab_procedimento_cadastro.php" method="post" class="form-group" enctype="multipart/form-data">
              
                <div align="center">
                  <div class="form-group">

                    <table width="100%" border="0"align="center">
                    <tr>
        				<td colspan="3" bgcolor="#CCCCCC"><div align="center" class="style5">
                                          <div align="center"> Procedimento </div></td>
                      </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                      <td ><span class="style13">C&oacute;digo do Procedimento<br />
                                      <input onchange="pegarProcedimento()" name="cod_proc" id ="cod_proc" type="text" class="form-control input-sm" style="font-size: 10px " size="8" minlength="8" required="required" <?php if (isset($_GET['cod_proc'])) { echo "value='".$_GET['cod_proc']."' "; }  if(isset($desativar)){ echo $desativar;} ?>/>
                                      </span></td>
                                    </tr>
                                    <tr>
                                      <td >&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" ><span class = 'style13'>Descri&ccedil;&atilde;o do Procedimento</span> <br />
                                        <input id="desc_proc"  name="desc_proc" type="text" class="form-control input-sm" style="font-size: 10px" required="required" <?php if (isset($_GET['desc_proc'])) { echo "value='".utf8_decode($_GET['desc_proc'])."'  readonly "; }   ?> /></td>
                                    </tr>
                                    <tr>
                                      <td >&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td ><span class = 'style13'>Quantidade </span><br />
                                        <input name="qtd_proc" id ="qtd_proc" type="text" class="form-control input-sm" style="font-size: 10px" size="44" <?php if (isset($qtd_proc)) { echo "value='".$qtd_proc."' "; }  if(isset($desativar)){ echo $desativar;} ?>/></td>
                                    </tr>
                                    <tr>
                                    <td >&nbsp;</td>
                                    </tr>
        			</table>
        			

        			
                  <p>&nbsp;</p>
        		    
                </div>
                </div>
        	     <!-- /Conteúdo Modal -->
     
        	  <input type="hidden" name="id_paciente" value="<?php echo $_GET['id']; ?>" />
              <input type="hidden" name="data_proc" value="<?php echo date("Y-m-d H:i:s"); ?>" />
			  <input type="hidden" name="matricula" value="<?php echo $_GET['matricula']; ?>" />
			  <input type="hidden" name="nome" value="<?php echo $_GET['nome']; ?>" />
			  <input type="hidden" name="deficiente" value="<?php echo $_GET['deficiente']; ?>" />
			  <input type="hidden" name="data_inclusao" value="<?php echo $_GET['data_inclusao']; ?>" />
			  <input type="hidden" name="id_especialidade" value="<?php echo $_GET['id_especialidade']; ?>" />
              <input type="hidden" name="id_beneficiarios" value="<?php echo $_GET['id_beneficiarios']; ?>" />
			  <input type="hidden" name="id_credenciado" value="<?php echo $_GET['id_credenciado']; ?>" />
			  <input type="hidden" name="id_profissional_saude" value="<?php echo $_GET['id_profissional_saude']; ?>" />
			  <input type="hidden" name="medico_solicitante" value="<?php echo $_GET['medico_solicitante']; ?>" />
			  <input type="hidden" name="cr" value="<?php echo $_GET['cr']; ?>" />
			  <input type="hidden" name="codsig" value="<?php echo $_GET['codsig']; ?>" />
              <input type="hidden" name="id_proc" value="<?php echo $_GET['id_proc']; ?>" />
			  <input type="hidden" name="lab" value="<?php echo $_GET['lab']; ?>" />
			  
				 
        		 </div>
				  <div class="modal-footer" style="background-color: red;">
            <button id="cancelar" type="button" class="btn btn-default" data-dismiss="modal" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" >
        		 		Cancelar 
        		</button>
        		<button type="submit" class="btn btn-default" style="color:#FFFFFF;  background-color: black; border-color: #f4f7fb;" /> Incluir 
            </button>
        	</div>	
      </div>
      ...
</div>
                </form> 
				
<!-- Script de controle da modal -->
<!-- Ele tem que vir depois da página onde é criados os objetos -->				
<script>
// Cria os obejetos do modal e close
	//variável modal
	var labModal = document.getElementById("labModal");
	//variável do botão abrir modal
	var btn = document.getElementById("incluir");
	//variável span fechar modal
	var fechar = document.getElementById("fechar");
	var cancelar = document.getElementById("cancelar");
	
// Fucnção abrir modal
  btn.onclick = function() {
	  labModal.style.display = "block";
 }
 
 // Função fechar modal
  fechar.onclick = function() {
	 labModal.style.display = "none";
 }

 // Função fechar modal
  cancelar.onclick = function() {
	 labModal.style.display = "none";
 }
</script>   				
				