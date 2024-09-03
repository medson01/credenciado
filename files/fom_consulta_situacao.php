<?php 
	
	//Arquivo de configuraÃƒÂ§ÃƒÂ£o
	include "cabecalho.php";
	if(isset($_POST["matricula"])){
		 $matricula = substr($_POST["matricula"], -9, -3);
		
		      $sql = "SELECT * FROM `beneficiarios` WHERE matricula = ".$matricula." and titular = 1";
			  $stmt = $pdo->prepare($sql);
			  $stmt->execute();	
		 while($registro = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			    $frame_nome = $registro["nome"];
				$frame_matricula = $registro["matricula"];
				$frame_cpf = $registro["cpf"];
                      
              }
			}

 ?> 
 		<!-- Contteudo -->
            
            <td width="110" id="portal-column-content">

              
                <div>
                  <div id="region-content" class="documentContent">
                      
                    <div id="viewlet-above-content"></div>

                    <div id="content">
                      
                      			<div>

   									 <h1 class="documentFirstHeading"> Consulta de SituaÃ§Ã£o </h1>
                     			
								</div>
                    </div>


 
                    <p><br />
					</p>
					
					
<!-- FRAME PARA O SITE DO IPASEAL -->					
					
<style>

		div#IframePos {
			position: static;
			overflow:hidden;
			width: 750px;
			height: 900px;


		}
		

		
		 

</style>

<script type="text/javascript">
function iFrameHeight()
{
	var h = 0;
	if (!document.all)
	{
		h = document.getElementById('blockrandom').contentDocument.height;
		document.getElementById('blockrandom').style.height = h + 60 + 'px';
	} else if (document.all)
	{
		h = document.frames('blockrandom').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + 'px';
	}
}
</script>				  

<!--
<div id="IframePos" >
<center> <hn> Caro atendente, em caso de bloqueio do usuário, favor entrar em contato com o Ipaseal Saúde pelo número (82) 3315-3232 para verificar a situação. O horário de atendimento é das 08:00 hs às 17:00hs. </hn> </center>
	 <iframe src="iframe_form_consulta_situacao.php" height="900" width="100%" scrolling="no" style="border:none;"></iframe>
-->

 <div class="panel panel-info">
   	<div class="panel-heading">			Consulte o CPF do titular para a Consulta de Situa&ccedil;&atilde;o:	</div>
        <div class="panel-body">
	  <form name="consulta_situacao" id="consulta_situacao" action ="fom_consulta_situacao.php"  method="post" data-parsley-validate class="form-horizontal form-label-left">
        <br />
			&nbsp;&nbsp;&nbsp; Digite a matr&iacute;cula de qualquer componente familiar:
		    <input required="required" type="text" name="matricula" minlength="16" class="form-matric" id="matricula" size="20" maxlength="18" placeholder="00000000.000000.00" onchange="pegarMatricula()" />
			  <input name="submit" type="Submit" value="Pesquisar" class="btn btn-primary " />
		</form>
<hr />
		<?php 
			if(isset($frame_nome)){
			 		echo "&nbsp;&nbsp;&nbsp; Nome do titular : ".$frame_nome."<br>";
					echo "&nbsp;&nbsp;&nbsp; CPF : ".$frame_cpf."<br>";
					echo "&nbsp;&nbsp;&nbsp; Matr&iacute;cula: ".$frame_matricula;
					
					
			}
		
		?>
	  </div>
    </div>

 <div class="panel panel-info ">
      <div class="panel-heading">
        <div align="center">
          <p><strong>ATEN&Ccedil;&Atilde;O</strong></p>
          <p align="justify">
            <span >&nbsp;&nbsp;&nbsp;A CONSULTA DE SITUA&Ccedil;&Atilde;O apresenta as situa&ccedil;&otilde;es "Ativo" ou "Bloqueado" de cada componente fam&iacute;liar. Al&eacute;m disso, possibilita o pagamento dos meses em aberto atrav&eacute;s do link &quot;GERAR BOLETO&quot;,  que 15 minutos ap&oacute;s, o sistema dar&aacute; baixa automaticamente. Caso o usu&aacute;rio queira, ele ainda pode entra em contato com o financeiro do Ipaseal pelo WhatsApp (<strong>82</strong>) <strong>98812-9043</strong>.</span></p>
        </div>
      </div>

		

	<div id="IframePos">
<iframe id="blockrandom" name="iframe" src="http://sistemasweb.itec.al.gov.br/ipaseal/situacao_contrato/" width="100%" height="800"  scrolling="no"  style="border:none;" class="wrapper">
	Esta opÃ§Ã£o nÃ£o irÃ¡ funcionar corretamente. Infelizmente, seu navegador nÃ£o suporta frames.</iframe>
</div>
	   
		       

          </tr>
        </tbody>
    </table>
	
</div>
     
<?php 

	include "rodape.php";	
?>