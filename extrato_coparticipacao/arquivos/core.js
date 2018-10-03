function input_focus(id)
{
	$("#l"+id).addClass('lcurrent');
}

function input_blur(id)
{
	$("#l"+id).removeClass('lcurrent');
}

function sendContact()
{
	// check for email
	var email = $("#email").val();
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	if(!filter.test(email))	
	{
		$("#email-error").slideDown(200);
		$("#email").focus();
		return false;
	}
	else
		$("#email-error").slideUp(500);
	
	// check for message
	var msg = $("#message").val();
	if(msg.length == 0)
	{
		$("#message-error").slideDown(500);
		$("#message").focus();
		return false;
	}
	else
		$("#message-error").slideUp(500);
	
	var data = $("#contact_form > form").serialize();

	$.ajax({
		type: "POST",
		url: "contato.send.asp",
		data: data,
		cache: false,
		success: function(msg){
		}
	});
	
	$("#contact_form").fadeOut(1000, function() {
		$("#message_sent").slideDown(500);
	});
	
	
	return false;
}

var captcha_a = Math.ceil(Math.random() * 10);
var captcha_b = Math.ceil(Math.random() * 10);       
var captcha_c = captcha_a + captcha_b;
function generate_captcha(id)
{
	var id = (id) ? id : 'lcaptcha';
	$("#"+id).html(captcha_a + " + " + captcha_b + " = ");
}

var jGalleryTimer = 0;
var jGalleryFirstStart = true;
var jGallery_action = false;
function jGallery(id, visible, timeInterval, transitionInterval)
{
	var visible = (visible) ? visible : 1;
	var timeInterval = (timeInterval) ? timeInterval : 9000;
	var transitionInterval = (transitionInterval) ? transitionInterval : 200;
	var w = (w) ? w : $("."+id+"-gallery-div :first").width();
	var cnt = $("#gallery-"+id+"-holder > div").size();
	
	if(jGalleryTimer)
	{
		clearInterval(jGalleryTimer);
		jGalleryTimer = 0;
	}
	
	if(!jGalleryFirstStart)
	{
		if(!jGallery_move(id, cnt, -1, w, visible, transitionInterval))
			jGallery_restart(id, cnt, transitionInterval);
	}
	
	jGalleryFirstStart = false;
	
	jGalleryTimer = setInterval(function(){ jGallery(id, visible, timeInterval, transitionInterval); }, timeInterval);
}

function jGallery_move(id, cnt, dir, w, visible, transitionInterval)
{
	if(jGallery_action)
		return false;
		
	var curr = document.getElementById("gallery-"+id+"-holder").style.left;
	curr = parseFloat(curr);

	if(isNaN(curr))
		curr = 0;
	if(dir > 0)
	{
		if(curr >= 0)
			return false;
	}
	else
	{
		if(curr + cnt * w - visible * w <= 0)
			return false;
	}

	jGallery_action = true;
	var offset = w;

	if(dir < 0)
		dir = "-";
	else
		dir = "+";
		
	$("#gallery-"+id+"-holder").animate(
		{left : dir+"="+offset+"px"},
		{queue:true, duration:transitionInterval, complete: function() {jGallery_action = false;}}
	);
	
	return true;
}

function jGallery_restart(id, cnt, transitionInterval)
{
	if(jGallery_action)
		return false;
		
	var curr = document.getElementById("gallery-"+id+"-holder").style.left;
	curr = parseFloat(curr);

	if(isNaN(curr))
		curr = 0;
	if(curr >= 0)
		return false;

	jGallery_action = true;
	var offset = curr * (-1);

	$("#gallery-"+id+"-holder").animate(
		{left : "+="+offset+"px"},
		{queue:true, duration:transitionInterval*cnt, complete: function() {jGallery_action = false;}}
	);
	
	return true;
}

var jMenu_timeout    = 500;
var jMenu_effectTime = 200;
var jMenu_closetimer = 0;
var jMenu_ddmenuitem = 0;
var jMenu_openid = 0;
var jMenu_action = false;
function jMenu_open()
{
	jMenu_canceltimer();
	
	if($("a", this).html() == jMenu_openid)
		return;
		
	if(jMenu_action)
		return;
		
	jMenu_close();

	if($("ul", this).size() == 0)
		return;
	
	jMenu_action = true;
	jMenu_ddmenuitem = $(this).find('ul').slideDown(jMenu_effectTime, function() {jMenu_action = false;});
	jMenu_openid = $("a", this).html();
	if (document.getElementById('ul'))
		document.getElementById('ul').className = 'current';
}

function jMenu_close()
{
	if(jMenu_action)
		return;
			
	if(jMenu_ddmenuitem)
	{
		jMenu_action = true;
		jMenu_ddmenuitem.fadeOut(jMenu_effectTime, function() {jMenu_action = false;});
		jMenu_ddmenuitem = null;
		jMenu_openid = null;
	}
}

