<?php
require_once("Controller.php");

$obj = new Controller();
$table = $obj->selectDB();


?>


    <!-- CSS Telefone -->
    <link rel="stylesheet" type="text/css" href="../css/modal.css"/>

    <!-- Botão saida -- >
    <script type='text/javascript' src='../js/bnt_sair.js'></script>


    <!-- The Modal -->
    <style type="text/css">
<!--
.style1 {color: #8B0000}
-->
    </style>
    <div id="myModal" class="modal">

  <!-- Modal content -->



<div class="modal-content">
    <div class="modal-header">
         <div align="center"><span class="close" style="color:#000000">&times;</span>
         </div>
    </div>   
    <div class="modal-body">
        <table width="100%" border="0">
            <tr>
                <div id="conteudo" style="display: block;">
                    <?php echo $table; ?> 
                </div>
				    <p id="demo"></p>
            </tr>
		</table>
			</div>&nbsp;</p>
</div>

	
<!-- Botão Sair -->
<script type="text/javascript" src="../js/modal_sair.js"></script>
<!-- teste -->
<script type="text/javascript" src="js/fingertechweb.js"></script>

	
	
   

  