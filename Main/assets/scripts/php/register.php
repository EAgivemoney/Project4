<?php
session_start();
require 'config/config.php'; // Inclusief configuratiebestand voor databaseverbinding

// Maak verbinding met de database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Controleer of de verbinding is geslaagd
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Controleer of het een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ontvang en ontsnap gebruikersinvoer
    $user = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    
    // Controleer of wachtwoorden overeenkomen
    if ($pass !== $confirm_pass) {
        $_SESSION['registration_message'] = "Wachtwoorden komen niet overeen.";
        header("Location: ../../../register.php");
        exit();
    }

    // Controleer of e-mail eindigt op .com of .nl
    if (!preg_match('/\.(com|nl)$/', $email)) {
        $_SESSION['registration_message'] = "E-mail moet eindigen op .com of .nl.";
        header("Location: ../../../register.php");
        exit();
    }

    // Controleer of gebruikersnaam minimaal 3 tekens lang is
    if (strlen($user) < 3) {
        $_SESSION['registration_message'] = "De gebruikersnaam moet minimaal 3 tekens lang zijn.";
        header("Location: ../../../register.php");
        exit();
    }

    // Controleer of wachtwoord minimaal 8 tekens lang is
    if (strlen($pass) < 8) {
        $_SESSION['registration_message'] = "Het wachtwoord moet minimaal 8 tekens lang zijn.";
        header("Location: ../../../register.php");
        exit();
    }

    // Controleer of gebruikersnaam of e-mail al bestaat in de database
    $sql_check_username = "SELECT * FROM login WHERE Username = '$user' OR Email = '$email'";
    $result_check_username = $conn->query($sql_check_username);
    if ($result_check_username->num_rows > 0) {
        $row = $result_check_username->fetch_assoc();
        if ($row['Username'] == $user) {
            $_SESSION['registration_message'] = "Gebruikersnaam bestaat al.";
        } elseif ($row['Email'] == $email) {
            $_SESSION['registration_message'] = "E-mail bestaat al.";
        }
        header("Location: ../../../register.php");
        exit();
    }

    // Voeg nieuwe gebruiker toe aan de database
    $sql = "INSERT INTO login (Username, Email, Password, Status) VALUES ('$user', '$email', '$pass', 'User')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registration_message'] = "Account geregistreerd!";
        header("Location: ../../../register.php");
        exit();
    } else {
        $_SESSION['registration_message'] = "Fout: " . $conn->error;
        header("Location: ../../../register.php");
        exit();
    }

    $conn->close();
} else {
    $_SESSION['registration_message'] = "Ongeldige verzoekmethode.";
    header("Location: ../../../register.php");
    exit();
}