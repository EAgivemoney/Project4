<?php include_once("assets/includes/startVanPagina.php"); ?>
    <link rel="stylesheet" href="assets/css/inschrijven.css">
<?php include("assets/includes/header.php"); ?>
    <main>
        <section>
            <div>
                <form action="assets/scripts/php/inschrijven.php" method="POST" id="inschrijfformulier" novalidate>
                <h2>Vul het formulier in om uzelf aan te melden</h2>

                        
                        <label for="service">*BurgerSeviceNummer:</label>
                        <input type="text" id="service" name="service" required>
                        <div id="service-error" class="error"></div>

                
                        <label for="fname">*voornaam:</label>
                        <input type="text" id="fname" name="fname" required>
                        <div id="fname-error" class="error"></div>


                        <label for="infix">tussenvoegsel:</label>
                        <input type="text" id="infix" name="infix">
                        <div id="infix-error" class="error"></div>


                        <label for="lname">*achternaam:</label>
                        <input type="text" id="lname" name="lname" required>
                        <div id="lname-error" class="error"></div>


                        <label for="birth">*geboorte datum:</label>
                        <input type="date" id="birth" name="birth" required>
                        <div id="birth-error" class="error"></div>


                        <label for="gender">*gender:</label>
                        <div class="list">
                            <label>Man:</label>
                            <input type="radio" id="boy" name="gender" required>

                            <label>Vrouw:</label>
                            <input type="radio" id="girl" name="gender" required>
                        </div>
                        <div id="gender-error" class="error"></div>


                        <label for="adres">*Adres:</label>
                        <input type="text" id="adres" name="adres" required>
                        <div id="adres-error" class="error"></div>


                        <label for="Postcode">*Postcode:</label>
                        <input type="text" id="Postcode" name="Postcode" required>
                        <div id="Postcode-error" class="error"></div>

                        
                        <label for="email">*E-mail:</label>
                        <input type="email" id="email" name="email" required>
                        <div id="email-error" class="error"></div>

                        
                        <label for="phone">*Tel nummer:</label>
                        <input type="tel" id="phone" name="phone" required>
                        <div id="phone-error" class="error"></div>


                        <input type="submit" class="submit" value="Submit">

                        <p class="ps">* = MOET ingevuld worden</p>

                </form>
            </div>
        </section>
    </main>
    <script src="assets/scripts/javascript/inschrijven.js"></script>
<?php include("assets/includes/footer.php"); ?>