function boookingValidate() {
    return !movieCheck() && !sessionChack() && numbersCheck() ;
}


function movieCheck() {
    return !document.getElementById("movie").value
}

function sessionChack() {
    return !document.getElementById("session").value;
}

function numbersCheck(){
    var myForm = document.forms["bookingform"];
    try {
        var elements = myForm.getElementsByTagName("input");
        var numbersInput = [];
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].type === "number") numbersInput.push(elements[i]);
        }
        for (var ii = 0; ii < numbersInput.length; ii++){
            if(!isNaN(numbersInput[ii].value) && numbersInput[ii].value > 0) return true;
        }
        // if OK should've exited prior
        document.getElementById("seats").className += " errorgroup";
        var errorNode = document.createElement("p");
        errorNode.style.color="red";
        var errorContent = document.createTextNode("Must select at least one seat");
        errorNode.appendChild(errorContent);
        document.getElementById("seats").appendChild(errorNode);
        return false;
    } catch (ex) {
        alert(ex);
    }
}