function jMenu_timer()
{
	jMenu_closetimer = window.setTimeout(jMenu_close, jMenu_timeout);
}

function jMenu_canceltimer()
{
	if(jMenu_closetimer)
	{
		window.clearTimeout(jMenu_closetimer);
		jMenu_closetimer = null;
	}
}

$(document).ready(function() {
	$('#jMenu > li').bind('mouseover', jMenu_open)
	$('#jMenu > li').bind('mouseout',  jMenu_timer)
	$('#jMenu > li > ul').bind('mouseover',  jMenu_canceltimer)
	$('#jMenu > li > ul > li').bind('mouseover',  jMenu_canceltimer)
});

document.onclick = jMenu_close;

function submeter(url){
	document.frm_principal.action = url;
	document.frm_principal.submit();
}

/****
 * Mensagens
 **********************/

var _mensagemGlobal = new Array(100);
var CD_CAMPO_SUBSTITUICAO = "[[*]]";

_mensagemGlobal[0] = "Obs: Campo obrigatório.";
_mensagemGlobal[1] = "Obs: Campo não obrigatório.";
_mensagemGlobal[2] = "Campo obrigatório!";
_mensagemGlobal[3] = "Confirma?";
_mensagemGlobal[4] = "Aguarde...";
_mensagemGlobal[5] = "Letra inválida.";

_mensagemGlobal[10] = "CPF inválido!";
_mensagemGlobal[11] = "CNPJ inválido!";
_mensagemGlobal[12] = "Radical do CNPJ inválido!";

_mensagemGlobal[29] = "Placa inválida!";
_mensagemGlobal[30] = "Campo numérico inválido!";
_mensagemGlobal[31] = "Campo moeda inválido!";
_mensagemGlobal[32] = "O valor máximo permitido é " + CD_CAMPO_SUBSTITUICAO + "!";
_mensagemGlobal[33] = "O valor mínimo permitido é " + CD_CAMPO_SUBSTITUICAO + "!";


// Verifica se a tecla digitada trata-se de uma tecla funcional
function isTeclaFuncional(pEvento, pIgnorarBackSpace) {
	var retorno = false;

	if (pEvento != null) {
		keyCode = pEvento.keyCode;
		//alert(keyCode);
		
		switch(keyCode) {
			case 8  : 
				if (pIgnorarBackSpace) {
					retorno = false;
				} else {
					retorno = true;
				}
				break; //
			case 9  : retorno = true;break; //
			case 13 : retorno = true;break; //enter
			case 16 : retorno = true;break; //
			case 17 : retorno = true;break; //
			case 27 : retorno = true;break; //esc
			case 35 : retorno = true;break; //
			case 36 : retorno = true;break; //
			case 37 : retorno = true;break; //
			case 38 : retorno = true;break; //
			case 39 : retorno = true;break; //
			case 40 : retorno = true;break;	//
		}
	}

	return retorno;
}

// Coloca o foco no campo pCampo
function focarCampo(pCampo){ 
    if ((pCampo.type != "hidden") && (pCampo.readOnly != true) && (pCampo.disabled != true)) {
        pCampo.focus();
    }
}

// Exibe uma mensagem pop-up no browser
function exibirMensagem(pMensagem) {
	alert(pMensagem);
}


function validarCampoDecimal(pCampo, pQtCasasDecimais, pEvento) {
	var str = pCampo.value;
	var menos = "";
	var inTemCaracterInvalido = false;
	
	if (isTeclaFuncional(pEvento)) {
		return;
	}

	for (loop = 0; loop < str.length;) {
		if ((str.charAt(loop) < '0' || str.charAt(loop) > '9') && str.charAt(loop) != '-' && str.charAt(loop) != ',') {
			str = str.substring(0, loop) + str.substring(loop + 1);
			inTemCaracterInvalido = true;
		} else {
			loop++;
		}
	}
	while (str.indexOf(',') > 0 && str.indexOf(',') < str.length - pQtCasasDecimais - 1) {
		str = str.substring(0, str.length - 1);
		inTemCaracterInvalido = true;
	}
	while (str.indexOf('-') > 0 || str.indexOf('-') != str.lastIndexOf('-')) {
		str = str.substring(0, str.lastIndexOf('-')) + str.substring(str.lastIndexOf('-') + 1);
		inTemCaracterInvalido = true;
	}

	if (inTemCaracterInvalido) {
		pCampo.value = str;
	}
	
	return true;
}

/**
 * Autor : Alysson Barros
 * Última modificação :	11/07/2001			Responsável : Autor
 ***************/
