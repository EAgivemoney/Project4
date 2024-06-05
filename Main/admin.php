<?php
session_start();
require 'assets/scripts/php/config/config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['status'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Query om gebruikersgegevens op te halen
$userQuery = "SELECT username, email, status FROM login";
$userResult = $conn->query($userQuery);

// Query om berichtgegevens op te halen
$messageQuery = "SELECT name, email, phone, message FROM contact";
$messageResult = $conn->query($messageQuery);

$conn->close();
?>

<?php include_once("assets/includes/startVanPagina.php"); ?>
    <link rel="stylesheet" href="./assets/css/admin.css">
    <?php include("assets/includes/header.php") ?>
    <main>
    <div class="admin-panel">
        <h1>Welkom, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Je bent succesvol ingelogd als beheerder.</p>
        <h2>Gebruikers</h2>
        <table>
            <thead>
                <tr>
                    <th>Gebruikersnaam</th>
                    <th>E-mail</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $userResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h2>Berichten</h2>
        <table>
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
        <form action="assets/scripts/php/logout.php" method="post">
            <button type="submit">Uitloggen</button>
        </form>
    </div>
    </main>
    <?php include("assets/includes/footer.php") ?>
</body>
</html>