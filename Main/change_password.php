<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'assets/scripts/php/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) || empty($confirm_password)) {
        $errors[] = "Please fill in all fields.";
    } elseif ($new_password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $user_id = $_SESSION['user_id'];

        $sql = "UPDATE login SET Password = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $new_password, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['succes'] = "Password changed succesfully.";
            header("Location: account.php");
            exit();
        } else {
            $errors[] = "Failed to change password. Please try again.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/logout.css">
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>