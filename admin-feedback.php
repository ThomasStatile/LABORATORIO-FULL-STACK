<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Admin Feedback</title>
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

    <form method="POST" action="admin-feedback.php">
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
    
    <?php
    
    require_once('php/config.php');
  
    session_start();
      if (!isset($_SESSION['username'])) {
          // L'utente non è autenticato, reindirizzalo al login
          header("Location: login.php");
          exit();
      }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $corso = $connessione->real_escape_string($_POST['corso']);
  
      $sql = "SELECT concat(u.cognome, u.nome) as Studente, c.corso, f.feedback, f.testo_feedback
      FROM feedback_corsi f
      INNER JOIN utenti u ON u.idUtente = f.id_utente
      INNER JOIN corsi c ON c.idcorso = f.id_corso
      WHERE corso = '$corso';";
  
      $result = $connessione->query($sql);
      if($result){
        if ($result->num_rows > 0) {
          echo '
          <table>
          <thead>
          <tr>
          <th>Corso</th>
          <th>Studente</th>
          <th>Feedback</th>
          <th>Messaggio</th>
          </tr>
          </thead>
          <tbody> 
          ';
          while($row = $result->fetch_array()){
            echo '
            <tr>
            <td>' . $row['corso'] . '</td>
            <td>' . $row['Studente'] . '</td>
            <td>' . $row['feedback'] . '</td>
            <td>' . $row['testo_feedback'] . '</td>
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
    
    ?>










  </body>
</html>
