<style type="text/css">


#exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
 
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
</style>


<div id="exTab2" class="container" style="width: 980px; padding-left: 1px;">	
<ul class="nav nav-tabs">
			<li <?php if(!isset($_GET['id'])){ echo 'class="active"';} ?> >
        		<a  href="#1" data-toggle="tab">Lista de credenciados</a>
			</li>
			<li <?php if(isset($_GET['id'])){ echo 'class="active"';} ?> >
				<a href="#2" data-toggle="tab">Cadastro</a>
			</li>


		</ul>

			<div class="tab-content ">
			  	<div class="tab-pane <?php if(!isset($_GET['id'])){ echo 'active';} ?>" id="1">
          				<?php   require_once "credenciado_lista.php"; ?>
				</div>
				<div class="tab-pane <?php if(isset($_GET['id'])){ echo 'active';} ?>" id="2">
        				<?php   require_once "credenciado_formulario.php"; ?>
				</div>

			</div>
  </div>

<hr></hr>




<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>