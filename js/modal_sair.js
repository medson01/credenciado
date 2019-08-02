

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
 btn.onclick = function() {     
    modal.style.display = "block";   
  }
 


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function modal_saida(tempo,id,saida,data) {
   
alert("ok");
                       //Previsaão < que data atual
                       if(data == 1){   // data = 0

                               var prorrogacao;

                                   prorrogacao = prompt ("O paciente exedeu o período referente ao Pronto Atendimento que é de "+tempo+", favor informar o motivo:");

                               window.location.href = "pronto_atendimento_saida.php?id="+id+"&prorrogacao="+prorrogacao;


                       }else{         // data = 1

                        // alta do paciente

                              var motivo_saida;
                              
                               motivo_saida = prompt ("Favor informar sobre a alta do paciente:");

                              

                               //window.location.href = "pronto_atendimento_saida.php?id="+id;

                               window.location.href = "pronto_atendimento_saida.php?id="+id+"&motivo_saida="+motivo_saida;
                       }


}
