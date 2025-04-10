<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup - Apothecare</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> <!-- Font Awesome -->
</head>
<body>
  <header>
    <div class="container">
        <nav>
            <h1><a href="../homepage/index.html">Apothecare</a></h1>
            <ul>
              <li><a href="../medicijnen/medicijnen.html">Medicijnen</a></li>
              <li><a href="../contact/contact.html">Contact</a></li>
              <li><a href="../about/overons.html">Over ons</a></li>
              <li><a href="../login/login.html">Login</a></li>
              <!-- <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li> -->
            </ul>
        </nav>
    </div>
  </header>

  <section class="signup-form">
    <div class="container">
      <div class="form-container">

        <!-- ⚠️ PHP-foutmelding weergeven -->
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error">';
            switch ($_GET['error']) {
                case 'email':
                    echo "❌ Ongeldig e-mailadres. Probeer opnieuw.";
                    break;
                case 'bestaat':
                    echo "⚠️ Dit e-mailadres is al geregistreerd.";
                    break;
                case 'velden':
                    echo "⚠️ Vul alle velden in.";
                    break;
                case 'sql':
                    echo "❌ Er is een fout opgetreden. Probeer het later opnieuw.";
                    break;
                default:
                    echo "⚠️ Onbekende fout.";
            }
            echo '</div>';
        }
        ?>

        <form action="../php/insert.php" method="POST">
          <input type="hidden" name="query1" value="1">

          <h3>Maak een account aan</h3>
          <input type="text" name="naam" placeholder="Naam" required />
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="wachtwoord" placeholder="Wachtwoord" required />
          <input type="tel" name="telefoonnummer" placeholder="Telefoonnummer" required />
          <input type="text" name="adres" placeholder="Adres" required />
          <button type="submit">Registreer</button>
        </form>
        <p>Heeft u al een account? <a href="../login/login.html">Log hier in</a>.</p>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>&copy; 2025 PharmaCare. Alle rechten voorbehouden.</p>
    </div>
  </footer>
</body>
</html>