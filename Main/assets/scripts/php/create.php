<?php
require 'config/config2.0.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message])) {
        echo "Uw bericht is opgeslagen in onze database!";
        header("../../../contact.php");
    }
}