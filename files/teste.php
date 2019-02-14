<?php 
  
  //Arquivo de configura��o
  include "cabecalho.php";
	

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload de v�rios arquivos com PHP</title>
</head>
 
<body>
<h1>Upload de v�rios arquivos com PHP</h1>

<form action="teste_consulta.php" method="post" enctype="multipart/form-data">
<p><input type="file" name="arquivo[]" /></p>
<p><input type="file" name="arquivo[]" /></p>
<p><input type="file" name="arquivo[]" /></p>
<p><input type="file" name="arquivo[]" /></p>
<p><input type="file" name="arquivo[]" /></p>

<input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
<input class="form-control" type="text" placeholder="Input padrão">
<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">


<p><input type="submit" value="Enviar" /></p>


</form>


</body>
</html>