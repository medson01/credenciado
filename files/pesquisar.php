
<?php

    switch ($sub_menu) {
      case '1':
        # code...
        break;
      
      case '1':
        # code...
        break;
        
    }


      if(isset($_GET["int"])){ 
          $y = "int";
      }
      if(isset($_GET["pa"])){ 
          $y = "pa";
      }


?>

<div class="style1" style="position:relative; left:1px; top:-29px; right:180px; width: 500px; float: right;"> 

<div style="float:right">

  <div align="right">
    <select style="width:140px; font-size:12px; height:27px" class="form-control form-control-sm"  name="mes" id="mes" onchange="mudarmes()">
      <option  value="" > ... </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=01">Janeiro </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=02">Fevereiro</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=03">Março</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=04">abril</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=05">Maio</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=06">Junho</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=07">Julho</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=08">Agosto</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=09">Setembro</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=10">Outubro</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=11">Novembro</option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=12">dezembro</option>
    </select>
  </div>
</div>

<div style="position:relative; float:left" >


<?php

 
      


      If( $_SESSION["perfil"] == "usuario"){  
         echo "<form name='frmBusca' method='get' action=". $_SERVER['PHP_SELF'] ."?c=buscar' >
                 <input type='search' class='form-control ds-input' id='search-input' placeholder='Pesquisar...' autocomplete='off' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top; width:350px; font-size:12px; height:27px' name='buscar'>
				 <input type='hidden' id='".$y."' name='".$y."' value='1'>
            </form>";
      }else{

        echo "<form name='frmBusca' method='get' action=". $_SERVER['PHP_SELF'] ."?c=buscar' >
                 <input type='search' class='form-control ds-input' id='search-input' placeholder='Pesquisar...' autocomplete='off' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top; width:350px; font-size:12px; height:27px' name='buscar'>
				 <input type='hidden' id='".$y."' name='".$y."' value='1'>
            </form>";
      }
?>
</div>
</div>