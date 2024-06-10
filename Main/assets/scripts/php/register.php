<?php
session_start();
require 'config/config.php'; // Inclusief configuratiebestand voor databaseverbinding

$errors = array();

// Make connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receive and escape user input
    $user = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Store the form data in session
    $_SESSION['form_data'] = [
        'username' => $user,
        'email' => $email
    ];

    // Check if passwords match
    if ($pass !== $confirm_pass) {
        $errors['confirm_password'] = "Wachtwoorden komen niet overeen.";
    }

    // Check if email ends with .com or .nl
    if (!preg_match('/\.(com|nl)$/', $email)) {
        $errors['email'] = "E-mail moet eindigen op .com of .nl.";
    }

    // Check if username is at least 3 characters long
    if (strlen($user) < 3) {
        $errors['username'] = "De gebruikersnaam moet minimaal 3 tekens lang zijn.";
    }

    // Check if password is at least 8 characters long
    if (strlen($pass) < 8) {
        $errors['password'] = "Het wachtwoord moet minimaal 8 tekens lang zijn.";
    }

    // Check if username or email already exists in the database
    $sql_check_username = "SELECT * FROM login WHERE Username = '$user' OR Email = '$email'";
    $result_check_username = $conn->query($sql_check_username);
    if ($result_check_username->num_rows > 0) {
        $row = $result_check_username->fetch_assoc();
        if ($row['Username'] == $user) {
            $errors['username'] = "Gebruikersnaam bestaat al.";
        } elseif ($row['Email'] == $email) {
            $errors['email'] = "E-mail bestaat al.";
        }
    }

    // If there are errors, redirect back to registration page with errors
    if (!empty($errors)) {
        $_SESSION['registration_message'] = "Er zijn fouten opgetreden bij het registreren.";
        $_SESSION['errors'] = $errors;
        header("Location: ../../../register.php");
        exit();
    }

    // Add new user to the database
    $sql = "INSERT INTO login (Username, Email, Password, Status) VALUES ('$user', '$email', '$pass', 'User')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registration_message'] = "Account geregistreerd!";
        unset($_SESSION['form_data']); // Clear form data on successful registration
        header("Location: ../../../register.php");
        exit();
    } else {
        $_SESSION['registration_message'] = "Fout: " . $conn->error;
        header("Location: ../../../register.php");
        exit();
    }
} else {
    $_SESSION['registration_message'] = "Ongeldige verzoekmethode.";
    header("Location: ../../../register.php");
    exit();
}

$conn->close();