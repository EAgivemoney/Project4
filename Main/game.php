<?php
    include('assets/config/config.php');


    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";
                    
                    
        $pdo = new PDO($dsn, $dbUser, $dbPass);

        $pdo = new PDO($dsn, $dbUser, $dbPass);

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "SELECT name, score, date 
        from highscore
        Order BY score desc
        LIMIT 10";
        $statement = $pdo->prepare($sql);

        $statement->execute();  
                    
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $scoreList = "";
                    
        foreach ($result as $persoonObject) {
            $scoreList .= "<tr>
                                <td>$persoonObject->name</td>
                                 <td>Score: $persoonObject->score</td>
                            </tr>";
    }
                    
                
?>
  <?php include_once("assets/includes/startVanPagina.php"); ?>

    <link rel="stylesheet" href="assets/css/gameStyle.css">


   <?php include("assets/includes/header.php"); ?>

    <main class="Youri">

    <section class="uitleg">

    <div class="col-12 col-l-4">
        <h4>Info</h4>
        <h5>EPILEPTIE WARNING</h5>

        
        <p>In deze game ga je kennismaken met het kopen en verkopen van aandelen/cryptocurrency.
        Probeer zoveel mogelijk geld binnen te harken en kom bovenaan in de lijst te staan.
        </p>
    </div>

    <div class="col-12 col-l-4">
        <h4>Uitleg</h4>
        <p>
            In dit spel ga je voor eenvoud "aandelen" kopen en verkopen. Je Geld is te zien bovenin het handelscherm. Te herkennen aan de bitcoin-icon. hiermee kan je beginnen met handelen.<br>
            Met de 4 knoppen rechts kan je bepaalde functies uitvoeren.
            <ul class="squares">
                <li>Start = hiermee kan je het spel starten/hervatten</li>
                <li>Stop = hiermee kan je het spel op pauze zetten</li>
                <li>Vertraag = Hiermee kan je het spel tijdelijk in slow-motion zetten</li>
                <li>End = hiermee kan je het spel beëindigen.<br><span class="waarschuwing">(LET OP. Alleen het geld in je portomonee wordt meegeteld wanneer je op end klikt en daarna kan je niet meer terug)</span></li>
            </ul>
        </p>
    </div>
    <div class="col-12 col-l-4">
        <h4>Tips</h4>
        <p>
                Koop Laag.<br>
                Verkoop Hoop.<br>
                Rood betekent alleen dat het aandeel nu minder waard is dan net niet dat het aandeel goedkoop is.<br>
                Groen betekent alleen dat het aandeel nu meer waard is dan net niet dat het aandeel veel waard is.<br>
                Stabiliteit houdt in hoe snel de waarde van het aandeel schommelt. Dit kan dus goed en slecht uitpakken.
            </ul>
        </p>
    </div>
    </section>

    <div class="game">
        <div class="game-window">
            <h3>
            <svg class="coin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M504 256c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-141.7-35.3c4.9-33-20.2-50.7-54.6-62.6l11.1-44.7-27.2-6.8-10.9 43.5c-7.2-1.8-14.5-3.5-21.8-5.1l10.9-43.8-27.2-6.8-11.2 44.7c-5.9-1.3-11.7-2.7-17.4-4.1l0-.1-37.5-9.4-7.2 29.1s20.2 4.6 19.8 4.9c11 2.8 13 10 12.7 15.8l-12.7 50.9c.8 .2 1.7 .5 2.8 .9-.9-.2-1.9-.5-2.9-.7l-17.8 71.3c-1.3 3.3-4.8 8.4-12.5 6.5 .3 .4-19.8-4.9-19.8-4.9l-13.5 31.1 35.4 8.8c6.6 1.7 13 3.4 19.4 5l-11.3 45.2 27.2 6.8 11.2-44.7a1038.2 1038.2 0 0 0 21.7 5.6l-11.1 44.5 27.2 6.8 11.3-45.1c46.4 8.8 81.3 5.2 96-36.7 11.8-33.8-.6-53.3-25-66 17.8-4.1 31.2-15.8 34.7-39.9zm-62.2 87.2c-8.4 33.8-65.3 15.5-83.8 10.9l14.9-59.9c18.4 4.6 77.6 13.7 68.8 49zm8.4-87.7c-7.7 30.7-55 15.1-70.4 11.3l13.5-54.3c15.4 3.8 64.8 11 56.8 43z"/></svg>    
            Money: <span class="Balenciaga">500.00</span></h3>
            <div class="stock-market container row">
                
                <div class=" stock Apple col-12 col-l-2 col-s-5">
                    <h4>Apple</h4>
                    <h5>Stabiliteit: <span class="stabiliteit">hoog</span></h5>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="assets/img/Apple.png" alt="Het logo van Apple">
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class="stock Nintendo col-12 col-l-2 col-s-5">
                    <h4>Nintendo</h4>
                    <h5>Stabiliteit: <span class="stabiliteit">hoog</span></h5>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="assets/img/nintendo.png" alt="Het logo van Nintendo">
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock Youtube col-12 col-l-2 col-s-5">
                    <h4>Youtube</h4>
                    <h5>Stabiliteit: <span class="stabiliteit">hoog</span></h5>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="assets/img/youtube.png" alt="Het logo van Youtube">
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class="stock dogecoin col-12 col-l-2 col-s-5">
                    <h4>Dogecoin</h4>
                    <h5>Stabiliteit: <span class="stabiliteit">laag</span></h5>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="assets/img/dogecoin.png" alt="het logo van dogecoin">
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock unity col-12 col-l-2 col-s-5">
                    <h4>Ubisoft</h4>
                    <h5 class>Stabiliteit: <span class="stabiliteit">laag</span></h5>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="assets/img/ubisoft.jpg" alt="het logo van Ubisoft">
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock highscore col-12 col-l-2 col-s-5">
                    <div class="score-table">
                        
                        <table>
                            <thead>  
                            </thead>

                            <tbody>
                                <?php echo $scoreList ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="buttons">
                        <button id="startBtn" class="button verdwijn">Start</button>
                        <button id="stopBtn" class="button verdwijn">Stop</button>
                        <button id="slowBtn" class="button verdwijn">vertraag</button>
                        <button id="opslaan" class="button verdwijn">end</button>
                    </div>
                </div>

                
                
            </div>
            </div>
    </div>
    </main>
    
    <?php
    
    include('assets/config/config.php');?> 

            
            
            <form id="saveForm" class="hidden saveData" action="" method="post">
                <input type="text" name="naam" id="name" placeholder="Voer je naam in" required>
                <input type="hidden" name="score" id="scoreValue" value="">
                <button type="submit" id="opslaanBtn">Opslaan</button>
            </form>
            

