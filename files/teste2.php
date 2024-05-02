



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalIn">
  Sing in
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sing in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalOut">
  Sign out
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalOut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Sign out</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

   <link rel="stylesheet" type="text/css" href="../css/modal_saida.css"/>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="ok">
  ok
</button>

<div class="modal"  id="teste">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">		
			 	 
			  <span class="close" id="close">&times;</span>
			  	   
		</div>
		<div class="modal-body" >
				  <table width="100%" border="0">
					<tr>
					  <td width="45%">Data:<span class="style1">*</span></td>
					  <td width="10%"> </td>
					  <td width="45%">Hora:<span class="style1">*</span></td>
					</tr>
					<tr>
					  <td><input id="data" name="data" type="date" class="form-control form-control-sm" required /></td>
					  <td></td>
					  <td><input id="time" name="time" type="time" class="form-control form-control-sm" required /></td>
					</tr>
				  </table>
		</div>
		<div class="modal-footer">
			<p></p>
			<h3 align="right">
				 <input type="submit"  class="btn btn-warning" style="color: #f3ecec; background-color: #291903; border-color: #efeff5;" value=" OK ">
			</h3>
		</div>
	  </div>
	</div>
</div>
</form>


<script>

var modal = document.getElementById("teste");
var btn = document.getElementById("ok");
var span = document.getElementById("close");
// When the user clicks the button, open the modal 
  btn.onclick = function() {
	 // document.getElementById("teste").style.display = "block";
	  modal.style.display = "block";
 }
 
 // When the user clicks the button, open the modal 
  span.onclick = function() {
	 //document.getElementById("teste").style.display = "none";
	 modal.style.display = "none";
	   //alert("Hello! I am an alert box!!");
 }

</script>
	
	
   

  