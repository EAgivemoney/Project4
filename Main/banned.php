<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['status'] !== 'Banned') {
    header("Location: login.php");
    exit();
}
?>

<?php include_once("assets/includes/startVanPagina.php"); ?>
<link rel="stylesheet" href="./assets/css/banned.css">
<?php include("assets/includes/header.php") ?>
<main>
    <div class="background-stripes"></div>
    <div class="banned-container">
        <h1>Je Bent Gebanned!</h1>
    </div>
</main>
<?php include("assets/includes/footer.php") ?>
</body>
</html>