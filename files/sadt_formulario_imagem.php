 <!-- Css do botão submit -->
 <style> 
	input[type=submit]{
	background-color: #04AA6D;
	border: none;
	color: white;
	padding: 10px 32px;
	text-decoration: none;
	margin: 3px 2px;
	cursor: pointer;
	}
</style>

    <?php if( !isset($nome_imagem) ){
							echo'<div class="panel-heading" style="font-size: 10px;">NECESSÁRIO ENEXAR SOLICITAÇÃO MÉICA PARA ESSE PROCEDIMENTO</div>
							  <div class="panel-body">
							  <form method="post" enctype="multipart/form-data" action="sadt_imagem_cadastro.php">
							  	<input type="file" class="form-control-file" name="imagem" style= "width:430px;"/></p>
								<input name="id_sadt" type="hidden" value="'; 
									if(isset($_GET['id'])){ 
										echo $_GET['id']; 
									} 
							echo '" />

							  <input type="submit" value="Anexar" />
							</div>';
				}else{
				 			echo '<div class="panel-heading" style="font-size: 10px;">NECESSÁRIO ENEXAR SOLICITAÇÃO MÉICA PARA ESSE PROCEDIMENTO </div>
							  		<div class="panel-body">';	
								echo '<span style="font-weight: bolder;"> Arquivo de imagem anexado: </span> <a class="hidden-print" href="imagem_exibir.php?id='.$id_imagem.'"  target="_blank">';
								echo	$nome_imagem;
								echo '</a>';
				  				echo
						'</div>';
				}

	?>
