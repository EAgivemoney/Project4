<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message])) {
        echo "Yes!! Your message got saved!";
    } else {
        echo "Idk what have you have done but you failed to get saved in to our database";
    }
}
?>


