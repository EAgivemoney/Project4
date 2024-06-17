<?php include_once("assets/includes/startVanPagina.php"); ?>
    <link rel="stylesheet" href="./assets/css/inschrijven.css">
<?php include("assets/includes/header.php"); ?>
    <main>
        <h2>Vul het formulier in om uzelf aan te melden</h2>
        <form action="assets/scripts/php/inschrijven.php" methode="POST">
                <label for="service">BurgerSeviceNummer</label>
                <input type="text" id="service" name="service" required>
        
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
                
                <label for="birth">geboorte datum</label>
                <input type="text" id="birth" name="birth" required>



                <input type="submit" value="Send">
        </form>
    </main>
<?php include("assets/includes/footer.php"); ?>