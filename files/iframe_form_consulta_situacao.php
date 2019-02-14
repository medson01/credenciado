  <!-- Bootstrap -->
    
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.min.css">
    <!-- <link rel="kinetic-stylesheet" type="text/css" href="http://www.ipasealsaude.al.gov.br/portal_kss/Tema%20Fabrica/at-cachekey1702.kss"> -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

		<form action="http://sistemasweb.itec.al.gov.br/ipaseal/situacao_contrato/" method="POST" style="size: 10px;"><input type='hidden' name='csrfmiddlewaretoken' value='lCA2ovUBttPwJsW7ZcHjHAtgzSnJ1f9R'>
	  	<div style="">
            <div class="form-group">
            	<div class="row dis_sup">
					<div class="col-xs-4" style="float:left">
						<div class="col-sm-12 ">
							<label class="control-label" for="cpf">CPF</label>
							<input class="form-control input-sm" id="id_cpf" maxlength="14" name="cpf" required="required" type="text" />
		                    
						</div>
		                <div class="col-sm-12 ">
							<label class="control-label" for="textinput"> Matrícula</label>
							<input class="form-control input-sm" id="id_matricula" maxlength="6" name="matricula" required="required" type="text" />
		                    
		                </div>

		                <div class="col-sm-12 dis_sup">
		                	<br>
		                	
							<button type="submit" id="consulta" name="consulta" class="btn btn-primary pull-right">
								Consultar
							</button>
						</div>
					</div>
					<div class="col-xs-8">
		                <div class="col-sm-8">
						     <span class="help-block">
							       Siga o exemplo abaixo <br />para saber o número da sua matrícula.
						     </span>
		                </div>
		                <div class="col-sm-8">
						     <img src="../imagem/cartao.jpg">
		                </div>
					</div>
			    </div>
			</div>
       	</div>
	</form>