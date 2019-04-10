
function internar(id,dat_saida,data,matricula,paciente) {



	if (dat_saida != 1){

     var resposta = confirm("Deseja realmente internar o paciente?");

	      
     	if (resposta == true) {

     		//Previsaão < que data atual
                       if(data != 1){

                               var prorrogacao;

                                   prorrogacao = prompt ("O paciente exedeu as 12 horas do pronto atendimento, favor informar o motivo:");

                               window.location.href = "pronto_atendimento_saida.php?id="+id+"&prorrogacao="+prorrogacao+"&matricula="+matricula+"&paciente="+paciente;


                       }else{
                               window.location.href = "pronto_atendimento_saida.php?id="+id+"&matricula="+matricula+"&paciente="+paciente;
                       }
  
          //window.location.href = "internacao.php?id="+id+"&matricula="+matricula+"&paciente="+paciente;


     	}
	}else{
		alert("Paciente já saiu!");
	}
}