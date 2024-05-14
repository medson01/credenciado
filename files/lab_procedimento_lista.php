<?php 
if(isset($_GET['id'])){
$sql = "SELECT procedimento.id, procedimento.codigo, procedimento.descricao, sadt_procedimento.qtd_proc, sadt_procedimento.data, sadt_procedimento.autorizado, sadt.data_sadt, sadt.data_aut, sadt.status, sadt.medico_solicitante FROM `sadt_procedimento` INNER JOIN sadt on sadt.id = sadt_procedimento.id_sadt INNER JOIN procedimento on procedimento.id = sadt_procedimento.id_proc WHERE sadt.id =".$_GET['id'];


			  
$stmt = $pdo->prepare($sql);	
$stmt->execute();

}
?>


<!-- Javascript carrega paginas e imvluir em tags -->
<script type="text/javascript">
 function exibir(id){
  window.location.href = "painel.php?lab=1&id="+id;
}
</script>



<!-- Mensagem ao passar o mouse -->
<script type="text/javascript" src="../js/wz_tooltip.js"></script>

<!-- Botão Modal Sair -->
<?php
if(isset($guia)){
  echo"  <script type='text/javascript' src='../js/modal_sair.js'></script>";
}
?>
<!-- Botão Excluir -->
<script type="text/javascript" src="../js/bnt_excluir.js"></script>

<!-- Botão internação -->
<script type="text/javascript" src="../js/bnt_internacao.js"></script>

<?php

//  require_once("pesquisar.php");

?>

<!-- pegar mes de consulta  -->
<script language="Javascript">
    function mudarmes(){
      var y = document.getElementById("ano").value;
      var x = document.getElementById("mes").value;
      if((x && y)){
      window.location.href = x+y;
      }
    }
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="panel panel-default">
  <div style="background-color:#CCCCCC"; text-align:center"> 
    <div align="center"><strong> Lista de Procedimentos  </strong> </div>
  </div>
	</br>

    <div align="left">
  	    <button type="button" class="btn btn-primary" style="width:87px" id="incluir" 
		<?php 
			if($_SESSION["perfil"] == "callcenter"){
				 echo" disabled "; 
			}
			if( !isset($matricula) || isset($status) && ( ($status == 3) || ($status == 2) ) ){ 
				 echo" disabled "; 
				 $bloque = " disabled "; 
			} 

		
		
		?> > Incluir </button>

      <!-- Botão para acionar procedimentos lista 
  	    <a id="btn_modal" type="hidden" data-toggle="modal" data-target="#myModal"></a></div>
  	  <br />-->
  <div class="panel-body">
    <table width="435" align="center" class="table table-striped" style="font-size: 12px" >

                <tr  style='font-weight:bold;'>
				 	<td ><div align='center'>Nº</div></td>
					<td ><div align='center'>Código</div></td>
					<td ><div align='center'>Des. Procesimento</div></td>
					<td ><div align="center">Quantidade</div></td>
					<td ><div align="center">Data Proc.</div></td>
					<td ><div align="center">Aurotizado</div></td>              
               </tr>
                          
              <?php

if(isset($_GET['id'])){
			    error_reporting(E_ALL ^ E_NOTICE);

                 if(isset($_GET['cont'])){
				 	
				 	$i = $_GET['cont'];
				 }
                 $i = 1;
                  while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
                         
                     
                         echo"    <tr > 
						 			<td ><div align='center'>".$i."</div></td>      
                                    <td ><div align='center'>".$registro["codigo"]."</div></td>";
									
									if($registro["codigo"] == '10101012'){
										echo '<script>	document.getElementById("incluir").disabled = true;	</script>';
									}
									
						echo"		<td ><div align='center'>".utf8_encode($registro["descricao"])."</div></td>
                                    <td ><div align='center' >".$registro["qtd_proc"]."</div></td>
                  					<td ><div align='center' >".date('d / m / Y', strtotime($registro["data"]))."</div></td>
									<td ><div align='center'>";
									$i++;
									
									if( ($_SESSION["perfil"] == "callcenter") || ($_SESSION["perfil"] == "administrador") ) {
										echo "<input type='checkbox' class='form-check-input' id='".$registro["id"]."' name='procedimento' value='".$registro["id"]."' ";
										if( ($registro["autorizado"] == 1) && (($registro["status"] == 2) || ($registro["status"] == 3 )) ){
											echo " checked disabled";
										}
								
										if( ($registro["autorizado"] == '') && ($registro["status"] == 3) ){
											echo "disabled";
										}								
										
										if( ($registro["status"] == 2) && ($_SESSION["perfil"] == "laboratorio") ){
											echo "disabled > ";
										}else{
											echo " > ";
										}
									}else{
										if( ($registro["status"] == 1) or ($registro["status"] == 2)) { 
											echo '';
										}elseif(($_SESSION["perfil"] == "clinica") || ($registro["autorizado"] == 1)){ 
											echo '<span class="glyphicon glyphicon-ok"></span>'; 
										}else{
											echo  '<span class="glyphicon glyphicon-remove"></span>'; 
										}
									}
						echo"			</div></td>		";

                        echo"      
									
                                </tr>";
                                      

                  }
                  
}
 
               
              ?>              
</table>

</div>
</div>