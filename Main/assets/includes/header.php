  <link rel="stylesheet" href="./assets/css/global.css">
  <link rel="stylesheet" href="./assets/css/navbarEnFooter.css">
  <link rel="stylesheet" href="./assets/css/scrollbar.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 
  <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="fixed">
            <div class="menu-container">
                <div class="logo">
                    <span>Daytr</span>ading
                    <p>Market<span>trends</span></p>
                </div>
                <div class="main-menu row jc-space-between">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="informatie.php">Info opleiding</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="aboutUs.php">Over Ons</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="game.php">Game</a></li>
                        <li><a href="inschrijven.php">Inschrijven</a></li>
                    </ul>
                </div>
                <div class="user-menu">
                    <ul>
                        <?php
                            $current_page = basename($_SERVER['PHP_SELF']);
                            $logout_pages = ['account.php', 'admin.php', 'banned.php', 'owner.php'];
                            if (in_array($current_page, $logout_pages)) {
                                echo '<li><a href="assets/scripts/php/logout.php">Uitloggen</a></li>';
                            } else {
                                echo '<li><a href="login.php">Inloggen</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="progress-bar"></div>
        </nav>
    </header>