function validaEmail(objeto) {
	var email = objeto.value;
	var s = new String(email);
	var retorno = true;

	// Se o email for vazio, retorne verdadeiro.
	if (email == "") return true;

	// { } ( ) < > [ ] | \ /
	if ((s.indexOf("{")>=0) || (s.indexOf("}")>=0) || (s.indexOf("(")>=0) || (s.indexOf(")")>=0) || (s.indexOf("<")>=0) || (s.indexOf(">")>=0) || (s.indexOf("[")>=0) || (s.indexOf("]")>=0) || (s.indexOf("|")>=0) || (s.indexOf("\"")>=0) || (s.indexOf("/")>=0))
		retorno = false;
	// & * $ % ? ! ^ ~ ` ' "
	if ((s.indexOf("&")>=0) || (s.indexOf("*")>=0) || (s.indexOf("$")>=0) || (s.indexOf("%")>=0) || (s.indexOf("?")>=0) || (s.indexOf("!")>=0) || (s.indexOf("^")>=0) || (s.indexOf("~")>=0) || (s.indexOf("`")>=0) || (s.indexOf("'")>=0) )
		retorno = false;
	// , ; : = #
	if ((s.indexOf(",")>=0) || (s.indexOf(";")>=0) || (s.indexOf(":")>=0) || (s.indexOf("=")>=0) || (s.indexOf("#")>=0) )
		retorno = false;
	// procura se existe apenas um @
	if ( (s.indexOf("@") < 0) || (s.indexOf("@") != s.lastIndexOf("@")) )
		retorno = false;
	// verifica se tem pelo menos um ponto após o @
	if (s.lastIndexOf(".") < s.indexOf("@"))
		retorno = false;
	// verifica se existe pelo menos um caracter antes do @
	if (s.substr(0,1) == '@')
		retorno = false;
	
	if (!retorno){
		alert("Email inválido, favor digitar novamente!");
		objeto.focus();
		objeto.select();
	}
	
	return retorno;
}

/**
 * Valida o preenchimento do campo numerico "pCampo" passado como parametro
 * Deve ser chamada no evento onkeyup do componente input text
 ************/
function validarCampoNumerico(pCampo, pEvento) {
	var str = pCampo.value;
	var tam = str.length;

	if (isTeclaFuncional(pEvento)) {
		return;
	}

	var filtro = /^-{0,1}([0-9])*$/;

	if (!filtro.test(str)) {
		pCampo.value = str.substr(0, tam - 1)
		pCampo.select();
		exibirMensagem(_mensagemGlobal[30]);
		focarCampo(pCampo);
	}
}

/**
 * Valida os nome
 */
function validarCampoNome(pCampo, pEvento) {
	var str = pCampo.value.toUpperCase();
	var tam = str.length;

	if (isTeclaFuncional(pEvento)) {
		return;
	}

	var filtro = /^[A-Z- ]*$/;

	if (!filtro.test(str)) {
		pCampo.value = str.substr(0, tam - 1)
		pCampo.select();
		exibirMensagem(_mensagemGlobal[5]);
		focarCampo(pCampo);
	}
}


/**
 * Função para contar a quantidade de caracteres
 * Em 13/09/2008
 */
function verificaTamanho(target){
		//alert(target);
		var StrLen = 0;
		var corte = 0;
		var maximo = 250;

		if (document.frm_principal.ANUNCIO_DS_TEXTO.value.length != "" ){
			StrLen = StrLen + document.frm_principal.ANUNCIO_DS_TEXTO.value.length;
		}
		if (StrLen == 1 && document.frm_principal.ANUNCIO_DS_TEXTO.value.substring(0,1) == " "){
        	document.frm_principal.msg.value = "";
			StrLen = StrLen - 1;
    	}
    	if (StrLen > maximo){
			document.frm_principal.ANUNCIO_DS_TEXTO.value = document.frm_principal.ANUNCIO_DS_TEXTO.value.substring(0,maximo-corte);
			StrLen = StrLen - 1;
		}
       document.frm_principal.caract.value = maximo - StrLen;
}

function voltar(){
	if(confirm('tem certeza que desejar desistir da publicação do anúncio?')){
		document.form.action = "default.asp";
		document.form.submit();
	}
}

// Valida o preenchimento do campo moeda "pCampo" passado como parâmetro
function formatarCampoMoeda(pCampo, pQtCasasDecimais, pEvento) {
	var str = pCampo.value;
	var inTemCaracterInvalido = false;
	
	if (isTeclaFuncional(pEvento)) {
		return;
	}

	for (loop = 0; loop < str.length;) {
		if ((str.charAt(loop) < '0' || str.charAt(loop) > '9') && str.charAt(loop) != '-' && str.charAt(loop) != ',') {
			str = str.substring(0, loop) + str.substring(loop + 1);
			inTemCaracterInvalido = true;
		} else {
			loop++;
		}
	}
	while (str.indexOf(',') > 0 && str.indexOf(',') < str.length - pQtCasasDecimais - 1) {
		str = str.substring(0, str.length - 1);
		inTemCaracterInvalido = true;
	}
	while (str.indexOf('-') > 0 || str.indexOf('-') != str.lastIndexOf('-')) {
		str = str.substring(0, str.lastIndexOf('-')) + str.substring(str.lastIndexOf('-') + 1);
		inTemCaracterInvalido = true;
	}

	if (inTemCaracterInvalido) {
		pCampo.value = str;
	}
	
	return true;
}

