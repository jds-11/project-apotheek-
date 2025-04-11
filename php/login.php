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
            // Controleer of het wachtwoord klopt
            // Controleer het wachtwoord
            if (password_verify($wachtwoord, $user['wachtwoord'])) {
                // Zet sessiegegevens
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['naam'];
                $_SESSION['user_rol'] = $user['rol']; // Zorg dat deze kolom bestaat

                echo "✅ Login succesvol!";
                header("Location: ../admin/AdminPanel.html"); // Stuur naar homepage
                exit;
                // Redirect op basis van rol
                if ($user['rol'] === 'admin') {
                    header("Location: ../admin/AdminPanel.html");
                    exit;
                } else {
                    header("Location: ../medicijnen/Medicijnen.html");
                    exit;
                }
            } else {
                echo "❌ Fout: Ongeldig wachtwoord.";
            }
        } else {
            echo "❌ Fout: Geen account gevonden met dit e-mailadres.";
                // Wachtwoord fout
                $_SESSION['error'] = "❌ Ongeldig wachtwoord.";
                header("Location: login.php");
                exit;}} 
                else {
            // Gebruiker niet gevonden
            $_SESSION['error'] = "❌ Geen account gevonden met dit e-mailadres.";
            header("Location: login.php");
        }
    } catch (PDOException $e) {
        die("Fout bij login: " . $e->getMessage());
        // Databasefout
        $_SESSION['error'] = "❌ Fout bij login: " . $e->getMessage();
        header("Location: login.php");
        exit;
    }
}
?>

