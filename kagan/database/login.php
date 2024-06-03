<?php
session_start();

// Controleer of het inlogformulier is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Controleer of de ingevoerde gebruikersnaam en wachtwoord overeenkomen met de admincredentials
    if ($username === 'root' && $password === '0') {
        // Gebruiker is een admin, sla de inloggegevens op in de sessie
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        // Doorsturen naar de adminpagina
        header('Location: admin.php');
        exit;
    } else {
        // Gebruiker heeft ongeldige inloggegevens ingevoerd
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to bottom right, #f0f0f0, #dcdcdc); /* Define the gradient colors */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .background-stripes {
            position: fixed;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 75%, rgba(255, 255, 255, 0.1) 75%),
                        linear-gradient(-45deg, transparent 75%, rgba(255, 255, 255, 0.1) 75%);
            background-size: 40px 40px;
            z-index: 1;
        }

        .container {
            width: 80%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .admin-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #4caf50;
            text-decoration: none;
        }
        
        .admin-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="background-stripes"></div>
    <div class="container">
        <h1>Admin Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
