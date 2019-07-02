   
					    <tr>
					      <th colspan="2" style="font-weight:bold; font-size:14px;" bgcolor="#CCCCCC" scope='row'><div align="center">Dados da Prorroga&ccedil;&atilde;o </div></th>
				      </tr>
					    <tr>
					      <th width="48%" scope='row'><div align="left">M&eacute;dico solicitante: <br> &nbsp; <?php echo $solicitante; ?></div></th>
					      <th width="52%" scope='col'><div align="left">CRM: <br> &nbsp; <?php echo $crm; ?></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">C&oacute;digo do CID: <br> &nbsp; <?php echo  $cid; ?> </div></th>
					      <th scope='col'><div align="left">Descri&ccedil;&atilde;o do CID: <br> &nbsp;<?php echo "&nbsp;&nbsp;".utf8_encode($cid_desc); ?></div></th>
				      </tr>
					    <tr>
					      <th scope='row'><div align="left">Data de entrada: <br />
  &nbsp; <?php print date('d / m / Y ', strtotime($dat_entrada));  ?></div></th>
					      <th scope='col'><div align="left">Di&aacute;rias CID: <br />
  &nbsp; <?php echo $dias; ?> dia(s) </div></th>
	      </tr>
					    <tr>
					      <th scope='row'><div align="left">Prorroga&ccedil;&atilde;o: <br />
&nbsp; <?php echo $prorrogacao_dias; ?> dia(s) </div></th>
					      <th scope='col'><div align="left">Nova previs&atilde;o de  sa&iacute;da: <br />
&nbsp;
<?php 
						  		$dias = $dias+$prorrogacao_dias;
						  		echo date('d / m / Y', strtotime($dat_entrada."+".$dias." days"));   
						  
						  ?>
</div></th>
				      </tr>
					  					    <tr>
					      <th width="48%" scope='row'><div align="left">Fiosioterapia Respiratória p/ dia: <br> 
					        &nbsp; <?php echo $qtd_respiratoria; ?></div></th>
					      <th width="52%" scope='col'><div align="left">Fiosioterapia Motora p/ dia:  <br> 
					        &nbsp; <?php echo $qtd_motora; ?></div></th>
				      </tr>
					    
					    <tr>
					      <th scope='row'><div align="left">
					      	<?php
								
								if(!empty($motivo)){

									echo "Motivo do internamento: <br> &nbsp;";	 

					      			echo $motivo;
					      		}

					      	?> </div>					      </th>
					      <th scope='col'><div align="left"></div>					      </th>
				      </tr>
				       <tr>
					      <th scope='row'><div align="left">
					        <?php
								
								if(!empty($data_prorrogacao)){

									echo "Data da Prorroga&ccedil;&atilde;o: <br> &nbsp;";	 

					      			echo date('d / m / Y \h\s H:i:s', strtotime($data_prorrogacao)); 
					      		}

					      	?>
					      </div>					      </th>
				         <th scope='col'><div align="left">Data de Sa&iacute;de: <br />
&nbsp;
<?php 
					      		
					      			if($dat_saida_int <> 0) {
					      				echo date('d / m / Y \h\s H:i:s', strtotime($dat_saida_int));	
					      			} 
					      		 
					      	?>
</div>					      	</th>
				      </tr>
				    
				    <?php 

				   if($_GET['prorro'] == 1){
				      echo " 
				      <tr>
					      <th colspan='2' style='font-weight:bold; font-size:10px;' bgcolor='#CCCCCC' scope='row'><div align='center'> 
					      								Atenção: </br>
					      				 Prorrogação aguardando aprovação </div></th>
				      </tr>";
				     }
    				?>
		 		
     