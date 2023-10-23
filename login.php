<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Login studente</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <a href="index.html">
          <img src="img/logo.png" alt="" />
        </a>
      </div>
      <div class="header-link">
        <ul>
          <li>l'istituto</li>
          <li>studenti e famiglie</li>
          <li>modulistica</li>
          <li>circolari</li>
        </ul>
      </div>
    </header>
    <div class="container">
      <h2>Effettua il login</h2>
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit">Accedi</button>
      </form>
    </div>

    <?php

require_once('php/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $connessione->real_escape_string($_POST['username']);
    $password = $connessione->real_escape_string($_POST['password']);
    // $tipoUtente = $connessione->real_escape_string($_POST['tipoUtente']);
    // Esegui la query per verificare le credenziali dell'utente
    $sql = "SELECT tipoUtente FROM utenti WHERE username = '$username' AND password = '$password'";

    $result = $connessione->query($sql);
    if ($result) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $userType = $row['tipoUtente'];
    
            // Reindirizza l'utente in base al tipo di utente
            if ($userType == 1) {
                // Utente è uno studente
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['tipoUtente'] = $userType;
                header("Location: /LABORATORIO-FULL-STACK/studente-page.php");
            } elseif ($userType == 2) {
                // Utente è un admin
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['tipoUtente'] = $userType;
                header("Location: /LABORATORIO-FULL-STACK/admin-page.php");
            } else {
                echo "Tipo di utente non valido.";
            }
        } else {
            echo "Credenziali non valide. Riprova.";
        }
    } else {
        echo "Errore nella query: " . $connessione->error;
    }
}
?>
  </body>
</html>
