<html>
<head>

<title>Titulo...</title></head>
<body>
<script>
if (confirm("É nessetário enviar este procedimento separadamente em uma única guia para análise.\\nEstá guia contém apenas ele.")) {
   //continua...
} else {
  history.back();
}
</script>
<div id="minhaDiv">Conteudo</div>
<button type="button" onClick="Mudarestado('minhaDiv')">Mostrar / Esconder</button>
</body>
</html>