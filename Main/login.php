<?php include("assets/includes/startVanPagina.php") ?>
    <link rel="stylesheet" href="./assets/css/login.css">
    <?php include("assets/includes/header.php") ?>
    <main>
    <div class="background-stripes"></div>
    <div class="login-container">
        <h2>Login</h2>
        <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
        ?>
        <form action="assets/scripts/php/login.php" method="post">
            <input type="text" name="identifier" placeholder="Gebruikersnaam of E-mail" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <input type="submit" value="Inloggen">
        </form>
        <p>Nog geen account? <a href="register.php">Registreer hier</a></p>

    </div>
    </main>
    <?php include("assets/includes/footer.php") ?>
</body>
</html>