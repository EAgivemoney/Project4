console.log("Het bestand wordt ingeladen");

let Balenciaga = 500;

// Array voor de waarden van de aandelen
const aandelen = [
    {
        naam: "Apple",
        waarde: 100,
        minSchommeling: 0.999679999,
        maxSchommeling: 1.00006561,
        minimumWaarde: 70
    },
    {
        naam: "Nintendo",
        waarde: 80, 
        minSchommeling: 0.999999243,
        maxSchommeling: 1.0007951,
        minimumWaarde: 50
    },
    {
    naam: "Youtube",
        waarde: 120, 
        minSchommeling: 0.999999295,
        maxSchommeling: 1.0006521,
        minimumWaarde: 75
    },
    {
        naam: "Dogecoin",
        waarde: 60,
        minSchommeling:0.75,
        maxSchommeling:1.3,
        minimumWaarde:20
    },
    {
        naam: "Ubisoft",
        waarde: 200,
        minSchommeling: 0.7,
        maxSchommeling:1.35,
        minimumWaarde:100
    }
];

const waardeSpans = document.querySelectorAll(".waarde");
const stabiliteitSpans = document.querySelectorAll(".stabiliteit");
const kopenKnoppen = document.querySelectorAll(".kopen");
const verkopenKnoppen = document.querySelectorAll(".verkopen");
const aandelenSpans = document.querySelectorAll(".aandelen");
const stocks = document.querySelectorAll(".stock");



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
        if (Math.random() < 0.05) { // 5% kans op een daling
            // Verminder de waarde van het geselecteerde aandeel met 75%
            randomMarktschatting = 25;
        }
        
        var Waarde = (parseFloat(waardeSpans[index].textContent) * (randomMarktschatting/100 * Schommeling)).toFixed(2);

        if(Waarde > parseFloat(waardeSpans[index].textContent))
        {   stocks[index].classList.add("increase");
           stocks[index].classList.remove("decrease");
        } else
        {
           stocks[index].classList.add("decrease");
           stocks[index].classList.remove("increase");
        }


        if((Waarde - parseFloat(waardeSpans[index].textContent)) > 200) {
            Waarde = (parseFloat(waardeSpans[index].textContent) + 200).toFixed(2);

        }

        
        // Update de waarden in de HTML
        waardeSpans[index].textContent = Waarde;

    
    });
};

// Event listener voor de "kopen" knop
kopenKnoppen.forEach(function(knop, index) {
    knop.addEventListener("click", function() {
        koopAandeel(index);
    });
});

// Event listener voor de "verkopen" knop
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
    clearInterval(updateInterval); // Stop eerst de huidige interval, als die er is
    updateInterval = setInterval(updateStocks, 100); // Start een nieuwe interval. Moet nog een goed getal bedenken voor de snelheid.
}

// Functie om de timer te stoppen
function stopTimer() {
    clearInterval(updateInterval); // Stop de timer als deze actief is
    updateInterval = null; // Zet updateInterval op null om aan te geven dat er geen interval actief is
}

// Functie om de timer voor 10 seconden te bevriezen
async function slowTimer() {
    clearInterval(updateInterval); // Stop eerst de huidige interval, als die er is
    updateInterval = setInterval(updateStocks, 500); // Start een nieuwe interval met een frequentie van 500 ms

    // Wacht 5000 ms
    await new Promise(resolve => setTimeout(resolve, 5000));

    clearInterval(updateInterval); // Stop deze interval na 5000 ms
    startTimer(50); // Start een nieuwe interval met een frequentie van 50 ms
}

//deze knop wordt gebruikt voor het togglen van het opslaan formulier
document.getElementById("opslaan").addEventListener("click", function() {
    
    clearInterval(updateInterval); // Stop de timer als deze actief is
    updateInterval = null;
    
    const saveForm = document.getElementById("saveForm");
    saveForm.classList.toggle("hidden");

    const balenciagaValue = document.querySelector(".Balenciaga").textContent;
    document.getElementById("scoreValue").value = balenciagaValue;

    var buttons = document.querySelectorAll('.verdwijn');
    buttons.forEach(function(button) {
        button.classList.add('hidden');
    });
    
    document.querySelector('.stock-market').classList.toggle('blur');
});