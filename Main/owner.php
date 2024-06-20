<?php
session_start();
require 'assets/scripts/php/config/config.php';

// Check if the user is logged in and is the owner
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['status'] !== 'Owner') {
    header("Location: login.php");
    exit();
}

// Create a new database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users' data
$userQuery = "
    SELECT id, username, email, status
    FROM login
    ORDER BY
        CASE
            WHEN status = 'Owner' THEN 1
            WHEN status = 'Admin' THEN 2
            WHEN status = 'User' THEN 3
            WHEN status = 'Banned' THEN 4
            ELSE 5
        END, username
";
$userResult = $conn->query($userQuery);

// Fetch messages data
$messageQuery = "SELECT name, email, phone, message FROM contact";
$messageResult = $conn->query($messageQuery);

require 'assets/config/config.php';

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

// Fetch highscore data
$highscoreQuery = "SELECT id, name, score, date FROM highscore ORDER BY score DESC LIMIT 10";
$highscoreStatement = $pdo->prepare($highscoreQuery);

if (!$highscoreStatement) {
    die('Query preparation failed: ' . $pdo->errorInfo()[2]);
}

$highscoreStatement->execute();
$highscoreResult = $highscoreStatement->fetchAll(PDO::FETCH_OBJ);

// Fetch registration data
$registerQuery = "SELECT id, BurgerServiceNummer, firstName, infix, lastName, birthDate, gender, adres, postcode, email, tel, inschrijfDatum FROM inschrijven ORDER BY firstName DESC";
$registerStatement = $pdo->prepare($registerQuery);

if (!$registerStatement) {
    die('Query preparation failed: ' . $pdo->errorInfo()[2]);
}

$registerStatement->execute();
$registerResult = $registerStatement->fetchAll(PDO::FETCH_OBJ);

// Update user status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user_status'])) {
        $userId = $_POST['user_id'];
        $newStatus = $_POST['new_status'];
        $updateStatusQuery = "UPDATE login SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateStatusQuery);
        $stmt->bind_param('si', $newStatus, $userId);
        $stmt->execute();
        header("Location: owner.php");
        exit();
    }

    // Update highscore
    if (isset($_POST['update_highscore'])) {
        $scoreId = $_POST['score_id'];
        $newScore = $_POST['new_score'];
        $updateScoreQuery = "UPDATE highscore SET score = ? WHERE id = ?";
        $stmt = $pdo->prepare($updateScoreQuery);

        if (!$stmt) {
            die('Query preparation failed: ' . $pdo->errorInfo()[2]);
        }

        $stmt->bindParam(1, $newScore, PDO::PARAM_INT);
        $stmt->bindParam(2, $scoreId, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: owner.php");
        exit();
    }
}

$conn->close();
?>

<?php include_once("assets/includes/startVanPagina.php"); ?>
<link rel="stylesheet" href="./assets/css/owner.css">
<?php include("assets/includes/header.php") ?>
<main>
    <div class="background-stripes"></div>
    <div class="owner-panel col-7">
        <h1>Welkom, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Je bent succesvol ingelogd als eigenaar.</p>
        <h2>Gebruikers</h2>
        <table class="owner-users-table">
            <thead>
                <tr>
                    <th>Gebruikersnaam</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $userResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] !== 'Owner'): ?>
                        <form method="post" action="" class="owner-status-form">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <select name="new_status">
                                <option value="User" <?php if ($row['status'] == 'User') echo 'selected'; ?>>User</option>
                                <option value="Admin" <?php if ($row['status'] == 'Admin') echo 'selected'; ?>>Admin</option>
                                <option value="Banned" <?php if ($row['status'] == 'Banned') echo 'selected'; ?>>Banned</option>
                            </select>
                            <button type="submit" name="update_user_status">Bijwerken</button>
                        </form>
                        <?php else: ?>
                        <p>Kan niet wijzigen</p>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h2>Berichten</h2>
        <table class="owner-messages-table">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th>Telefoonnummer</th>
                    <th>Bericht</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $messageResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h2>Highscores</h2>
        <table class="owner-highscores-table">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Score</th>
                    <th>Datum</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($highscoreResult as $persoonObject): ?>
                <tr>
                    <td><?php echo htmlspecialchars($persoonObject->name); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->score); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->date); ?></td>
                    <td>
                        <form method="post" action="" class="owner-score-form">
                            <input type="hidden" name="score_id" value="<?php echo $persoonObject->id; ?>">
                            <input type="number" name="new_score" value="<?php echo $persoonObject->score; ?>">
                            <button type="submit" name="update_highscore">Bijwerken</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Ingeschreven</h2>
        <table class="owner-register-table">
            <thead>
                <tr>
                    <th>BSN</th>
                    <th>Naam</th>
                    <th>Geboortedatum</th>
                    <th>Geslacht</th>
                    <th>Adres</th>
                    <th>Postcode</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Ingeschreven</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registerResult as $persoonObject): ?>
                <tr>
                    <td><?php echo htmlspecialchars($persoonObject->BurgerServiceNummer); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->firstName . ' ' . $persoonObject->infix . ' ' . $persoonObject->lastName); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->birthDate); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->gender); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->adres); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->postcode); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->email); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->tel); ?></td>
                    <td><?php echo htmlspecialchars($persoonObject->inschrijfDatum); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include("assets/includes/footer.php") ?>
</>
</html>