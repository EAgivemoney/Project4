<?php

session_start();
require 'config/config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];

if ($pass !== $confirm_pass) {
    die("Passwords do not match.");
}

$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

$user = $conn->real_escape_string($user);
$email = $conn->real_escape_string($email);

$sql = "INSERT INTO login (Username, Email, Password) VALUES ('$user', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration Succesful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();