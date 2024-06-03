<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/register.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php
            session_start();
            if(isset($_SESSION['registration_message'])) {
                echo '<p class="registration-message">' . $_SESSION['registration_message'] . '</p>';
                unset($_SESSION['registration_message']);
            }
        ?>
        <form action="assets/scripts/php/register.php" method="post">
            <input type="text" name="username" placeholder="Gebruikersnaam" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <input type="password" name="confirm_password" placeholder="Wachtwoord bevestigen" required>
            <input type="submit" value="Registreren">
        </form>
        <p>Heb je al een account? <a href="login.php">Hier inloggen</a></p>
    </div>
</body>
</html>