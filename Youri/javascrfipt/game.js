console.log("Het bestand wordt ingeladen");

let Balenciaga = 500;

// Array voor de waarden van de aandelen
const aandelen = [
    {
        naam: "Apple",
        waarde: 100,
        marktschatting: 100
    },
    {
        naam: "Nintendo",
        waarde: 80, // Andere waarde voor Nintendo
        marktschatting: 95
    }
];

const waardeSpans = document.querySelectorAll(".waarde");
const marktschattingSpans = document.querySelectorAll(".marktschatting");
const stabiliteitSpans = document.querySelectorAll(".stabiliteit");
const kopenKnoppen = document.querySelectorAll(".kopen");
const verkopenKnoppen = document.querySelectorAll(".verkopen");
const aandelenSpans = document.querySelectorAll(".aandelen");

// Functie om de initiële waarden van de aandelen in te stellen
function initializeStocks() {
    aandelen.forEach(function(aandeel, index) {
        waardeSpans[index].textContent = aandeel.waarde.toFixed(2);
        marktschattingSpans[index].textContent = aandeel.marktschatting;
    });
}

initializeStocks();

document.getElementById("confirmBtn").addEventListener("click", function() {
    // Loop door alle aandelen
    aandelen.forEach(function(aandeel, index) {
        var randomMarktschatting = Math.floor(Math.random() * (110 - 95 + 1)) + 95; // Willekeurige marktschatting tussen 95 en 110

        var maxSchommeling = aandeel.stabiliteit === "hoog" ? 1.35 : 1.15;
        var minSchommeling = aandeel.stabiliteit === "hoog" ? 0.80 : 0.90;

        var Schommeling = Math.random() * (maxSchommeling - minSchommeling) + minSchommeling; 
        
        if(parseFloat(waardeSpans[index].textContent) < 50) {
            Schommeling = 1.1;
        }
        
        var Waarde = (parseFloat(waardeSpans[index].textContent) * (randomMarktschatting/100 * Schommeling)).toFixed(2);

        if((Waarde - parseFloat(waardeSpans[index].textContent)) > 200) {
            Waarde = (parseFloat(waardeSpans[index].textContent) + 200).toFixed(2);
        }

        // Update de waarden in de HTML
        waardeSpans[index].textContent = Waarde;
        marktschattingSpans[index].textContent = randomMarktschatting;
    });
});

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
