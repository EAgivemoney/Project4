<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['status'] !== 'User') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/e6d1ddc709.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/account.css">
    <link rel="stylesheet" href="./assets/css/scrollbar.css">
</head>
<body>
    <?php include("assets/includes/header.php") ?>
    <hr>
    <div class="account-container">
        <h1>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>U bent succesvol ingelogd als gebruiker.</p>
        <div class="account-info">
            <h2>Uw accountgegevens</h2>
            <p><strong>Gebruikersnaam:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
        <div class="account-actions">
            <h2>Acties</h2>
            <ul>
                <li><a href="#">Profiel bijwerken</a></li>
                <li><a href="change_password.php">Wachtwoord wijzigen</a></li>
            </ul>
        </div>
        <form action="assets/scripts/php/logout.php" method="post">
            <button type="submit">Uitloggen</button>
        </form>
    </div>
    <?php include("assets/includes/footer.php") ?>
</body>
</html>