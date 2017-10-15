// booking form validator
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
        var errorId = "seatError";
        if (!document.getElementById(errorId)){
            document.getElementById("seats").className += " errorgroup";
            var errorNode = document.createElement("p");
            errorNode.id = errorId;
            errorNode.style.color="red";
            var errorContent = document.createTextNode("Must select at least one seat");
            errorNode.appendChild(errorContent);
            document.getElementById("seats").appendChild(errorNode);
        }

        return false;
    } catch (ex) {
        alert(ex);
    }
}

// details form vaildator
function confirmValidate() {
    return checkFullname() && checkEmail && mobile;
}

//test full name
function checkFullname(){
    var confirmName =document.getElementById("confirmName").value;
    return /^[a-zA-Z \-.']+$/.test(confirmName);
}


// ^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$
function checkEmail() {
    var email = document.getElementById("confirmEmail").value;
    return /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email);
}

function mobile() {
    var email = document.getElementById("confirmMobile").value;
    return /^(\(04\)|04|\+614)([ ]?\d){8}$/.test(email);
}
