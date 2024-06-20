<?php
include_once('../../config/config.php');

    $dsn = "mysql:host=$dbHost;
    dbname=$dbName;
    charset=UTF8";
            
            
$pdo = new PDO($dsn, $dbUser, $dbPass);


$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $requiredFields = ['service', 'fname', 'lname', 'birth', 'gender', 'adres', 'Postcode', 'email', 'phone'];
    $missingFields = [];
    
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            $missingFields[] = $field;
        }
    }
    
    if (!empty($missingFields)) {
        echo "Niet alle verplichte velden zijn ingevuld: " . implode(', ', $missingFields);
        exit; // Stop de uitvoering als niet alle velden zijn ingevuld
    }
    $datum = date('Y-m-d H:i:s'); // Huidige datum en tijd

    $sql = "INSERT INTO inschrijven(BurgerServiceNummer, 
                                    firstName,
                                    infix,
                                    lastName,
                                    birthDate,
                                    gender,
                                    adres,
                                    postcode,
                                    email,
                                    tel,
                                    inschrijfDatum) 
                                    
                                    VALUES (:BurgerServiceNummer,
                                            :firstName,
                                            :infix, 
                                            :lastName,
                                            :birthDate,
                                            :gender,
                                            :adres,
                                            :postcode,
                                            :email,
                                            :tel,
                                            :inschrijfDatum)";

    $statement = $pdo->prepare($sql);

    // Array voorbereiden met invoerwaarden
    $data = [
        ':BurgerServiceNummer' => $_POST['service'],
        ':firstName' => $_POST['fname'],
        ':infix' => $_POST['infix'],
        ':lastName' => $_POST['lname'],
        ':birthDate' => $_POST['birth'],
        ':gender' => $_POST['gender'],
        ':adres' => $_POST['adres'],
        ':postcode' => $_POST['Postcode'],
        ':email' => $_POST['email'],
        ':tel' => $_POST['phone'],
        ':inschrijfDatum' => $datum // Hier wordt de variabele $datum correct als bindparameter gebruikt
    ];

    // Gegevens binden aan parameters en uitvoeren van de query
    if ($statement->execute($data)) {
        echo "Invoeging van gegevens succesvol!";
    } else {
        echo "Fout bij het invoegen van gegevens: " . $statement->errorInfo()[2];
    }
    header("Location: ../../../inschrijven.php");
}