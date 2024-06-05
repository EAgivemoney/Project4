<?php include("assets/includes/startVanPagina.php") ?>
    <link rel="stylesheet" href="./assets/css/register.css">
    <?php include("assets/includes/header.php") ?>
    <main>
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
    </main>
    <?php include("assets/includes/footer.php") ?>
</body>
</html>