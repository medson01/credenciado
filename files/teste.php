
<script type="text/javascript">
var segundo = 0 + "0";
var minuto = 0 + "0";
var hora = 0 + "0";



function tempo() {
  if (segundo < 59) {
    segundo++
    if (segundo < 10) {
      segundo = "0" + segundo
    }
  } else
  if (segundo == 59 && minuto < 59) {
    segundo = 0 + "0";
    minuto++;
    if (minuto < 10) {
      minuto = "0" + minuto
    }
  }
  if (minuto == 59 && segundo == 59 && hora < 23) {
    segundo = 0 + "0";
    minuto = 0 + "0";
    hora++;
    if (hora < 10) {
      hora = "0" + hora
    }
  } else
  if (minuto == 59 && segundo == 59 && hora == 23) {
    segundo = 0 + "0";
    minuto = 0 + "0";
    hora = 0 + "0";
  }
  

	document.getElementById("hora").innerHTML = hora;
	document.getElementById("minuto").innerHTML = minuto;
	document.getElementById("segundo").innerHTML = segundo;


}
</script>

<html>

<body>


<button type="button" onclick="setInterval('tempo()',983);return false;">Iniciar Cronômetro</button>
<span id="hora"></span>:<span id="minuto"></span>:<span id="segundo"></span>
</html>