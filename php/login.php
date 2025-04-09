<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

  

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}



    try {
        // Zoek de gebruiker op basis van e-mail
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Controleer het wachtwoord
            if (password_verify($wachtwoord, $user['wachtwoord'])) {
                // Zet sessiegegevens
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['naam'];
                $_SESSION['user_rol'] = $user['rol']; // Zorg dat deze kolom bestaat

                // Redirect op basis van rol
                if ($user['rol'] === 'admin') {
                    header("Location: ../admin/AdminPanel.html");
                    exit;
                } else {
                    header("Location: ../medicijn/medicijnen.html");
                    exit;
                }
            } else {
                // Wachtwoord fout
                $_SESSION['error'] = "❌ Ongeldig wachtwoord.";
                header("Location: login.php");
                exit;}} 
                else {
            // Gebruiker niet gevonden
            $_SESSION['error'] = "❌ Geen account gevonden met dit e-mailadres.";
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        // Databasefout
        $_SESSION['error'] = "❌ Fout bij login: " . $e->getMessage();
        header("Location: login.php");
        exit;
    }
}
?>
