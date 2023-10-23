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
    <div class="go-back"><a class="button" href="studente-page.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>Go Back</a></div>
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

        <label for="rating">Valutazione del corso:</label>
        <div class="rating">
          <div class="rating">
          <input type="radio" name="rating" value="1">1
            <input type="radio" name="rating" value="2">2
            <input type="radio" name="rating" value="3">3
            <input type="radio" name="rating" value="4">4
            <input type="radio" name="rating" value="5">5
          </div>
        </div>

        <label for="review">Scrivi una recensione:</label>
        <textarea id="review" name="review" class="review-text"></textarea>

        <button type="submit">Invia Valutazione</button>
      </form>
    </div>

    <?php

    require_once('php/config.php');

    session_start();

    if (isset($_SESSION['username'])) {
        if ($_SESSION['tipoUtente'] == 1) {
            // L'utente è uno studente

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $corso = $_POST["corso"];
              $rating = $_POST["rating"];
              $comment = $_POST["comment"];
              
              $sql = " INSERT INTO feedback_corsi (id_utente, id_corso, feedback, testo_feedback)
              VALUES ('4', '2', '3', 'Il corso ha soddisfatto in parte le mie aspettative'); ";
          
              $result = $connessione->query($sql);
              if($result){
                if ($result->num_rows > 0) {
                  echo '
                  <table>
                  <thead>
                  <tr>
                  <th>Corso</th>
                  <th>Voto</th>
                  </tr>
                  </thead>
                  <tbody> 
                  ';
                  echo '<div class="go-back"><a class="button" href="studente-page.php">Go Back<i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>';
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
            
            }
            
  
      } elseif ($_SESSION['tipoUtente'] == 2) {
            // L'utente è un amministratore
            echo '
            <h1> Non sei autorizzato ad accedere a questa pagina </h1>
            <a href="admin-page.php">Vai alla tua area privata. </a> 
            ';
          exit();
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
    
  </body>
</html>
