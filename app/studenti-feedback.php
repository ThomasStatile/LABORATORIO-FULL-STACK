<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Studenti feedback</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
  </head>
  <body>
    
    
    <?php

    require_once('php/config.php');

    if (isset($_SESSION['username'])) {
        if ($_SESSION['tipoUtente'] == 1) {
            // L'utente è uno studente

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $corso = $_POST["corso"];
              $rating = $_POST["rating"];
              $comment = $_POST["comment"];
              $username = $_SESSION['username'];
              
              $sql1 = " SELECT idUtente
              FROM utenti
              WHERE username = '$username' ";
              $resSql1 = $connessione->query($sql1);

              if ($resSql1) {
                $rowSql1 = $resSql1->fetch_assoc();
                $idUtente = $rowSql1['idUtente']; 
              
              $sql2 = " SELECT idcorso 
              FROM corsi
              WHERE corso = '$corso'; ";
              $resSql2 = $connessione->query($sql2);

              if ($resSql2) {
                $rowSql2 = $resSql2->fetch_assoc();
                $idCorso = $rowSql2['idcorso'];

              $sql3 = " INSERT INTO feedback_corsi (id_utente, id_corso, feedback, testo_feedback)
              VALUES ('$idUtente', '$idCorso', '$rating', '$comment'); ";
          
          if ($connessione->query($sql3) === TRUE) {
            // echo "Feedback inserito con successo.";
            $feedbackInserito = true;
            
            } else {
                echo "Errore nell'inserimento del feedback: " . $connessione->error;
            }
            } else {
                echo "Errore nell'esecuzione della query SQL2: " . $connessione->error;
            }
            } else {
                echo "Errore nell'esecuzione della query SQL1: " . $connessione->error;
      }

    }     

    if (isset($feedbackInserito) && $feedbackInserito) {
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
      <div class="feed-ok">
      <h1> Feedback inserito con successo</h1>
      <a href="studente-page.php"><button class="message-btn">Torna alla tua area privata.</button> </a>
      </div>';
  } else {
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
      <div class="container2">
        <h2>Valutazione del Corso</h2>
        <form action="studenti-feedback.php" method="post">
          <label for="corso">Seleziona il corso:</label>
          <select id="corso" name="corso">
            <option value="Sviluppo Frontend" id="1">Sviluppo Frontend</option>
            <option value="Sviluppo Backend" id="2">Sviluppo Backend</option>
            <option value="UX/UI Design" id="3">UX/UI Design</option>
            <option value="Database" id="4"> Database</option>
            <option value="Inglese" id="5">Inglese</option>
            <option value="DevOps" id="6">DevOps</option>
            <option value="Big Data" id="7">Big Data</option>
          </select>

         <label for="rating">Valutazione:</label>
          <select id="rating" name="rating">
            <option value="Pessimo" id="1">Pessimo</option>
            <option value="Decente" id="2">Decente</option>
            <option value="Buono" id="3">Buono</option>
            <option value="Ottimo" id="4"> Ottimo</option>
            <option value="Eccellente" id="5">Eccellente</option>
          </select>

        <label for="comment">Scrivi una recensione:</label>
        <textarea id="comment" name="comment" class="review-text"></textarea>

        <button type="submit">Invia Valutazione</button>
       </form>
      </div>
      ';
  
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
            <div class="feed-ok">
            <h1> Non sei autorizzato ad accedere a questa pagina</h1>
            <a href="admin-page.php"><button class="message-btn">Vai alla tua area privata.</button> </a>
            </div>
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
