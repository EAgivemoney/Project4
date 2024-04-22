//we krijgen 5-10 verschillende stocks

//deze hebben allemaal een waarde

//deze kunnen we kopen of verkopen

//deze waardes veranderen alleen iedere ingame "dag"

//voor iedere stock zal er een voorspelling zijn voor hoe de verandering er voor de volgende dag uit zal zien

//afhankelijk van hoe risicovol de stock is zal deze voorspelling uitkomen in veel ergere of betere omstandigheden

//ik denk na over 2 powerups

//1 om de voorspelling 100% zeker uit te laten komen

//1 om erachter te komen wat het echte getal is met hoeveel de stock verandert

/*
Microsoft Corporation
Alphabet Inc. 
Amazon.com Inc.
Facebook, Inc.
Nvidia Corporation
Intel Corporation
Cisco Systems, Inc.
Adobe Inc.
IBM (International Business Machines Corporation)
*/
console.log("Het bestand wordt ingeladen");

let Balenciaga = 500;
const waardeSpans = document.querySelectorAll(".waarde");
const marktschattingSpans = document.querySelectorAll(".marktschatting");
const stabiliteitSpans = document.querySelectorAll(".stabiliteit");
const kopenKnoppen = document.querySelectorAll(".kopen");
const verkopenKnoppen = document.querySelectorAll(".verkopen");
const aandelenSpans = document.querySelectorAll(".aandelen");

document.getElementById("confirmBtn").addEventListener("click", function() {
    // Loop door alle aandelen
    waardeSpans.forEach(function(waardeSpan, index) {
        // Verkrijg willekeurige stabiliteit
        var randomStabiliteit = Math.random() < 0.5 ? "hoog" : "laag";
        
        var minMarktschatting = 95; // Minimale marktschatting
        var maxMarktschatting = 110; // Maximale marktschatting
        var randomMarktschatting = Math.floor(Math.random() * (maxMarktschatting - minMarktschatting + 1)) + minMarktschatting; 

        var maxSchommeling = randomStabiliteit === "hoog" ? 1.35 : 1.15;
        var minSchommeling = randomStabiliteit === "hoog" ? 0.80 : 0.90;

        var Schommeling = Math.random() * (maxSchommeling - minSchommeling) + minSchommeling; 
        
        if(parseFloat(waardeSpan.textContent) < 50) {
            Schommeling = 1.1;
        }
        
        var Waarde = (parseFloat(waardeSpan.textContent) * (randomMarktschatting/100 * Schommeling)).toFixed(2);

        if((Waarde - parseFloat(waardeSpan.textContent)) > 200) {
            Waarde = (parseFloat(waardeSpan.textContent) + 200).toFixed(2);
        }

        // Update de waarden in de HTML
        waardeSpan.textContent = Waarde;
        marktschattingSpans[index].textContent = randomMarktschatting;
        stabiliteitSpans[index].textContent = randomStabiliteit;
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