<?php
// Start de sessie om sessievariabelen te kunnen gebruiken
session_start();
// Vereiste configuratiebestanden inladen
require 'config/config.php';

// Controleren of het een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Een nieuwe databaseverbinding maken
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Controleren of de verbinding is geslaagd
    if ($conn->connect_error) {
        // In geval van een fout, stoppen en een foutmelding weergeven
        die("Connection failed: " . $conn->connect_error);
    }

    // Identifier (gebruikersnaam of e-mail) en wachtwoord van het formulier ophalen en voorkomen dat er SQL-injectie plaatsvindt
    $identifier = $conn->real_escape_string($_POST['identifier']);
    $password = $_POST['password'];

    // SQL-query voorbereiden om gebruikersgegevens op te halen
    $sql = "SELECT Id, Username, Email, Password, Status FROM login WHERE Username = ? OR Email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Identifier parameter binden aan de query (zowel gebruikersnaam als e-mail)
        $stmt->bind_param('ss', $identifier, $identifier);
        // Query uitvoeren
        $stmt->execute();
        // Resultaat ophalen
        $result = $stmt->get_result();

        // Controleren of er rijen zijn teruggegeven
        if ($result->num_rows > 0) {
            // Rijgegevens ophalen
            $row = $result->fetch_assoc();
            // Controleren of het wachtwoord overeenkomt met de opgeslagen hash
            if ($password === $row['Password']) {
                // Sessievariabelen instellen voor ingelogde gebruiker
                $_SESSION['user_id'] = $row['Id'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['status'] = $row['Status'];
                $_SESSION['email'] = $row['Email'];

                // Doorsturen naar de juiste pagina op basis van gebruikersstatus
                if ($row['Status'] == 'Admin') {
                    header("Location: ../../../admin.php");
                } else if ($row['Status'] == 'Banned') {
                    header("Location: ../../../banned.php");
                } else if ($row['Status'] == 'Owner') {
                    header("Location: ../../../owner.php");
                } else {
                    header("Location: ../../../account.php");
                }
                exit();
            } else {
                // Foutmelding instellen voor ongeldig wachtwoord
                $_SESSION['error'] = "Ongeldige gebruikersnaam, e-mail of wachtwoord";
            }
        } else {
            // Foutmelding instellen voor ongeldige gebruikersnaam of e-mail
            $_SESSION['error'] = "Ongeldige gebruikersnaam, e-mail of wachtwoord";
        }
        // Statement sluiten
        $stmt->close();
    } else {
        // Foutmelding instellen voor mislukte voorbereiding van de query
        $_SESSION['error'] = "Er is iets misgegaan. Probeer het later opnieuw.";
    }
    // Databaseverbinding sluiten
    $conn->close();
    // Terugsturen naar het inlogformulier in geval van fout
    header("Location: ../../../login.php");
    exit();
} else {
    // Foutmelding instellen voor ongeldige verzending van het formulier
    $_SESSION['error'] = "Verzend het formulier.";
    // Terugsturen naar het inlogformulier
    header("Location: ../../../login.php");
    exit();
}