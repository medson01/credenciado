<html>
<head>

<title>Titulo...</title></head>
<body>
<script>
if (confirm("� nesset�rio enviar este procedimento separadamente em uma �nica guia para an�lise.\\nEst� guia cont�m apenas ele.")) {
   //continua...
} else {
  history.back();
}
</script>
<div id="minhaDiv">Conteudo</div>
<button type="button" onClick="Mudarestado('minhaDiv')">Mostrar / Esconder</button>
</body>
</html>