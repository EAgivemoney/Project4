<?php include("assets/includes/startVanPagina.php") ?>
    <link rel="stylesheet" href="./assets/css/register.css">
    <?php include("assets/includes/header.php") ?>
    <main>
        <div class="background-stripes"></div>
        <div class="register-container">
            <h2>Register</h2>
            <?php
                session_start();
                if(isset($_SESSION['registration_message'])) {
                    echo '<p class="registration-message">' . $_SESSION['registration_message'] . '</p>';
                    unset($_SESSION['registration_message']);
                }

                $username = isset($_SESSION['form_data']['username']) ? $_SESSION['form_data']['username'] : '';
                $email = isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '';
                unset($_SESSION['form_data']);
            ?>
            <form action="assets/scripts/php/register.php" method="post">
                <input type="text" name="username" placeholder="Gebruikersnaam" value="<?php echo htmlspecialchars($username); ?>" required minlength="3">
                <div class="error-message"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></div>

                <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>" required pattern=".+@.+\.(com|nl)$" title="E-mail moet eindigen op .com of .nl.">
                <div class="error-message"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></div>

                <input type="password" name="password" placeholder="Wachtwoord" required minlength="8">
                <div class="error-message"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></div>

                <input type="password" name="confirm_password" placeholder="Wachtwoord bevestigen" required minlength="8">
                <div class="error-message"><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : ''; ?></div>

                <input type="submit" value="Registreren">
            </form>
            <p>Heb je al een account? <a href="login.php">Hier inloggen</a></p>
        </div>
    </main>
    <?php include("assets/includes/footer.php") ?>
    <script src="assets/scripts/javascript/register.js"></script>
</body>
</html>