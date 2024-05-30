<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'assets/scripts/php/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) || empty($confirm_password)) {
        $errors[] = "Gelieve alle velden in te vullen.";
    } elseif ($new_password !== $confirm_password) {
        $errors[] = "Wachtwoorden komen niet overeen.";
    }

    if (empty($errors)) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $user_id = $_SESSION['user_id'];

        $sql = "UPDATE login SET Password = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $new_password, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['succes'] = "Wachtwoord succesvol gewijzigd.";
            header("Location: account.php");
            exit();
        } else {
            $errors[] = "Wachtwoord kan niet worden gewijzigd. Probeer het opnieuw.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verander wachtwoord</title>
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/logout.css">
    <script src="https://kit.fontawesome.com/e6d1ddc709.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Verander wachtwoord</h1>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="new_password">Nieuwe wachtwoord:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Wachtwoord bevestigen:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit">Wachtwoord wijzigen</button>
        </form>
    </div>
</body>
</html>