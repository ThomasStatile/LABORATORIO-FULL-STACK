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


$sql = "INSERT INTO utenti (nome, cognome, email, username, password, tipoUtente) VALUES ( ?, ?, ?, ?, ?, ?)";

if($statement = $connessione->prepare($sql)){
    $statement->bind_param("sssssi", $nome, $cognome, $email, $username, $password, $tipoUtente);

    $nome = $_REQUEST['nome'];
    $cognome = $_REQUEST['cognome'];
    $email = $_REQUEST['email'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $tipoUtente = '1';
    $statement->execute();

    header("Location: /LABORATORIO-FULL-STACK/login.php");
}else{
    echo "Errore durante registrazione utente $sql. " . $connessione->error;
}

$statement->close();

$connessione->close();
?>
  </body>
</html>
