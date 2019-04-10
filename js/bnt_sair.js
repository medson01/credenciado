function saida(id,dat_saida,data) {
   
   if (dat_saida != 1){

     var resposta = confirm("Deseja dar saída do paciente?");
 
               if (resposta == true) {

                       //Previsaão < que data atual
                       if(data != 1){

                               var prorrogacao;

                                   prorrogacao = prompt ("O paciente exedeu as 12 horas do pronto atendimento, favor informar o motivo:");

                               window.location.href = "pronto_atendimento_saida.php?id="+id+"&prorrogacao="+prorrogacao;


                       }else{
                               window.location.href = "pronto_atendimento_saida.php?id="+id;
                       }
                    
               }

   }else{
      alert("Paciente já saiu!");
   }
}