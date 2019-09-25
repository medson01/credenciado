

    <!-- CSS Telefone -->
    <link rel="stylesheet" type="text/css" href="../css/modal_saida.css"/>

    <!-- Botão saida -- >
    <script type='text/javascript' src='../js/bnt_sair.js'></script>


    <!-- The Modal -->
    <style type="text/css">
<!--
.style1 {color: #8B0000}
-->
    </style>
    <div id="myModal" class="modal">

  <!-- Modal content -->



  <div class="modal-content">
    <div class="modal-header">
	
      <span class="close" style="color:#000000">&times;</span>
      
    </div>

    <div class="modal-body" >
	
      <?php 
        /*	Defina se o paciente excedeu a regra tempo de atendimento , definido em contrato
            if( $_GET['data'] == 1 ){
               echo "<p>   O paciente exedeu o per&iacute;odo referente ao Pronto Atendimento que &eacute; de ".$tempo.", favor informar o motivo:  </p>";

               echo " <p> 
                  <textarea name='prorrogacao' form='modal_saida' class='form-control form-control-sm' placeholder='Describe yourself here...'> </textarea>
                      </p>";
            }else{
               echo "<p>   Favor informar sobre a alta do paciente:  </p>";

                echo "<p> 
                    <textarea rows='8' cols='50' name='motivo_saida' form='modal_saida' class='form-control form-control-sm' placeholder='Describe yourself here...'> </textarea>
                      </p>";
            }
		*/
		   if(!isset($_GET['int'])){
				echo "<form name='modal_saida' id='modal_saida' action ='pronto_atendimento_saida.php' method='post' class='form-horizontal form-label-left'>";
			}else{
			
			    echo "<form name='modal_saida' id='modal_saida' action ='internacao_saida.php' method='post' class='form-horizontal form-label-left'>";
			}
			
			
		        echo "<p>   Favor informar sobre a alta do paciente:<span class='style1'>*</span> </p>";

                echo "<p> 
                    <textarea rows='8' cols='50' name='motivo_saida' form='modal_saida' class='form-control form-control-sm' required='required'></textarea>
                      </p>";
      
	  	    
	  ?>
      <table width="100%" border="0">
        <tr>
          <td width="45%">Data:<span class="style1">*</span></td>
		  <td width="10%"> </td>
          <td width="45%">Hora:<span class="style1">*</span></td>
        </tr>
        <tr>
          <td><input id="data" name="data" type="date" class="form-control form-control-sm" required /></td>
		  <td></td>
          <td><input id="time" name="time" type="time" class="form-control form-control-sm" required /></td>
        </tr>
      </table>
      </div>
<div class="modal-footer">
	<p>
	<h3 align="right">

    <input id="data" name="id" type="hidden" class="form-control form-control-sm" value="<?php echo $_GET['registro']; ?>" />


   <input type="submit"  class="btn btn-warning" style="color: #f3ecec; background-color: #291903; border-color: #efeff5;" value=" OK ">

  </h3>
    </div>
  </div>

</div>

</form>
	
<!-- Botão Sair -->
<script type="text/javascript" src="../js/modal_sair.js"></script>

	
	
   

  