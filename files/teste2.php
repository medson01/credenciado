<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<script>
function calcular() {
  var n1 = parseInt(document.getElementById('qtd_eletivas').value, 10);
  var n2 = parseInt(document.getElementById('qtd_emergencias').value, 10);
  var n3 = parseInt(document.getElementById('qtd_visitas').value, 10);
  
  if(!n1){
  	n1 = 0;
  }
  if(!n2){
  	n2 = 0;
  }
    if(!n3){
  	n3 = 0;
  }
  
  
  document.getElementById('quantidade').value = n1 + n2 + n3;
}
</script>
<form action="" method="post">
  N1: <input class="form-control form-control-sm" type="text" name="qtd_eletivas" id="qtd_eletivas"  maxlength="3"  size="10" onblur="calcular()"/> <br> 
  N2: <input class="form-control form-control-sm" type="text" name="qtd_emergencias" id="qtd_emergencias"  maxlength="3"  size="10" onblur="calcular()"/> <br>
  N3: <input class="form-control form-control-sm" type="text" name="qtd_visitas" id="qtd_visitas"  maxlength="3" size="10"  onblur="calcular()"/> <br>

  RESULTADO  <input class="form-control form-control-sm" type="text" name="quantidade" id="quantidade"  maxlength="3" size="10"
</form>

<div id="resultado"></div>
</body>
</html>
