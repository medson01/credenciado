
    <!-- CSS Telefone -->
    <link rel="stylesheet" type="text/css" href="../css/modal_saida.css"/>



    <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->

  <form name="modal_saida" id="modal_saida" action ="pronto_atendimento_saida.php" method="post" class="form-horizontal form-label-left">

  <div class="modal-content">
    <div class="modal-header">
	
      <span class="close" style="color:#000000">&times;</span>
      
    </div>

    <div class="modal-body" >
	
      <p>   Favor informar sobre a alta do paciente:  </p>
      <p>
       	<textarea name="motivo" form="modal_saida" class="form-control form-control-sm" placeholder="Describe yourself here..."> </textarea>
  	  </p>

	  <p>Data e hora:</p>
      <p>
	  	<input id="data" name="data" type="datetime-local" class="form-control form-control-sm" />
	  </p>

	  
    </div>
<div class="modal-footer">
	<p>
	<h3>
		 <input type="hidden" id="id" name="id" />

     <?php

       echo "<a class='btn btn-primary  btn-xs' href='pronto_atendimento_saida&' ><span style='font-size: 10px; align: center;'> Ok </center> </span> </a> ";
	
      ?>
  </h3>
    </div>
  </div>

</div>

</form>
	
<!-- Botão Sair -->
<script type="text/javascript" src="../js/modal_sair.js"></script>

	
	
   

  