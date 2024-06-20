<?php
session_start();
require 'config/config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    
    // Check if passwords match
    if ($pass !== $confirm_pass) {
        $_SESSION['registration_message'] = "Passwords do not match.";
        header("Location: ../../../register.php");
        exit();
    }

    // Check if username already exists
    $sql_check_username = "SELECT * FROM login WHERE Username = '$user'";
    $result_check_username = $conn->query($sql_check_username);
    if ($result_check_username->num_rows > 0) {
        $_SESSION['registration_message'] = "Username already exists.";
        header("Location: ../../../register.php");
        exit();
    }

    // Insert new user with plain text password
    $sql = "INSERT INTO login (Username, Email, Password, Status) VALUES ('$user', '$email', '$pass', 'User')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registration_message'] = "Account registered!";
        header("Location: ../../../register.php");
        exit();
    } else {
        $_SESSION['registration_message'] = "Error: " . $conn->error;
        header("Location: ../../../register.php");
        exit();
    }

    $conn->close();
} else {
    $_SESSION['registration_message'] = "Invalid request method.";
    header("Location: ../../../register.php");
    exit();
}
?>