// Valida o preenchimento do campo moeda "pCampo" passado como parâmetro
function formatarCampoMoedaPositivo(pCampo, pQtCasasDecimais, pEvento) {
	var str = pCampo.value;
	var inTemCaracterInvalido = false;
	
	if (isTeclaFuncional(pEvento)) {
		return;
	}

	for (loop = 0; loop < str.length;) {
		if ((str.charAt(loop) < '0' || str.charAt(loop) > '9') && str.charAt(loop) != ',') {
			str = str.substring(0, loop) + str.substring(loop + 1);
			inTemCaracterInvalido = true;
		} else {
			loop++;
		}
	}
	while (str.indexOf(',') > 0 && str.indexOf(',') < str.length - pQtCasasDecimais - 1) {
		str = str.substring(0, str.length - 1);
		inTemCaracterInvalido = true;
	}

	if (inTemCaracterInvalido) {
		pCampo.value = str;
	}
	
	return true;
}

// Valida o preenchimento do campo moeda "pCampo" passado como parâmetro
function formatarCampoMoedaComSeparadorMilhar(pCampo, pQtCasasDecimais, pEvento) {

	var vlCampo = pCampo.value;
	var tam = vlCampo.length;
	var isNegativo = false;

	if (isTeclaFuncional(pEvento, true)) {
		return;
	}

	if (tam == 0) {
		return;
	}

	// Tira os '.'
	while (vlCampo.indexOf(".") != -1) {
		vlCampo = vlCampo.replace(".", "");
	}
	// Tira as ','
	while (vlCampo.indexOf(",") != -1) {
		vlCampo = vlCampo.replace(",", "");
	}
	// Tira os espacos em branco
	while (vlCampo.indexOf(" ") != -1) {
		vlCampo = vlCampo.replace(" ", "");
	}

	var filtro = /^-{0,1}([0-9])*$/;
	if (!filtro.test(vlCampo)) {
		pCampo.value = pCampo.value.substr(0, tam - 1);
		pCampo.select();
		exibirMensagem(_mensagemGlobal[31]);
		focarCampo(pCampo);
		return;
	}

	// Trata sinal de menos
	if (vlCampo.indexOf("-") == 0) {
		vlCampo = vlCampo.replace("-", "");
		isNegativo = true;
	}

	// Quando o campo está em branco é preciso completar com zeros a esquerda
	if (vlCampo.length <= pQtCasasDecimais) {
		var tamAux = vlCampo.length;
		for (i = tamAux; i < (pQtCasasDecimais); i++) {
			vlCampo = "0" + vlCampo;
		}
	}
	
	var divisor = Math.pow(10, pQtCasasDecimais);
	var vlCampoFloat = parseFloat(vlCampo) / divisor;

	vlCampo = getValorMoedaComoStringComSeparadorMilhar(vlCampoFloat, pQtCasasDecimais, true);

	if (isNegativo) {
	  vlCampo = "-" + vlCampo;
	}

	pCampo.value = vlCampo;
}

// Valida o preenchimento do campo moeda "pCampo" passado como parâmetro
function formatarCampoMoedaPositivoComSeparadorMilhar(pCampo, pQtCasasDecimais, pEvento) {
	var str = pCampo.value;
	var inTemCaracterInvalido = false;

	for (loop = 0; loop < str.length;) {
		if ((str.charAt(loop) < '0' || str.charAt(loop) > '9') && str.charAt(loop) != ',' && str.charAt(loop) != '.') {
			str = str.substring(0, loop) + str.substring(loop + 1);
			inTemCaracterInvalido = true;
		} else {
			loop++;
		}
	}

	if (inTemCaracterInvalido) {
		pCampo.value = str;
	}

	formatarCampoMoedaComSeparadorMilhar(pCampo, pQtCasasDecimais, pEvento);
}

// Formata o valor como campo CNPF ou CNPJ de acordo como tamanho
function formatarCampoCNPFouCNPJ(pCampo, pEvento) {
	var vlCampo = pCampo.value;
	var tam = vlCampo.length;

	// Tira os '.'
	while (vlCampo.indexOf('.') != -1) {
		vlCampo = vlCampo.replace('.', '');
	}
	// Tira os '-'
	while (vlCampo.indexOf('-') != -1) {
		vlCampo = vlCampo.replace('-', '');
	}
	
	// Tira os '/'
	while (vlCampo.indexOf('/') != -1) {
		vlCampo = vlCampo.replace('/', '');
	}
	
	tam = vlCampo.length;
	
	
	if (tam > 14) {
		tam = 14;
		vlCampo = vlCampo.substr(0, 14);
	}
			
	if ((tam < 11 ) || (tam > 11 && tam < 14)){
		return;	
	}
	if (tam == 11 ){
		formatarCampoCNPF(pCampo, pEvento)
	}else if (tam == 14 ){
		formatarCampoCNPJ(pCampo, pEvento)
	}
}

