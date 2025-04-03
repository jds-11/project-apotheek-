<?php
$host = "localhost"; // Of je database host
$dbname = "apothecare"; // Pas aan naar jouw database naam
$username = "root"; // Pas aan als je een andere gebruiker hebt
$password = ""; // Pas aan als je een database wachtwoord hebt

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>
