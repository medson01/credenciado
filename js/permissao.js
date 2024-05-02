

function permissao(perfil, status){ 


alert("o status:"+status);
 
  switch(perfil) {
  case "usuario":
     document.getElementById("t1").style.display = "none";
     document.getElementById("dias_autorizados").style.display = "none";

         if (status == '') {
             document.getElementById("medico_solicitante").disabled = true;
             document.getElementById("crm").disabled = true;
             document.getElementById("select").disabled = true;
             document.getElementById("motivo").disabled = true;

           //  alert("Eu sou um alert!");

        }else if (status == 1){

             document.getElementById("medico_solicitante").disabled = false;
             document.getElementById("crm").disabled = false;
             document.getElementById("select").disabled = false;
             document.getElementById("motivo").disabled = false;
        }



    break;

  case "medico":
     document.getElementById("dias_autorizados").disabled = false;

     document.getElementById("medico_solicitante").disabled = true;
     document.getElementById("crm").disabled = true;
     document.getElementById("select").disabled = true;
     document.getElementById("motivo").disabled = true;


    break;
  case "administrador":
     document.getElementById("dias_autorizados").style.display = "none";
    break;
  }


}


function status(){   
 
     document.getElementById("medico_solicitante").disabled=false;
     document.getElementById("crm").disabled=false;

}