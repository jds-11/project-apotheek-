<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query1'])) {
    try {
        // Controleer of alle velden bestaan
        if (!isset($_POST['naam'], $_POST['email'], $_POST['wachtwoord'], $_POST['telefoonnummer'], $_POST['adres'])) {
            die("Fout: Niet alle vereiste velden zijn ingevuld.");
        }

        // Verkrijg gegevens uit het formulier
        $naam = $_POST['naam'];
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $adres = $_POST['adres'];

        // Hash het wachtwoord voor veiligheid
        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

        // Debugging: Print de SQL-query (tijdelijk)
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

        echo "✅ Gebruiker succesvol geregistreerd!";
        header("Location: ../login/login.html"); // Optioneel: doorsturen naar login
        exit;

    } catch (PDOException $e) {
        die("❌ Fout bij invoegen: " . $e->getMessage());
    }
}
?>


 