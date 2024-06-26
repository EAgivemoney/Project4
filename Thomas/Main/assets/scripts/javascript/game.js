console.log("Het bestand wordt ingeladen");

let Balenciaga = 500;

// Array voor de waarden van de aandelen
const aandelen = [
    {
        naam: "Apple",
        waarde: 100,
        minSchommeling: 0.98,
        maxSchommeling: 1.03,
        minimumWaarde: 70
    },
    {
        naam: "Nintendo",
        waarde: 80, // Andere waarde voor Nintendo
        minSchommeling: 0.991423243,
        maxSchommeling: 1.01956890,
        minimumWaarde: 50
    },
    {
    naam: "Youtube",
        waarde: 80, // Andere waarde voor Nintendo
        minSchommeling: 0.991423243,
        maxSchommeling: 1.01956890,
        minimumWaarde: 50
    }
];

const waardeSpans = document.querySelectorAll(".waarde");
const stabiliteitSpans = document.querySelectorAll(".stabiliteit");
const kopenKnoppen = document.querySelectorAll(".kopen");
const verkopenKnoppen = document.querySelectorAll(".verkopen");
const aandelenSpans = document.querySelectorAll(".aandelen");

let updateInterval;

document.getElementById("startBtn").addEventListener("click", startTimer);
document.getElementById("stopBtn").addEventListener("click", stopTimer);
document.getElementById("slowBtn").addEventListener("click", slowTimer);


// Functie om de initiële waarden van de aandelen in te stellen
function initializeStocks() {
    aandelen.forEach(function(aandeel, index) {
        waardeSpans[index].textContent = aandeel.waarde.toFixed(2);
    });
}

initializeStocks();



function updateStocks() {
    // Loop door alle aandelen
    aandelen.forEach(function(aandeel, index) {
        var randomMarktschatting = Math.floor(Math.random() * (110 - 95 + 1)) + 95; // Willekeurige marktschatting tussen 95 en 110

        

        var Schommeling = Math.random() * (aandeel.maxSchommeling - aandeel.minSchommeling) + aandeel.minSchommeling; 
        
        if(parseFloat(waardeSpans[index].textContent) < aandeel.minimumWaarde) {
            Schommeling = 3;
        }
        if (Math.random() < 0.05) { // 50% kans op een daling
            // Verminder de waarde van het geselecteerde aandeel met 25%
            randomMarktschatting = 25;
        }
        
        var Waarde = (parseFloat(waardeSpans[index].textContent) * (randomMarktschatting/100 * Schommeling)).toFixed(2);

        if((Waarde - parseFloat(waardeSpans[index].textContent)) > 200) {
            Waarde = (parseFloat(waardeSpans[index].textContent) + 200).toFixed(2);
        }

        
        // Update de waarden in de HTML
        waardeSpans[index].textContent = Waarde;

    
    });
};

// Event listener voor de "kopen" knoppen
kopenKnoppen.forEach(function(knop, index) {
    knop.addEventListener("click", function() {
        koopAandeel(index);
    });
});

// Event listener voor de "verkopen" knoppen
verkopenKnoppen.forEach(function(knop, index) {
    knop.addEventListener("click", function() {
        verkoopAandeel(index);
    });
});

function koopAandeel(index) {
    // Controleer of er genoeg geld in de portemonnee zit
    if (Balenciaga >= parseFloat(waardeSpans[index].textContent)) {
        // Verlaag het saldo in de portemonnee
        Balenciaga -= parseFloat(waardeSpans[index].textContent);
        // Verhoog het aantal aandelen met 1
        aandelenSpans[index].textContent = parseInt(aandelenSpans[index].textContent) + 1;
        // Update de tekst van de portemonnee
        document.querySelector(".Balenciaga").textContent = Balenciaga.toFixed(2);
    } else {
        alert("Niet genoeg geld in de portemonnee!");
    }
}

function verkoopAandeel(index) {
    // Controleer of er aandelen zijn om te verkopen
    if (parseInt(aandelenSpans[index].textContent) > 0) {
        // Verhoog het saldo in de portemonnee
        Balenciaga += parseFloat(waardeSpans[index].textContent);
        // Verlaag het aantal aandelen met 1
        aandelenSpans[index].textContent = parseInt(aandelenSpans[index].textContent) - 1;
        // Update de tekst van de portemonnee
        document.querySelector(".Balenciaga").textContent = Balenciaga.toFixed(2);
    } else {
        alert("Je hebt geen aandelen om te verkopen!");
    }
}

// Functie om de timer te starten
function startTimer() {
    updateInterval = setInterval(updateStocks, 50); // 5000 ms (5 seconden)
}

// Functie om de timer te stoppen
function stopTimer() {
    clearInterval(updateInterval);
}

// Functie om de timer voor 10 seconden te bevriezen
async function slowTimer() {
    clearInterval(updateInterval); // Stop eerst de huidige interval, als die er is

    updateInterval = setInterval(updateStocks, 500);

    // Wacht 5000 ms
    await new Promise(resolve => setTimeout(resolve, 5000));

    clearInterval(updateInterval); // Stop deze interval na 5000 ms
    // Start een nieuwe interval met een kortere frequentie (50 ms)
    updateInterval = setInterval(updateStocks, 50);
}




