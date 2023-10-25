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
    <title>Admin voti</title>
  </head>
  <body>

  <?php
    
    require_once('php/config.php');

      if (isset($_SESSION['username'])) {
        if ($_SESSION['tipoUtente'] == 2) {
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
                  <a href="admin-page.php"> <i class="fas fa-user"></i> </a>
                  <a href="logout.php"> <i class="fas fa-sign-out iconlogout"></i> </a> 
                  </div>
                </header>
                <div class="go-back"><a href="admin-page.php"> <button class="btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i>Go Back </button> </a></div>

                <form method="POST" action="admin-voti.php">
                  <div class="dropdown-container">
                    <label for="corso">Scegli il corso:</label>
                    <select id="corso" name="corso">
                      <option value="Sviluppo Frontend">Sviluppo Frontend</option>
                      <option value="Sviluppo Backend">Sviluppo Backend</option>
                      <option value="UX/UI Design">UX/UI Design</option>
                      <option value="Database">Database</option>
                      <option value="Inglese">Inglese</option>
                      <option value="DevOps">DevOps</option>
                      <option value="Big Data">Big Data</option>
                    </select>
                    <button type="submit">Visualizza</button>
                  </div>
                </form>
          ';
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $corso = $connessione->real_escape_string($_POST['corso']);

            $sql = "SELECT CONCAT(u.nome, u.cognome) AS Studente, vc.voto
            FROM utenti u
            INNER JOIN voti_corsi vc ON vc.id_utente = u.idUtente
            INNER JOIN corsi c ON c.idcorso = vc.id_corso
            WHERE corso = '$corso'
            GROUP BY Studente, vc.voto;";

            $result = $connessione->query($sql);
            if($result){
              if ($result->num_rows > 0) {
                echo '
                
                <table>
                <thead>
                <tr>
                <th>Studente</th>
                <th>Voto</th>
                </tr>
                </thead>
                <tbody> 
                ';
                while($row = $result->fetch_array()){
                  echo '
                  <tr>
                  <td>' . $row['Studente'] . '</td>
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
        }elseif ($_SESSION['tipoUtente'] == 1) {
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
          <a href="studente-page.php"><button class="message-btn">Vai alla tua area privata.</button> </a>  </div>     
          ';
        exit();
        }
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
