// init global values
var gSessions = {
    "": [],
    "AC": ["WED-9", "THU-9", "FRI-9", "SAT-9", "SUN-9"],
    "CH": ["MON-1", "TUE-1", "WED-6", "THU-6", "FRI-6", "SAT-12", "SUN-12"],
    "RC": ["MON-9", "TUE-9", "WED-1", "THU-1", "FRI-1", "SAT-6", "SUN-6"],
    "AF": ["MON-6", "TUE-6", "SAT-3", "SUN-3"]
};

var prices = {
    full: {SF: 18.5, SP: 15.5, SC: 12.5, FA: 30, FC: 25, BA: 33, BF: 30, BC: 30},
    discount: {SF: 12.5, SP: 10.5, SC: 8.5, FA: 25, FC: 20, BA: 22, BF: 20, BC: 20}
};

var gPriceType;

// init form events
numbers();
movieChange();
sessionChange();

function getNumbersSelectors() {
    var myForm = document.forms["bookingform"];
    var numbersInput = [];
    try {
        var elements = myForm.getElementsByTagName("input");
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].type === "number") numbersInput.push(elements[i]);
        }
    } catch (ex) {
        alert(ex);
    }
    return numbersInput
}

// operations with numbers
function numbers() {
    var numbersInput = getNumbersSelectors();

    if (numbersInput) {
        for (var ii = 0; ii < numbersInput.length; ii++) {
            var span = document.createElement("span");
            span.id = numbersInput[ii].id + "_span"; //.replace(/[\[\]']+/g,'')
            numbersInput[ii].parentNode.appendChild(span);

            numbersInput[ii].addEventListener("input", function () {
                var mySpan = document.getElementById(this.id + "_span");
                if (this.value > 0) {
                    var price = getPrice(this.id);
                    if (!isNaN(price) && price > 0) {
                        mySpan.innerHTML = "$" + (this.value * price).toFixed(2);
                    }
                } else {
                    mySpan.innerHTML = null;
                }
                recalculate();
            });
        }
    }
}

//set price type full / dicount
function setPriceType(session) {
    if (session) {
        var days = session.split("-");
        gPriceType = days[0] === "MON"
        || days[0] === "TUE"
        || ( ["WED", "THU", "FRI"].indexOf(days[0]) !== -1 && days[1] === "1") ? "discount" : "full";
    } else {
        gPriceType = "";
    }

}

// get price based on movie type and session
function getPrice(id) {

    if (gPriceType) {
        var seats = id.match(/\[(.*?)\]/);
        var seatGroup;
        if (seats) seatGroup = seats[1];

        return prices[gPriceType][seatGroup];
    } else {
        return 0
    }
}

// recalculate all values
function recalculate() {
    var numbersInput = getNumbersSelectors();
    var totalPrice = 0;
    for (var i = 0; i < numbersInput.length; i++) {
        var mySpan = document.getElementById(numbersInput[i].id + "_span");
        if (numbersInput[i].value > 0) {
            var price = getPrice(numbersInput[i].id);
            if (!isNaN(price) && price > 0) {
                var subTotal = numbersInput[i].value * price;
                totalPrice += subTotal;
                var priceValue = "$" + subTotal.toFixed(2);
                if (priceValue !== mySpan.innerHTML) {
                    mySpan.innerHTML = priceValue;
                }
            } else {
                mySpan.innerHTML = null;
            }
        }
    }
    document.getElementById("totalPrice").innerHTML = totalPrice.toFixed(2);
}

function sessionChange() {
    var movies = document.getElementById("movie");
    if (movies) {
        document.getElementById("session").addEventListener("change", function () {
            // set global value of price type
            setPriceType(this.value);
            // recalculate values
            recalculate();
            // find movie key
            var movieKey;
            for (var session in gSessions) {
                for (var i = 0; i < gSessions[session].length; i++) {
                    if (this.value === gSessions[session][i]) {
                        movieKey = session;
                        break;
                    }
                    if (movieKey) break;
                }
            }

            // if not 'please select' option in "movie"
            if (movieKey && movies.options.length > 0) {
                for (var ii = 1; ii < movies.options.length; ii++) {
                    movies.options[ii].selected = movieKey === movies.options[ii].value;
                }
            }
        });
    }
}

function movieChange() {
    //get movie first
    document.getElementById("movie").addEventListener("change", function () {
        var days = {
            'MON': 'Monday',
            'TUE': 'Tuesday',
            'WED': 'Wednesday',
            'THU': 'Thursday',
            'FRI': 'Friday',
            'SAT': 'Saturday',
            'SUN': 'Sunday'
        };
        var typeSessions = gSessions[this.value];
        // farken safari!!!! can't simply hide drop down options, need to regenerate
        // every time move selected
        document.getElementById("session").innerHTML = '';
        var dropOption = document.createElement("option");
        dropOption.text = "Please Select";
        dropOption.value = "";
        document.getElementById("session").appendChild(dropOption);
        // set global value of price type
        setPriceType(null);
        // recalculate values
        recalculate();
        if (typeSessions.length > 0) {
            for (var ii = 0; ii < typeSessions.length; ii++) {
                var sessionsSplit = typeSessions[ii].split("-");
                var option = days[sessionsSplit[0]] + " " + sessionsSplit[1] + "pm";
                dropOption = document.createElement("option");
                dropOption.text = option;
                dropOption.value = typeSessions[ii];
                document.getElementById("session").appendChild(dropOption);
            }
        } else {
            var hoursWeek = [1, 6, 9];
            var hoursWknd = [12, 3, 6, 9];
            for (var day in days) {
                var hours = day === 'SAT' || day === 'SUN' ? hoursWknd : hoursWeek;
                for (var i = 0; i < hours.length; i++) {
                    var value = day + "-" + hours[i];
                    var option = days[day] + " " + hours[i] + "pm";
                    dropOption = document.createElement("option");
                    dropOption.text = option;
                    dropOption.value = value;
                    document.getElementById("session").appendChild(dropOption);
                }
            }
            var movies = document.getElementById("movie").options;
            for (var ii = 1; ii < movies.length; ii++) {
                movies[ii].style.display = "block";
            }
        }
    });
}