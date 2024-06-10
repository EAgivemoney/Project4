<?php include_once("assets/includes/startVanPagina.php"); ?> 
  <link rel="stylesheet" href="./assets/css/contact.css">
    <?php include("assets/includes/header.php"); ?>
    <main>
    <div class="background-stripes"></div>
    <div class="container">
        <div class="contact-form">
            <h1>CONTACT US</h1>
            <form action="assets/scripts/php/create.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
                
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                
                <input type="submit" value="Send">
            </form>
        </div>
        <div class="contact-details">
            <h2>CONTACT DETAILS</h2>
            <div><p>339075@student.mboutrecht.nl</p></div>
            <div><p>(06 123456789)</p></div>
            <div><p class="bold">UTRECHT</p></div>
            <div><p>Australiëlaan 25, 3526 AB Utrecht</p></div>
            <div><p class="bold">POST OPSTUREN</p></div>
            <div><p>Australiëlaan 25, 3526 AB Utrecht</p></div>
        </div>
    </div>
    </main>
    <?php include("assets/includes/footer.php"); ?>
</body>
</html>