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
const waardeSpan = document.querySelector(".waarde");
const marktschattingSpan = document.querySelector(".marktschatting");
const stabiliteitSpan = document.querySelector(".stabiliteit");

document.getElementById("confirmBtn").addEventListener("click", function() {
    // Verkrijg de span elementen
    
    
    var randomStabiliteit = Math.random() < 0.5 ? "hoog" : "laag";
         
        
        var minMarktschatting = 95; // Minimale marktschatting
        var maxMarktschatting = 110; // Maximale marktschatting
    var randomMarktschatting = Math.floor(Math.random() * (maxMarktschatting - minMarktschatting + 1)) + minMarktschatting; 

    if(randomStabiliteit == "hoog")
    {
        var maxSchommeling = 1.35;
        var minSchommeling = 0.80;
       
    } else{
        var maxSchommeling = 1.15;
        var minSchommeling = 0.90;
        
    }
    
    var Schommeling = Math.floor(Math.random() * (maxSchommeling - minSchommeling + 1)) + minSchommeling; 
    
    if(waardeSpan.textContent < 50)
    {
        Schommeling = 1.1;
    }
    var Waarde = (waardeSpan.textContent * (randomMarktschatting/100*Schommeling)).toFixed(2);
    
    if((Waarde - parseFloat(waardeSpan.textContent)) > 200 )
    {
        Waarde = (parseFloat(waardeSpan.textContent) + 200).toFixed(2);
    }
    waardeSpan.textContent = Waarde;
    marktschattingSpan.textContent = randomMarktschatting;
    stabiliteitSpan.textContent = randomStabiliteit;

   
});

var aandelen = 0;
document.querySelector(".kopen").addEventListener("click", function() {
    // Controleer of er genoeg geld in de portemonnee zit
    if (Balenciaga >= parseFloat(waardeSpan.textContent)) {
        // Verlaag het saldo in de portemonnee
        Balenciaga -= parseFloat(waardeSpan.textContent);
        // Verhoog het aantal aandelen met 1
        aandelen++;
        // Update de tekst van de aandelen en portemonnee
        document.querySelector(".aandelen").textContent = aandelen;
        document.querySelector(".Balenciaga").textContent = Balenciaga.toFixed(2);
    } else {
        alert("Niet genoeg geld in de portemonnee!");
    }
});


// Event listener voor de "verkopen" knop
document.querySelector(".verkopen").addEventListener("click", function() {
    // Controleer of er aandelen zijn om te verkopen
    if (aandelen > 0) {
        // Verhoog het saldo in de portemonnee
        Balenciaga += parseFloat(waardeSpan.textContent);
        // Verlaag het aantal aandelen met 1
        aandelen--;
        // Update de tekst van de aandelen en portemonnee
        document.querySelector(".aandelen").textContent = aandelen;
        document.querySelector(".Balenciaga").textContent = Balenciaga.toFixed(2);

    } else {
        alert("Je hebt geen aandelen om te verkopen!");
    }
});