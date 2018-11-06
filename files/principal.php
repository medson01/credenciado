<?php 
	
	//Arquivo de configuração
	include "cabecalho.php";


	$query = mysqli_query($conn,"SELECT avisos.titulo, avisos.conteudo, avisos.data FROM avisos INNER JOIN usuarios ON usuarios.id = avisos.id_usuarios WHERE avisos.status = '1' and usuarios.id = ".$_SESSION['id']."") or die("erro ao carregar os usuários");
      
                   

 ?>
    <!-- Conteudo -->        
            
            <td width="898" id="portal-column-content"> <!-- tag conteudo -->

              
              <div>
                  	<div id="region-content" class="documentContent">
                    

	                    <p align="center"><strong><img src="../imagem/inicial.jpg" width="762" height="312" /></strong><br />
				          <br />
						</p>
                    
						<div class="x"></div>
						<div id="feature"></div>
  				    </div>		
                      
                      <center>
                        <img src="../imagem/avisos.jpg" width="91" height="71" border="0" />
                      </center>
					  <p>
					  
					  
	                        
										<p>					  
							<!-- Titulo do aviso -->								  
							<?php
								
							while($row = mysqli_fetch_assoc($query)){

								echo "
								<div align='center'>
										<span class='titulo' align='center'>
											 <img src='../imagem/alarme.png' width='30' height='30' />
											 ".$row["titulo"]."							          			
                       					</span>

                       			</div>
                       			<div>
                        		<div align='center'><span align='center' class='conteudo'>

                        			         ".$row["conteudo"]."	
                        		</div>
			                    <div align='right'>
			                         <font size='1px'>
			                          
											Puplicado em ".date("d/m/Y", strtotime($row["data"]))."

									  
			                         </font>  
			                        </div>
                        		<h1></h1>
                        		";
                        	}				

                        			  
							?>
                            <!--/ Titulo do aviso -->
                          
                        
                        
                        <div align="right"></div>
						
						 </p>

                </div>
              </div>
                </tr>
        </tbody>
    </table>

</div>
     
<?php 

	include "rodape.php";	
?>