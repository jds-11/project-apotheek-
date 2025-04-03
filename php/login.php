<?php
session_start();
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    try {
        // Zoek de gebruiker op basis van e-mail
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Controleer of het wachtwoord klopt
            if (password_verify($wachtwoord, $user['wachtwoord'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['naam'];

                echo "✅ Login succesvol!";
                header("Location: ../admin/AdminPanel.html"); // Stuur naar homepage
                exit;
            } else {
                echo "❌ Fout: Ongeldig wachtwoord.";
            }
        } else {
            echo "❌ Fout: Geen account gevonden met dit e-mailadres.";
        }
    } catch (PDOException $e) {
        die("Fout bij login: " . $e->getMessage());
    }
}
?>
