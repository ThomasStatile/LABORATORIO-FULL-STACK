<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Studente page</title>
  </head>
  <body>
    

    
    <?php

    if (isset($_SESSION['username'])) {
        if ($_SESSION['tipoUtente'] == 1) {
            // L'utente è uno studente
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
    

            <section class="hero2">
              <a href="voti-studenti.php"
              ><div class="form">
              <img src="img/voti.jpg" alt="" />
              <div class="text">Visualizza i tuoi voti</div>
              </div></a
              >
              <a href="studenti-feedback.php"
              ><div class="form">
              <img src="img/feedback.jpg" alt="" />
              <div class="text">Valuta il corso</div>
              </div></a
              >
            </section>

  
          </body>
        </html>
            ';
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
    
    
