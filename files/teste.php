<!DOCTYPE html>
<html>
<body>

<p>Modify the text in the input field, then click outside the field to fire the onchange event.</p>

Enter some text: <input type="text" name="txt" id="s" value="Hello" onchange="myFunction()">

<input type="text" name="txt" id="casa" value="Hello">

<script>
function myFunction() {

 var s = document.getElementById("s").value;
  document.getElementById("casa").value = s;
}
</script>

</body>
</html>