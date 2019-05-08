 <input type="text" name="matricula" id="matricula" size="20" placeholder="00000000.000000.00" onchange="matricula()"/></td>
                          </tr>


var select = document.getElementById('matricula');

// return the index of the selected option
console.log(select.selectedIndex); // 1

// return the value of the selected option
console.log(select.options[select.selectedIndex].value) // Second