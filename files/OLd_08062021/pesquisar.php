
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

<div class="style1" style="position:relative; left:1px; top:-29px; right:180px; width: 600px; float: right;"> 

<div style="float:right">

  <div align="right">
    <select style="width:140px; font-size:12px; height:27px" class="form-control form-control-sm"  name="ano" id="ano" onchange="mudarmes()">
      <option value=""> Ano </option>
      <option  value="2021" <?php if(isset($_GET['mes']) && $year = "2021"){ echo "selected"; } ?> > 2021 </option>
      <option  value="2020" <?php if(isset($_GET['mes']) && $year = "2020"){ echo "selected"; } ?> > 2020 </option>
      <option  value="2019" <?php if(isset($_GET['mes']) && $year = "2019"){ echo "selected"; } ?> > 2019 </option>
      
    </select>
  </div>
</div>

<div style="float:right">

  <div align="right">
    <select style="width:140px; font-size:12px; height:27px" class="form-control form-control-sm"  name="mes" id="mes" onchange="mudarmes()">
      <option value=""> Mês </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=01" <?php if(isset($_GET['mes']) && $mes == "01"){ echo "selected"; } ?> > Janeiro </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=02" <?php if(isset($_GET['mes']) && $mes == "02"){ echo "selected"; } ?> > Fevereiro </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=03" <?php if(isset($_GET['mes']) &&  $mes == "03"){ echo "selected"; } ?> > Março </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=04" <?php if(isset($_GET['mes']) && $mes == "04"){ echo "selected"; } ?> > Abril </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=05" <?php if(isset($_GET['mes']) && $mes == "05"){ echo "selected"; } ?> > Maio </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=06" <?php if(isset($_GET['mes']) && $mes == "06"){ echo "selected"; } ?> > Junho </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=07" <?php if(isset($_GET['mes']) && $mes == "07"){ echo "selected"; } ?> > Julho </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=08" <?php if(isset($_GET['mes']) && $mes == "08"){ echo "selected"; } ?> > Agosto </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=09" <?php if(isset($_GET['mes']) && $mes == "09"){ echo "selected"; } ?> > Setembro </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=10" <?php if(isset($_GET['mes']) && $mes == "10"){ echo "selected"; } ?> > Outubro </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=11" <?php if(isset($_GET['mes']) && $mes == "11"){ echo "selected"; } ?> > Novembro </option>
      <option  value="painel.php?<?php echo "$y"; ?>=1&mes=12" <?php if(isset($_GET['mes']) && $mes == "12"){ echo "selected"; } ?> > Dezembro </option>
    </select>
  </div>
</div>

<div style="position:relative; float:left" >


<?php

 
      


      If( $_SESSION["perfil"] == "usuario"){  
         echo "<form name='frmBusca' method='get' action=". $_SERVER['PHP_SELF'] ."?c=buscar' >
                 <input type='search' class='form-control ds-input' id='search-input' placeholder='Pesquisar id , nome, matrícula' autocomplete='off' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top; width:320px; font-size:12px; height:27px' name='buscar'>
				 <input type='hidden' id='".$y."' name='".$y."' value='1'>
            </form>";
      }else{

        echo "<form name='frmBusca' method='get' action=". $_SERVER['PHP_SELF'] ."?c=buscar' >
                 <input type='search' class='form-control ds-input' id='search-input' placeholder='Pesquisar id , nome, matrícula' autocomplete='off' spellcheck='false' role='combobox' aria-autocomplete='list' aria-expanded='false' aria-owns='algolia-autocomplete-listbox-0' dir='auto' style='position: relative; vertical-align: top; width:320px; font-size:12px; height:27px' name='buscar'>
				 <input type='hidden' id='".$y."' name='".$y."' value='1'>
            </form>";
      }
?>
</div>
</div>