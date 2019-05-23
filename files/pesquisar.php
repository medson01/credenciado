
<?php

    switch ($sub_menu) {
      case '1':
        # code...
        break;
      
      case '1':
        # code...
        break;
        
    }
?>

<div class="style1" style="position:relative; left:1px; top:-29px; right:180px; width: 500px; float: right;"> 

<div style="float:right">

  <div align="right">
    <select style="width:140px; font-size:12px; height:27px" class="form-control form-control-sm"  name="mes" id="mes" onchange="mudarmes()">
      <option  value="" > ... </option>
      <option  value="painel.php?pa=1&mes=01"<?php  if($mes == '01'){ echo "selected"; } ?>>Janeiro </option>
      <option  value="painel.php?pa=1&mes=02"<?php  if($mes == '02'){ echo "selected"; } ?>>Fevereiro</option>
      <option  value="painel.php?pa=1&mes=03"<?php  if($mes == '03'){ echo "selected"; } ?>>Março</option>
      <option  value="painel.php?pa=1&mes=04"<?php  if($mes == '04'){ echo "selected"; } ?>>abril</option>
      <option  value="painel.php?pa=1&mes=05"<?php  if($mes == '05'){ echo "selected"; } ?>>Maio</option>
      <option  value="painel.php?pa=1&mes=06"<?php  if($mes == '06'){ echo "selected"; } ?>>Junho</option>
      <option  value="painel.php?pa=1&mes=07"<?php  if($mes == '07'){ echo "selected"; } ?>>Julho</option>
      <option  value="painel.php?pa=1&mes=08"<?php  if($mes == '08'){ echo "selected"; } ?>>Agosto</option>
      <option  value="painel.php?pa=1&mes=09"<?php  if($mes == '09'){ echo "selected"; } ?>>Setembro</option>
      <option  value="painel.php?pa=1&mes=10"<?php  if($mes == '10'){ echo "selected"; } ?>>Outubro</option>
      <option  value="painel.php?pa=1&mes=11"<?php  if($mes == '11'){ echo "selected"; } ?>>Novembro</option>
      <option  value="painel.php?pa=1&mes=12"<?php  if($mes == '12'){ echo "selected"; } ?>>dezembro</option>
    </select>
  </div>
</div>

<div style="position:relative; float:left" >
<?php  
      If( $_SESSION["perfil"] == "usuario"){  
         echo "<form name='frmBusca' method='get' action=". $_SERVER['PHP_SELF'] ."?c=buscar' >
                 <input type='search' class='form-control ds-input' id='search-input' placeholder='Pesquisar...' autocomplete='off' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top; width:350px; font-size:12px; height:27px' name='buscar'>
				 <input type='hidden' id='pa' name='pa' value='1'>
            </form>";
      }else{

        echo "<form name='frmBusca' method='get' action=". $_SERVER['PHP_SELF'] ."?c=buscar' >
                 <input type='search' class='form-control ds-input' id='search-input' placeholder='Pesquisar...' autocomplete='off' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top; width:350px; font-size:12px; height:27px' name='buscar'>
				 <input type='hidden' id='pa' name='pa' value='1'>
            </form>";
      }
?>
</div>
</div>