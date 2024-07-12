
<?php 
  		      # Corrige o erro de acentuação no banco
				mysqli_query($conn,"SET NAMES 'utf8'");

$id = $_GET["id"];

    

         	 $sql = "SELECT acomodacao.nome as acomodacao
                     FROM `prorrogacao` 
                     INNER JOIN internamento on internamento.id = prorrogacao.id_internamento 
                     INNER JOIN acomodacao on acomodacao.id = prorrogacao.id_acomodacao 
                     WHERE internamento.id =".$id."
					 ORDER BY prorrogacao.id DESC limit 1
					 ";
			  $stmt1 = $pdo->prepare($sql1);
			  $stmt1->execute();

                      
                                while($aquivos = $stmt1->fetch(PDO::FETCH_ASSOC)){ 

                                  $acomodacao = $registro[0];

                                   
                             }

      
	   					


?>               

                  
<style type="text/css">
<!--
.style3 {color: #000000}
.style5 {color: #000000; font-weight: bold; }
.style13 {font-size: 10px}
-->
                     </style>
                     <label> </label>
                      <div align="center">
					  
		
          
          <form name="acomodacao" id="acomodacao" action ="internacao_acomodacao_update.php" method="post" data-parsley-validate class="form-horizontal form-label-left">
   		  
                        <table width="100% " border="0" align="center">
    
                          <tr>
                         <td colspan="3" bgcolor="#999999" style="font-weight:bold; font-size:14px;" scope='col'><div align="center">
					     </div>
						  <input type="hidden" name="id"  />						  </td>
                          </tr>
                          
                          <td colspan="3" bgcolor="#CCCCCC"><div align="center" class="style5">Alteração de Acomodação</div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                            <td ><span class="style13"> Acomodação atual </span><br />
                              <input name="atual_acomodacao" type="text" class="form-control input-sm" style="font-size: 10px"  size="44" required="required" <?php echo "value='".$acomodacao."' readonly='true'  "; ?> />
                              </span></td>
                            <td>&nbsp;</td>
                            <td><span class="style13">Alterar para:</span><br />
                               <select name='id_acomodacao' class='form-control input-sm' >
                  <?php 


                   while($registro = mysqli_fetch_assoc($query)){

                       echo '<option value="'.$registro["id"].'">'.$registro["nome"].'</option>';
                                                                                              
                    }
                              
                  
                  ?>
                                </select> </td>
                            </tr>

                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" ><span class="style13">Justificativa da prorrogação 
                                <textarea class="form-control input-sm" name="motivo"  style="font-size:12px; margin: 0px; height: 100px; width: 100%;" form="acomodacao" placeholder="Entre com o texto aqui..."> 

                               

                                </textarea>
                              </span></td>
                            </tr>

                                                        <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td><span class="style13">                                           <div align="right">

                             <a href="painel.php?pa=1" >
                            
                               
                            
                              </a>
                            </div></td>
                              <td>                              </td>
                              <td>
                                <div align="right">

                                  <input name="id_internamento" type="hidden" value="<?php echo $id; ?>" />  

                                  <input name="submit" type="Submit" value=" Aplicar " class="btn btn-primary "/>  


                                </div></td>
                            </tr>
                            <tr>
                              <td colspan="3" >&nbsp;</td>
                            </tr>
                            
                            <tr>
                            
                            <td></td>
                          </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          <tr>
                            <td >&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><div align="right"><strong>

                             

                            </strong></div></td>
                          </tr>
                        </table>
                     <br />
                        <br /> 
                      
                      <div align="center"><br />
                        <br />
                        <br />
                        <br />
                      
                        <br />
                        <br />
                        <br />
                      </div>
                </form>
                

             
          
  