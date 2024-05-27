<?php
    include('config/config.php');


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
                                Score: <td>$persoonObject->score</td>
                            </tr><br>";
    }
                    
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gameStyle.css">
    <title>Game</title>
</head>
<body>
    <div class="game">
        <div class="game-window">
            <h3>Balenciaga: <span class="Balenciaga">500.00</span></h3>
            <div class="stock-market container row">
                
                <div class=" stock Apple col-12 col-l-2 col-s-5">
                    <h4>Apple</h4>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="img/Apple.png" alt="Het logo van Apple">
                    <h5>Stabiliteit: <span class="stabiliteit">hoog</span></h5>
                    
                        <button class="kopen"><h5>kopen</h5></button>
                        <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock Nintendo col-12 col-l-2 col-s-5">
                    <h4>Nintendo</h4>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="img/nintendo.png" alt="Het logo van Nintendo">
                    <h5>Stabiliteit: <span class="stabiliteit">hoog</span></h5>
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock Youtube col-12 col-l-2 col-s-5">
                    <h4>Youtube</h4>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="img/youtube.png" alt="Het logo van Youtube">
                    <h5>Stabiliteit: <span class="stabiliteit">hoog</span></h5>
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock dogecoin col-12 col-l-2 col-s-5">
                    <h4>Dogecoin</h4>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="img/dogecoin.png" alt="het loge van dogecoin">
                    <h5>Stabiliteit: <span class="stabiliteit">laag</span></h5>
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock unity col-12 col-l-2 col-s-5">
                    <h4>Unity</h4>
                    <h5>Waarde: <span class="waarde"></span></h5>
                    <h5>Jouw aandelen:  <span class="aandelen">0</span></h5>
                    <img src="img/ubisoft.png" alt="het loge van dogecoin">
                    <h5>Stabiliteit: <span class="stabiliteit">laag</span></h5>
                    <button class="kopen"><h5>kopen</h5></button>
                    <button class="verkopen"><h5>verkopen</h5></button>
                </div>

                <div class=" stock highscore col-12 col-l-2 col-s-5">
                    <div class="score-table">
                        <?php echo "<p>" .  $scoreList . "</p>"; ?>
                    </div>
                    
                    <div class="button">
                        <button id="startBtn" class="verdwijn">Start</button>
                        <button id="stopBtn" class="verdwijn">Stop</button>
                        <button id="slowBtn" class="verdwijn">vertraag</button>
                        <button id="opslaan" class="verdwijn">end</button>
                    </div>
                </div>

                
                
            </div>
            

            
            
            <form id="saveForm" class="hidden saveData" action="" method="post">
                <input type="text" name="naam" id="name" placeholder="Voer je naam in" required>
                <input type="hidden" name="score" id="scoreValue" value="">
                <button type="submit" id="opslaanBtn">Opslaan</button>
            </form>
            <?php
    
    //dit script slaat de score op in een database en ververst de pagina zodat je het meteen kan zien
    include('config/config.php');

    
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
        </div>
    </div>

    <script src="javascrfipt/game.js"></script>
</body>
</html>