// Valida o valor como campo CNPF ou CNPJ de acordo como tamanho
function isCampoCNPFouCNPJValido(pCampo, pInObrigatorio, pSemMensagem) {
  var vlCampo = pCampo.value;
  var tam = vlCampo.length;

	if (tam <= 14) {
		return isCampoCNPFValido(pCampo, pInObrigatorio, pSemMensagem);
	}else{
		return isCampoCNPJValido(pCampo, pInObrigatorio, pSemMensagem);	
	}
}

// Formata o campo CNPF "pCampo" passado como parâmetro
function formatarCampoCNPF(pCampo, pEvento) {
	var vlCampo = pCampo.value;
	var tam = vlCampo.length;

	if (isTeclaFuncional(pEvento)) {
		return;
	}

	// Tira os '.'
	while (vlCampo.indexOf('.') != -1) {
		vlCampo = vlCampo.replace('.', '');
	}
	// Tira os '-'
	while (vlCampo.indexOf('-') != -1) {
		vlCampo = vlCampo.replace('-', '');
	}
	// Caso seja grande demais, trunca.
	var tamanho = vlCampo.length;
	if (tamanho > 11) {
		tamanho = 11;
		vlCampo = vlCampo.substr(0, 11);
	}

	var filtro = /^([0-9])*$/;
	if (!filtro.test(vlCampo)) {
		pCampo.select();
		exibirMensagem(_mensagemGlobal[10]);
		pCampo.value = pCampo.value.substr(0, tam - 1);
		focarCampo(pCampo);
		return;
	}

	if (tamanho > 3 && tamanho <= 6) {
		vlCampo = vlCampo.substr(0, 3) + '.' + vlCampo.substr(3);
	} else if (tamanho > 6 && tamanho <= 9) {
		vlCampo = vlCampo.substr(0, 3) + '.' + vlCampo.substr(3, 3) + '.' + vlCampo.substr(6);
	} else if (tamanho > 9) {
		vlCampo = vlCampo.substr(0, 3) + '.' + vlCampo.substr(3, 3) + '.' + vlCampo.substr(6, 3) + '-' + vlCampo.substr(9);
	}

	pCampo.value = vlCampo;

	if (tamanho >= 11) {
		isCampoCNPFValido(pCampo);
	}
}

// Valida o campo CNPF "pCampo" passado como parâmetro
function isCampoCNPFValido(pCampo, pInObrigatorio, pSemMensagem) {
	var msg = "";
	var vlCampo = pCampo.value;

	if (pInObrigatorio != null) {
		if (pInObrigatorio) {
			if (pCampo.className == "campoobrigatorio") {
				msg = "\n" + _mensagemGlobal[0];
			} else {
				msg = "\n" + _mensagemGlobal[2];
			}

		} else {
			msg = "\n" + _mensagemGlobal[1];

			if (vlCampo == "")
				return true;
		}
	}

	var filtro = /^([0-9.-])*$/;
	if (!filtro.test(vlCampo)) {
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[10] + msg);
			focarCampo(pCampo);
		}

		return false;
	}

	x = 0;
	soma = 0;
	dig1 = 0;
	dig2 = 0;
	texto = "";

	if (vlCampo.length != 14) {
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[10] + msg);
			focarCampo(pCampo);
		}

		return false;
	}

	numcnpf = vlCampo;
	numcnpf = numcnpf.toString().replace("-", "");
	numcnpf = numcnpf.toString().replace(".", "");
	numcnpf = numcnpf.toString().replace(".", "");
	numcnpf = numcnpf.toString().replace("/", "");
	numcnpf1 = "";

    if (numcnpf == "00000000000" || numcnpf == "11111111111" || 
   	 	numcnpf == "22222222222" || numcnpf == "33333333333" || 
    	numcnpf == "44444444444" || numcnpf == "55555555555" || 
    	numcnpf == "66666666666" || numcnpf == "77777777777" || 
    	numcnpf == "88888888888" || numcnpf == "99999999999") {
    	
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[10] + msg);
			focarCampo(pCampo);
		}
		
		return false;
    }

	len = numcnpf.length;
	x = len - 1;

	for (var i = 0; i <= len - 3; i++) {
		y = numcnpf.substring(i, i + 1);
		soma = soma + (y * x);
		x = x - 1;
		texto = texto + y;
	}

	// retorna o resto da divisão por 11
	dig1 = 11 - (soma % 11);

	if (dig1 == 10)
		dig1 = 0;
	if (dig1 == 11)
		dig1 = 0;

	numcnpf1 = numcnpf.substring(0, len - 2) + dig1;
	x = 11;
	soma = 0;

	for (var i = 0; i <= len - 2; i++) {
		soma = soma + (numcnpf1.substring(i, i + 1) * x);
		x = x - 1;

	}
	dig2 = 11 - (soma % 11);

	if (dig2 == 10)
		dig2 = 0;
	if (dig2 == 11)
		dig2 = 0;

	if (((dig1 + "" + dig2) == numcnpf.substring(len, len - 2)) && numcnpf != 0) {
		return true;
	}

	if (!pSemMensagem) {
		pCampo.select();
		exibirMensagem(_mensagemGlobal[10] + msg);
		focarCampo(pCampo);
	}

	return false;
}

