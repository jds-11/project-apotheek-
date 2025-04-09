<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query1'])) {
    try {
        if (!isset($_POST['naam'], $_POST['email'], $_POST['wachtwoord'], $_POST['telefoonnummer'], $_POST['adres'])) {
            header("Location: ../signup/signup.php?error=velden");
            exit;
        }
        
        $naam = $_POST['naam'];
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $adres = $_POST['adres'];

        // ✅ Check of het e-mailadres geldig is
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup/signup.php?error=email");
            exit;
        }

        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

        // Check of e-mail al bestaat
        $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $checkEmail->execute([':email' => $email]);

        if ($checkEmail->rowCount() > 0) {
            header("Location: ../signup/signup.php?error=bestaat");
            exit;
        }

        // Voeg gebruiker toe
        $sql = "INSERT INTO users (naam, email, wachtwoord, telefoonnummer, adres) 
                VALUES (:naam, :email, :wachtwoord, :telefoonnummer, :adres)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':naam' => $naam,
            ':email' => $email,
            ':wachtwoord' => $hashed_password,
            ':telefoonnummer' => $telefoonnummer,
            ':adres' => $adres
        ]);

        header("Location: ../login/login.html");
        exit;

    } catch (PDOException $e) {
        header("Location: ../signup/signup.php?error=sql");
        exit;
    }
}
?>
