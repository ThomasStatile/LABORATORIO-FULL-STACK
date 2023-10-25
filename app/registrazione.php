<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Registrazione studente</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <a href="index.php">
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
      <h2>Registrazione studente</h2>
      <form action="registrazione.php" method="post">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" required />
        </div>
        <div class="form-group">
          <label for="cognome">Cognome:</label>
          <input type="text" id="cognome" name="cognome" required />
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="email">email:</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit">Registrati</button>
      </form>
    </div>

    <?php
      require_once('php/config.php');

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $nome = $_POST['nome'];
          $cognome = $_POST['cognome'];
          $email = $_POST['email'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $tipoUtente = '1';

          // Verifica se esiste già un utente con lo stesso username o email
          $query1 = "SELECT username, email FROM utenti WHERE username = ? OR email = ?";
          if ($statement = $connessione->prepare($query1)) {
              $statement->bind_param("ss", $username, $email);
              $statement->execute();
              $statement->store_result();

              if ($statement->num_rows > 0) {
                  // Un utente con lo stesso username o email esiste già
                  echo "<script>alert('Username o email già esistenti.');</script>";
              } else {
                  // Nessun utente trovato, esegui l'inserimento nel database
                  $statement->close();
                  $sql = "INSERT INTO utenti (nome, cognome, email, username, password, tipoUtente) VALUES (?, ?, ?, ?, ?, ?)";
                  if ($statement = $connessione->prepare($sql)) {
                      $statement->bind_param("sssssi", $nome, $cognome, $email, $username, $password, $tipoUtente);
                      $statement->execute();
                      echo '<script>window.location.href="login.php";</script>';
                  } else {
                      echo "Errore durante la registrazione dell'utente: " . $connessione->error;
                  }
              }
          } else {
              echo "Errore durante la verifica dell'utente: " . $connessione->error;
          }

          $statement->close();
      }

      $connessione->close();
?>


  </body>
</html>