// Formata o campo CNPJ "pCampo" passado como parâmetro
function formatarCampoCNPJ(pCampo, pEvento) {

	var vlCampo = pCampo.value;
	var tam = vlCampo.length;

	if (isTeclaFuncional(pEvento)) {
		return;
	}

	// Tira os '.'
	while (vlCampo.indexOf('.') != -1) {
		vlCampo = vlCampo.replace('.', '');
	}
	// Tira os '-'
	while (vlCampo.indexOf('-') != -1) {
		vlCampo = vlCampo.replace('-', '');
	}
	// Tira os '/'
	while (vlCampo.indexOf('/') != -1) {
		vlCampo = vlCampo.replace('/', '');
	}

	// Caso seja grande demais, trunca.
	var tamanho = vlCampo.length;
	if (tamanho > 14) {
		tamanho = 14;
		vlCampo = vlCampo.substr(0, 14);
	}

	var filtro = /^([0-9])*$/;
	if (!filtro.test(vlCampo)) {
		pCampo.select();
		exibirMensagem(_mensagemGlobal[11]);
		pCampo.value = vlCampo.substr(0, tam - 1);
		focarCampo(pCampo);
		return;
	}

	if (tamanho > 2 && tamanho <= 5) {
		vlCampo = vlCampo.substr(0, 2) + '.' + vlCampo.substr(2);
	} else if (tamanho > 5 && tamanho <= 8) {
		vlCampo = vlCampo.substr(0, 2) + '.' + vlCampo.substr(2, 3) + '.' + vlCampo.substr(5);
	} else if (tamanho > 8 && tamanho <= 12) {
		vlCampo = vlCampo.substr(0, 2) + '.' + vlCampo.substr(2, 3) + '.' + vlCampo.substr(5, 3) + '/' + vlCampo.substr(8);
	} else if (tamanho > 12) {
		vlCampo =
			vlCampo.substr(0, 2)
				+ '.'
				+ vlCampo.substr(2, 3)
				+ '.'
				+ vlCampo.substr(5, 3)
				+ '/'
				+ vlCampo.substr(8, 4)
				+ '-'
				+ vlCampo.substr(12);
	}

	pCampo.value = vlCampo;

	if (vlCampo.length >= 18) {
		isCampoCNPJValido(pCampo);
	}
}

// Valida o campo CNPJ "pCampo" passado como parâmetro
function isCampoCNPJValido(pCampo, pInObrigatorio, pSemMensagem) {
	var msg = "";
	var vlCampo = pCampo.value;

	if (pInObrigatorio != null) {
		if (pInObrigatorio) {
			msg = "\n" + _mensagemGlobal[0];

		} else {
			msg = "\n" + _mensagemGlobal[1];

			if (vlCampo == "")
				return true;
		}
	}

	var filtro = /^([0-9\.\-\/])*$/;
	if (!filtro.test(vlCampo)) {
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[11] + msg);
			focarCampo(pCampo);
		}

		return false;
	}

	if (vlCampo.length != 18) {
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[11] + msg);
			focarCampo(pCampo);
		}

		return false;
	}

	numcnpj = vlCampo;
	numcnpj = numcnpj.toString().replace("-", "");
	numcnpj = numcnpj.toString().replace("/", "");
	numcnpj = numcnpj.toString().replace(".", "");
	numcnpj = numcnpj.toString().replace(".", "");

	var varFirstChr = numcnpj.charAt(0);
	var vlMult, vlControle, s1, s2 = "";
	var i, j, vlDgito, vlSoma = 0;
	vaCharCGC = false;

	for (var i = 0; i <= 13; i++) {

		var c = numcnpj.charAt(i);
		if (!(c >= "0") && (c <= "9")) {
			if (!pSemMensagem) {
				pCampo.select();
				exibirMensagem(_mensagemGlobal[11] + msg);
				focarCampo(pCampo);
			}

			return false;
		}
		if (c != varFirstChr) {
			vaCharCGC = true;
		}
	}

	if (!vaCharCGC) {
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[11] + msg);
			focarCampo(pCampo);
		}

		return false;
	}

	s1 = numcnpj.substring(0, 12);
	s2 = numcnpj.substring(12, 15);
	vlMult = "543298765432";
	vlControle = "";

	for (j = 1; j < 3; j++) {

		vlSoma = 0;
		for (i = 0; i < 12; i++) {
			vlSoma += eval(s1.charAt(i)) * eval(vlMult.charAt(i));
		}
		if (j == 2) {
			vlSoma += (2 * vlDgito);
		}
		vlDgito = ((vlSoma * 10) % 11);
		if (vlDgito == 10) {
			vlDgito = 0;
		}
		vlControle = vlControle + vlDgito;
		vlMult = "654329876543";
	}

	if (vlControle != s2) {
		if (!pSemMensagem) {
			pCampo.select();
			exibirMensagem(_mensagemGlobal[11] + msg);
			focarCampo(pCampo);
		}

		return false;

	} else {
		return true;
	}
}

