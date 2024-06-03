<?php
session_start();
require 'assets/scripts/php/config/config.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || $_SESSION['status'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Conenction failed: " . $conn->connect_error);
}

$sql = "SELECT username, email, status FROM login";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://kit.fontawesome.com/e6d1ddc709.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="./assets/css/scrollbar.css">
</head>
<body>
    <?php include("assets/includes/header.php") ?>
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
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <form action="assets/scripts/php/logout.php" method="post">
            <button type="submit">Uitloggen</button>
        </form>
    </div>
    <?php include("assets/includes/footer.php") ?>
</body>
</html>