    	<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 	<!-- Optional JavaScript -->
 	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 


    <!-- CSS Telefone -->
    <link rel="stylesheet" type="text/css" href="telefone.css"/>

    <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
	
  <!-- Mascara para campo -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	
<?php
    if(isset($_GET['guia'])){

    echo "<script type='text/javascript'> 
    			window.onload = function() {

    				modal.style.display = 'block';

				};
		  </script>
	";
	}
?>
	
	<script type="text/javascript">

    		$("#matric").mask("0000.0000.000000-00");
			$("#celular").mask("(00) 00000-0000");
	
	</script>

	<script>
		function pegarMatricula() {

			  var matric = document.getElementById("matric").value;
			  var guia = 1;

			  window.location.href = "verficar_matricula.php?guia="+guia+"&matric="+matric;

			  //alert("The input value has changed. The new value is: " + matric);
			}
	</script>





  <form name="form_telefone" id="form_telefone" action ="telefone_cadastro.php" method="post" class="form-horizontal form-label-left">

  <div class="modal-content">
    <div class="modal-header">
	<h2></h2>
      <span class="close">&times;</span>
      
    </div>

    <div class="modal-body" >
    	<java

      <p>   Para acessar o Guia M&eacute;dico, favor informar a matrícula da carteirinha: <br> Ex.: 0001.0001.123456-00 </p>
      <p>
       	<input id="matric" name="matric" type="text" class="form-control form-control-sm" onchange="pegarMatricula()" required <?php if(isset($_GET['matricula'])){ echo "value='".$_GET['matricula']."'"; } ?> />
  	  </p>

	  <p>telefone fixo:</p>
      <p>
	  	<input id="fixo" name="fixo" type="text" class="form-control form-control-sm" <?php if(isset($_GET['fixo'])){ echo "value='".$_GET['fixo']."'"; } ?> />
	  </p>

	  <p>Celular:</p>
      <p>
	  	<input id="celular" name="celular" type="text" class="form-control form-control-sm" <?php if(isset($_GET['celular'])){ echo "value='".$_GET['celular']."'"; } ?> />
	  </p>

	  <p>E-mail:</p>
      <p>
	  	<input id="email" name="email" type="e-mail" class="form-control form-control-sm" <?php if(isset($_GET['email'])){ echo "value='".$_GET['email']."'"; } ?> />
	  </p>
	  
    </div>
<div class="modal-footer">
	<p>
	<h3>
		 <input type="hidden" id="id_beneficiarios" name="id_beneficiarios" <?php if(isset($_GET['id_beneficiarios'])){ echo "value='".$_GET['id_beneficiarios']."'";} ?>/>

		 <input type="hidden" id="id_contato" name="id_contato" <?php if(isset($_GET['id_contato'])){ echo "value='".$_GET['id_contato']."'";} ?>/>


       <input name="submit" type="Submit" value=" OK " class="btn btn-secondary">
	</h3>
    </div>
  </div>

</div>

</form>
	
	<script src="telefone.js"></script>

	
	
   

  