function isCampoRadicalCNPJValido(pCampo, pInObrigatorio) {	
	var msg = "";
	var vlCampo = pCampo.value;

	if (pInObrigatorio != null) {
		if (pInObrigatorio) {
			msg = "\n" + _mensagemGlobal[0];

		} else {
			msg = "\n" + _mensagemGlobal[1];
			if (vlCampo == "")
				return true;
		}
	}
		
	var filtro = /^([0-9.])*$/;
	if (!filtro.test(vlCampo)) {
		pCampo.select();
		exibirMensagem(_mensagemGlobal[12] + msg);
		focarCampo(pCampo);

		return false;
	}	
		
	if (vlCampo.length > 10) {
		pCampo.select();
		exibirMensagem(_mensagemGlobal[12] + msg);
		focarCampo(pCampo);

		return false;
	} else {

		return true;			
	}
}

/**** sha1.js *****************************/
/*
 * A JavaScript implementation of the Secure Hash Algorithm, SHA-1, as defined
 * in FIPS PUB 180-1
 * Version 2.1 Copyright Paul Johnston 2000 - 2002.
 * Other contributors: Greg Holt, Andrew Kepert, Ydnar, Lostinet
 * Distributed under the BSD License
 * See http://pajhome.org.uk/crypt/md5 for details.
 */

/*
 * Configurable variables. You may need to tweak these to be compatible with
 * the server-side, but the defaults work in most cases.
 */
var hexcase = 0;  /* hex output format. 0 - lowercase; 1 - uppercase        */
var b64pad  = ""; /* base-64 pad character. "=" for strict RFC compliance   */
var chrsz   = 8;  /* bits per input character. 8 - ASCII; 16 - Unicode      */

/*
 * These are the functions you'll usually want to call
 * They take string arguments and return either hex or base-64 encoded strings
 */
function hex_sha1(s){return binb2hex(core_sha1(str2binb(s),s.length * chrsz));}
function b64_sha1(s){return binb2b64(core_sha1(str2binb(s),s.length * chrsz));}
function str_sha1(s){return binb2str(core_sha1(str2binb(s),s.length * chrsz));}
function hex_hmac_sha1(key, data){ return binb2hex(core_hmac_sha1(key, data));}
function b64_hmac_sha1(key, data){ return binb2b64(core_hmac_sha1(key, data));}
function str_hmac_sha1(key, data){ return binb2str(core_hmac_sha1(key, data));}

/*
 * Perform a simple self-test to see if the VM is working
 */
function sha1_vm_test()
{
  return hex_sha1("abc") == "a9993e364706816aba3e25717850c26c9cd0d89d";
}

/*
 * Calculate the SHA-1 of an array of big-endian words, and a bit length
 */
function core_sha1(x, len)
{
  /* append padding */
  x[len >> 5] |= 0x80 << (24 - len % 32);
  x[((len + 64 >> 9) << 4) + 15] = len;

  var w = Array(80);
  var a =  1732584193;
  var b = -271733879;
  var c = -1732584194;
  var d =  271733878;
  var e = -1009589776;

  for(var i = 0; i < x.length; i += 16)
  {
    var olda = a;
    var oldb = b;
    var oldc = c;
    var oldd = d;
    var olde = e;

    for(var j = 0; j < 80; j++)
    {
      if(j < 16) w[j] = x[i + j];
      else w[j] = rol(w[j-3] ^ w[j-8] ^ w[j-14] ^ w[j-16], 1);
      var t = safe_add(safe_add(rol(a, 5), sha1_ft(j, b, c, d)), 
                       safe_add(safe_add(e, w[j]), sha1_kt(j)));
      e = d;
      d = c;
      c = rol(b, 30);
      b = a;
      a = t;
    }

    a = safe_add(a, olda);
    b = safe_add(b, oldb);
    c = safe_add(c, oldc);
    d = safe_add(d, oldd);
    e = safe_add(e, olde);
  }
  return Array(a, b, c, d, e);
  
}

