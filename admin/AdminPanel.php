<?php
session_start();
if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    // Geen toegang
    header("Location: ../login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="app.js" defer></script>
</head>
<body>
    <div class="admincontainer">
        <h2>Admin Panel</h2>
        <div class="order-item">
            <p>ID: 1</p>
            <p>Naam: Jan</p>
            <p>Email: jan@gmail.com</p>
            <p>Aantal: 2</p>
            <p>Bestelling: <button>Betaald</button> <button>Verwijderen</button></p>
        </div>
        <div class="order-item">
            <p>ID: 2</p>
            <p>Naam: Pieter</p>
            <p>Email: pieter@gmail.com</p>
            <p>Aantal: 1</p>
            <p>Bestelling: <button>In behandeling</button> <button>Verwijderen</button></p>
        </div>
        <a href="/homepage/index.html" class="link">Ga naar homepage</a>
        </div>
</body>
 
</html>