<?php
    //dit script slaat de score op in een database en ververst de pagina zodat je het meteen kan zien

    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
                // Controleer of alle velden zijn ingevuld
                if (!empty($_POST['naam']) && !empty($_POST['score'])) {
                    
                    // Voer hier de code uit om de gegevens naar de database te schrijven
        
                    $pdo = new PDO($dsn, $dbUser, $dbPass);
        
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    $datum = date('Y-m-d H:i:s'); // Huidige datum en tijd

                    $sql = "INSERT INTO highscore(name, score, date) VALUES (:naam, :score, :datum)";
                    $statement = $pdo->prepare($sql);
        
                    $statement->bindValue(':naam', $_POST['naam'], PDO::PARAM_STR);
                    $statement->bindValue(':score', $_POST['score'], PDO::PARAM_STR);
                    $statement->bindValue(':datum', $datum, PDO::PARAM_STR);

                    $statement->execute();  
                    
                    echo "Score is opgeslagen";

                    echo "<script>setTimeout(function() { window.location = window.location.href; }, 1000);</script>";

        
                } else {
                    // Geef een foutmelding weer als niet alle velden zijn ingevuld
                    echo "Vul alstublieft alle velden in.";
                }
            }
?>
        


        <?php include("assets/includes/footer.php"); ?>

    <script src="assets/scripts/javascript/game.js"></script>

</body>
</html>
