// init global values
var sessions = {
    "" : [],
    "AC" : ["WED-9", "THU-9", "FRI-9", "SAT-9", "SUN-9"],
    "CH" : ["MON-1", "TUE-1", "WED-6", "THU-6", "FRI-6", "SAT-12", "SUN-12"],
    "RC" : ["MON-9", "TUE-9", "WED-1", "THU-1", "FRI-1", "SAT-6", "SUN-6"],
    "AF" : ["MON-6", "TUE-6", "SAT-3", "SUN-3"]
};
var prices = {
    full: {SF: 18.5, SP: 15.5, SC: 12.5, FA: 30, FC: 25, BA: 33, BF: 30, BC: 30},
    discount: {SF: 12.5, SP: 10.5, SC: 8.5, FA: 25, FC: 20, BA: 22, BF: 20, BC: 20}
};

// init form events
movieChange();
sessionChange();

function numbers() {
    var myForm = document.forms["bookingform"];
    try {
        var elements = myForm.getElementsByTagName("input");
        var numbersInput = [];
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].type === "number") numbersInput.push(elements[i]);
        }
        console.log("Numbers Inputs: " + numbersInput.length);
    } catch (ex) {
        alert(ex);
    }


}

function sessionChange() {
    document.getElementById("session").addEventListener("change", function () {

        // f=ind movie key
        var movieKey;
        for (var session in sessions) {
            for (var i=0; i < sessions[session].length; i++){
                if (this.value === sessions[session][i]){
                    movieKey = session;
                    break;
                }
                if (movieKey) break;
            }
        }
        console.log(movieKey);

        // if not 'please select' option
        var movies = document.getElementById("movie").options;
        if(movieKey){
            for (var ii = 1; ii < movies.length; ii++){
                if(movieKey === movies[ii].value){
                    movies[ii].disabled = false;
                    movies[ii].selected = true;
                } else {
                    movies[ii].disabled = true;
                    movies[ii].selected = false;
                }
            }
        }

    });
}
function movieChange() {
    //get movie first
    document.getElementById("movie").addEventListener("change",  function() {

        var movieSessions = sessions[this.value];

        var times = document.getElementById("session").options;
        if (movieSessions.length > 0) {
            for (var i = 1; i < times.length; i++) {
                var disable = true;
                for (var ii = 0; ii < movieSessions.length; ii++) {
                    if (times[i].value === movieSessions[ii]) {
                        disable = false;
                        break;
                    }
                }
                times[i].disabled = disable;
            }
        } else {
            for (var i = 0; i < times.length; i++) {
                times[i].disabled = false;
            }
        }
    } );
}