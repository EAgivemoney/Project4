<?php
session_start();
require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    $sql = "SELECT Id, Username, Password, Status FROM login WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($pass === $row['Password']) {
                $_SESSION['user_id'] = $row['Id'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['status'] = $row['Status'];

                if ($row['Status'] == 'Admin') {
                    header("Location: ../../../admin.php");
                } else {
                    header("Location: ../../../account.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Invalid password";
            }
        } else {
            $_SESSION['error'] = "Invalid username";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again later.";
    }
    $conn->close();
    header("Location: ../../../login.php");
    exit();
} else {
    $_SESSION['error'] = "Please submit the form.";
    header("Location: ../../../login.php");
    exit();
}