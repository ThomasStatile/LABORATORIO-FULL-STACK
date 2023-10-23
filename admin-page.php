<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Admin page</title>
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

    <?php
    session_start();

    if (isset($_SESSION['username'])) {
        if ($_SESSION['tipoUtente'] == 1) {
            // L'utente è uno studente
            echo '
            <h1> Non sei autorizzato ad accedere a questa pagina </h1>
            <a href="studente-page.php">Vai alla tua area privata. </a> 
            ';
          exit();
        } elseif ($_SESSION['tipoUtente'] == 2) {
            // L'utente è un amministratore
            echo '
            <h1 id="user">Ciao ' . $_SESSION['username'] . '</h1>
            <div class="logout">
              <a href="logout.php">
                <!-- <i class="fa fa-sign-out" id="logout-icon"></i> -->
                <button id="logout-text">Logout</button>
              </a>
            </div>

            <section class="hero2">
              <a href="admin-voti.php"
              ><div class="form">
              <img src="img/voti.jpg" alt="" />
              <div class="text">voti studenti</div>
              </div></a
              >
              <a href="admin-feedback.php"
              ><div class="form">
              <img src="img/feedback.jpg" alt="" />
              <div class="text">feedback corsi</div>
              </div></a
              >
            </section>
          </body>
        </html>
            ';
        } 
    } else {
        // La sessione non contiene il tipo di utente, quindi l'utente non è autenticato
        echo '
        <h1> Non sei autorizzato ad accedere a questa pagina.</h1>
        <p> <a href="registrazione.php"> Registrati </a>  oppure effettua il <a href="login.php"> Login </a>

        ';
        exit();
    }
    
    ?>
    