/*
 * Perform the appropriate triplet combination function for the current
 * iteration
 */
function sha1_ft(t, b, c, d)
{
  if(t < 20) return (b & c) | ((~b) & d);
  if(t < 40) return b ^ c ^ d;
  if(t < 60) return (b & c) | (b & d) | (c & d);
  return b ^ c ^ d;
}

/*
 * Determine the appropriate additive constant for the current iteration
 */
function sha1_kt(t)
{
  return (t < 20) ?  1518500249 : (t < 40) ?  1859775393 :
         (t < 60) ? -1894007588 : -899497514;
}  

/*
 * Calculate the HMAC-SHA1 of a key and some data
 */
function core_hmac_sha1(key, data)
{
  var bkey = str2binb(key);
  if(bkey.length > 16) bkey = core_sha1(bkey, key.length * chrsz);

  var ipad = Array(16), opad = Array(16);
  for(var i = 0; i < 16; i++) 
  {
    ipad[i] = bkey[i] ^ 0x36363636;
    opad[i] = bkey[i] ^ 0x5C5C5C5C;
  }

  var hash = core_sha1(ipad.concat(str2binb(data)), 512 + data.length * chrsz);
  return core_sha1(opad.concat(hash), 512 + 160);
}

/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally
 * to work around bugs in some JS interpreters.
 */
function safe_add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}

/*
 * Bitwise rotate a 32-bit number to the left.
 */
function rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * Convert an 8-bit or 16-bit string to an array of big-endian words
 * In 8-bit function, characters >255 have their hi-byte silently ignored.
 */
function str2binb(str)
{
  var bin = Array();
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < str.length * chrsz; i += chrsz)
    bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i%32);
  return bin;
}

/*
 * Convert an array of big-endian words to a string
 */
function binb2str(bin)
{
  var str = "";
  var mask = (1 << chrsz) - 1;
  for(var i = 0; i < bin.length * 32; i += chrsz)
    str += String.fromCharCode((bin[i>>5] >>> (24 - i%32)) & mask);
  return str;
}

/*
 * Convert an array of big-endian words to a hex string.
 */
function binb2hex(binarray)
{
  var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i++)
  {
    str += hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8+4)) & 0xF) +
           hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8  )) & 0xF);
  }
  return str;
}

/*
 * Convert an array of big-endian words to a base-64 string
 */
function binb2b64(binarray)
{
  var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var str = "";
  for(var i = 0; i < binarray.length * 4; i += 3)
  {
    var triplet = (((binarray[i   >> 2] >> 8 * (3 -  i   %4)) & 0xFF) << 16)
                | (((binarray[i+1 >> 2] >> 8 * (3 - (i+1)%4)) & 0xFF) << 8 )
                |  ((binarray[i+2 >> 2] >> 8 * (3 - (i+2)%4)) & 0xFF);
    for(var j = 0; j < 4; j++)
    {
      if(i * 8 + j * 6 > binarray.length * 32) str += b64pad;
      else str += tab.charAt((triplet >> 6*(3-j)) & 0x3F);
    }
  }
  return str;
}

function carregaUF(textoInicial, objeto){
	aUF=new Array();

	aUF[0]=textoInicial;
	aUF[1]='AC';aUF[2]='AL';aUF[3]='AP';aUF[4]='AM';aUF[5]='BA';aUF[6]='CE';aUF[7]='DF';aUF[8]='ES';
	aUF[9]='GO';aUF[10]='MA';aUF[11]='MG';aUF[12]='MS';aUF[13]='MT';aUF[14]='PA';aUF[15]='PB';aUF[16]='PE';
	aUF[17]='PI';aUF[18]='PR';aUF[19]='RJ';aUF[20]='RN';aUF[21]='RO';aUF[22]='RR';aUF[23]='RS';aUF[24]='SC';
	aUF[25]='SE';aUF[26]='SP';aUF[27]='TO';

	for (i = 0; i < aUF.length; i++)
		if (i == 0)
			objeto.options[i] = new Option('', '');
		else
			objeto.options[i] = new Option(aUF[i], aUF[i]);

	objeto.value = 'SP'; // valor default
}

function carregaMediunidade(textoInicial, objeto){
	aMediunidade=new Array();

	aMediunidade[0]=textoInicial;
	aMediunidade[1]='APARA';
	aMediunidade[2]='DOUTRINADOR';

	objeto.options[0] = new Option(aMediunidade[0],'');
	objeto.options[1] = new Option(aMediunidade[1], 'A');
	objeto.options[2] = new Option(aMediunidade[2], 'D');

}

function limparCombo(combo){
	if (combo != null)
		combo.options.length = 0;
}
