

	<ul class="nav nav-tabs" id="myTab" role="tablist">
	  <li class="nav-item active">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lista de Procedimentos</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="profile" aria-selected="false">SADT</a>
	  </li>
	
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active in" id="home" role="tabpanel" aria-labelledby="home-tab">
			<?php  include "procedimento_lista.php";?>

		</div>
		<div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="profile-tab">
			<?php include "procedimento_formulario.php";?>
		</div>

	</div>
