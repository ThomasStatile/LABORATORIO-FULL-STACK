<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
    <title>Voti Studente</title>
  </head>
  <body>
    
    
    <?php

    require_once('php/config.php');


    if (isset($_SESSION['username'])) {
        if ($_SESSION['tipoUtente'] == 1) {
            // L'utente è uno studente
            $username = $connessione->real_escape_string($_SESSION['username']);

            $sql = " SELECT c.corso, vc.voto
            FROM voti_corsi vc
            INNER JOIN corsi c ON c.idcorso = vc.id_corso
            INNER JOIN utenti u ON u.idUtente = vc.id_utente
            WHERE u.username = '$username';";
        
            $result = $connessione->query($sql);
            if($result){
              if ($result->num_rows > 0) {
                echo '
                <header>
                  <div class="logo">
                    <a href="index.php">
                      <img src="img/logo.png" alt="" />
                    </a>
                  </div>
                  <div class="header-link">
                    <ul>
                      <li>istituto</li>
                      <li>studenti e famiglie</li>
                      <li>modulistica</li>
                      <li>circolari</li>
                    </ul>
                  </div>
                  <div class="user-links">
                  <p> Benvenuto ' . $_SESSION['username'] . ' </p>
                  <a href="studente-page.php"> <i class="fas fa-user"></i> </a>
                  <a href="logout.php"> <i class="fas fa-sign-out iconlogout"></i> </a> 
                  </div>
                </header>
                <div class="go-back"><a href="studente-page.php"> <button class="btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i>Go Back </button> </a></div>
                <table>
                <thead>
                <tr>
                <th>Corso</th>
                <th>Voto</th>
                </tr>
                </thead>
                <tbody> 
                ';
            while($row = $result->fetch_array()){
            echo '
            <tr>
            <td>' . $row['corso'] . '</td>
            <td>' . $row['voto'] . '</td>
            </tr> 
            ';
          }
            echo '</tbody></table>';
          }else{
            echo 'Non ci sono righe per questo campo.';
          }
          }else{
            echo "Impossibile eseguire la query $sql. " . $connessione->error;
          }
  
      } elseif ($_SESSION['tipoUtente'] == 2) {
            // L'utente è un amministratore
            echo '
            <header>
              <div class="logo">
                <a href="index.php">
                  <img src="img/logo.png" alt="" />
                </a>
              </div>
              <div class="header-link">
                <ul>
                  <li>istituto</li>
                  <li>studenti e famiglie</li>
                  <li>modulistica</li>
                  <li>circolari</li>
                </ul>
              </div>
            </header>
            <div class="feed-ok"><h1> Non sei autorizzato ad accedere a questa pagina</h1>
            <a href="admin-page.php"><button class="message-btn">Vai alla tua area privata.</button> </a></div>
            ';
          exit();
        } 
    } else {
        // La sessione non contiene il tipo di utente, quindi l'utente non è autenticato
        echo '
        <header>
          <div class="logo">
            <a href="index.php">
              <img src="img/logo.png" alt="" />
            </a>
          </div>
          <div class="header-link">
            <ul>
              <li>istituto</li>
              <li>studenti e famiglie</li>
              <li>modulistica</li>
              <li>circolari</li>
            </ul>
          </div>
        </header>
        <div class="notlog">
        <div class="message"><h1> Non sei autorizzato ad accedere a questa pagina</h1></div>
        <div class="btn-notlog">
        <a href="registrazione.php"><button class="message-btn">Registrati</button> </a>  <a href="login.php"><button class="message-btn">Accedi</button> </a>
        </div>
        </div>
        ';
        exit();
    }
    
    ?>

    
  </body>
</html>
