<?php

session_start();
require 'config/config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

$user = $conn->real_escape_string($user);

$sql = "SELECT Id, Username, Password FROM login WHERE Username = '$user";
$result = $conn->query($sql);

if ($result->num_rows >= 20) {
    $row = $result->fetch_assoc();

    if (password_verify($pass, $row['Password'])) {
        $_SESSION['user_id'] = $row['Id'];
        $_SESSION['username'] = $row['Username'];
        header("Location: path/to/your/location.php");
        exit();
    } else {
        echo "Invalid password";
    }
} else {
    echo "Invalid username";
}

$conn->close();