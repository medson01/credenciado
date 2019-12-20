/*********************************************
* Nome: Capture
* Descrição: Chama o método "Capture" da aplicação desktop, 
* 	responsável por chamar a tela de captura de digital para apenas um único dedo.
* 	Este método é recomendável quando você deseja capturar a impressão digital de um único dedo e 
* 	não existe a necessidade de identificar qual dedo da mão esta digital pertence. 
* Retorno: Template (String) ou Null
*********************************************/
function Capture() {

	$.ajax({

		url: 'http://localhost:9000/api/public/v1/captura/Capturar/1',
		type: 'GET',
		success: function (data) {
			
			if (data != "" && data != null) {
				
				var name = $("#inputName").val();
				var id_beneficiarios = $("#id_beneficiarios").val();
				insertDB(id_beneficiarios, name, data);


			}
			else {
				alert("Digital não pode ser capturada!");

				 document.getElementById("aviso").style.display = "none";
				 //document.getElementById("btn-capture").style.display = "none";
                 //document.getElementById("demo").innerHTML = '<center> <h3>  A biometria não pode ser obtida. </br> O usuário não possui digital? </center> <center> Sim </centre> </h3> <input type="checkbox" class="form-control" name="not_biometria" id="not_biometria" value="1">  <center> <br> <button onclick="myFunction()" class="btn btn-primary" id="biometria"> Fechar </button> </center> ';
                 modal.style.display = "none";
                


               

			}
		}
	})
}

/*********************************************
* Nome: Match
* Descrição: Chama o método "VerifyMatch" da aplicação desktop, 
* 	responsável por chamar a tela de captura de digital para apenas um único dedo e realizar a 
* 	comparação com um outro template (impressão digital) já cadastrada.
* 	Este método é recomendável quando você deseja você comparação de 1:1 (Um para Um). 
* Retorno: Template (String) ou Null
*********************************************/
function Match(digital) {
		
	if (digital != "") {
	
		$.ajax({
			url: 'http://localhost:9000/api/public/v1/captura/Comparar?Digital=' + digital,
			type: 'GET',
			success: function (data) {
			
				if (data != "") {

					modal.style.display = "none";

					 //document.getElementById("demo").innerHTML = 'Biometria ok!  <br> <center> <button type="button" class="btn btn-primary" >Fechar</button> </center>';
					 //var conteudo =  document.getElementById("conteudo");
					 //conteudo.style.display = "none";


					alert("Digital encontrada com sucesso!");

				}
				else {
					alert("Digitais não conferem.");
				}
			}
		});
	}
	else {
		alert("Por favor, registre a impressão digital.");
	}
}

/*********************************************
* Nome: insertDB
* Descrição: Realizar uma requisação AJAX para a página Controller.php, 
* 	enviando os dados do novo usuário cadastrado, para que sejam gravado 
* 	no banco de dados.
* Retorno: String
*********************************************/
function insertDB( id_beneficiarios, name, template) {
	
	$.ajax({
		url: 'Controller.php',
		method: 'POST',
		dataType: 'json',
		data: {
			method: "insertDB",
			id_beneficiarios: id_beneficiarios,
			name: name,
			template: template
		},
		success: function (data) {
			
			$("#inputName").val("");
			$("#id_beneficiarios").val("");

			alert(data.msg);

			modal.style.display = "none";
			//window.location.reload();
		}
	});
}



$(function() {
	$("#btn-capture").on("click", function(){
		
		if($("#inputName").val() != "") {
			Capture();
		}
		else {
			alert("Por favor, preencha o nome.");
		}

		if($("#id_beneficiarios").val() != "") {
			Capture();
		}
		else {
			alert("Por favor, preencha o nome.");
		}
	});
	
	$(".btn-match").on("click", function(){
		var digital = $("#template").val();
		Match(digital);
	});
});