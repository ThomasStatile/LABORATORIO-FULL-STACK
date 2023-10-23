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

    <?php

    require_once('php/config.php');

    session_start();

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
                <table>
                <thead>
                <tr>
                <th>Corso</th>
                <th>Voto</th>
                </tr>
                </thead>
                <tbody> 
                ';
                echo '<div class="go-back"><a class="button" href="studente-page.php"><i class="fa fa-arrow-left" aria-hidden="true">Go Back</i></a></div>';
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
