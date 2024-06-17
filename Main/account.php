<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['status'] !== 'User') {
    header("Location: login.php");
    exit();
}
?>

<?php include_once("assets/includes/startVanPagina.php"); ?>
    <link rel="stylesheet" href="./assets/css/account.css">
    <?php include("assets/includes/header.php") ?>
    <main>
        <div class="background-stripes"></div>
        <div class="account-container">
            <h1>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p>U bent succesvol ingelogd als gebruiker.</p>
            <div class="account-info">
                <h2>Uw accountgegevens</h2>
                <p><strong>Gebruikersnaam:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                <p><strong>E-mail:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>
            <div class="account-actions">
                <h2>Acties</h2>
                <ul>
                    <li><a href="#">Profiel bijwerken</a></li>
                    <li><a href="change_password.php">Wachtwoord wijzigen</a></li>
                </ul>
            </div>
        </div>
    </main>
    <?php include("assets/includes/footer.php") ?>
</body>
</html>