<?php
session_start();
session_destroy(); // Vernietig alle sessiegegevens
header("Location: ../login/login.html"); // Stuur terug naar de loginpagina
exit;
?>
