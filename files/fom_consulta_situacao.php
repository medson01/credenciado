<?php 
	
	//Arquivo de configuraÃ§Ã£o
	include "cabecalho.php";


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
	 <iframe src="iframe_form_consulta_situacao.php" height="900" width="100%" scrolling="no" style="border:none;"></iframe>
-->
	<div id="IframePos">
<iframe id="blockrandom" name="iframe" src="http://sistemasweb.itec.al.gov.br/ipaseal/situacao_contrato/" width="100%" height="500"  scrolling="no"  style="border:none;" class="wrapper">
	Esta opção não irá funcionar corretamente. Infelizmente, seu navegador não suporta frames.</iframe>
</div>
	   
		       

          </tr>
        </tbody>
    </table>
	
</div>
     
<?php 

	include "rodape.php";	
?>