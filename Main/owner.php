<?php
session_start();
require 'assets/scripts/php/config/config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['status'] !== 'Owner') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Query om gebruikersgegevens op te halen met gespecificeerde volgorde
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

// Query om berichtgegevens op te halen
$messageQuery = "SELECT name, email, phone, message FROM contact";
$messageResult = $conn->query($messageQuery);

include('assets/config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

// Query om highscore-gegevens op te halen
$sql = "SELECT id, name, score, date FROM highscore ORDER BY score DESC LIMIT 10";
$statement = $pdo->prepare($sql);

if (!$statement) {
    die('Query preparation failed: ' . $pdo->errorInfo()[2]);
}

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);

$scoreList = "";

foreach ($result as $persoonObject) {
    $scoreList .= "<tr>
                        <td>$persoonObject->name</td>
                        <td>Score: $persoonObject->score</td>
                        <td>$persoonObject->date</td>
                    </tr>";
}

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
    <div class="owner-panel">
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
                <?php foreach ($result as $persoonObject): ?>
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
        <form action="assets/scripts/php/logout.php" method="post">
            <button type="submit">Uitloggen</button>
        </form>
    </div>
</main>
<?php include("assets/includes/footer.php") ?>
</body>
</html>