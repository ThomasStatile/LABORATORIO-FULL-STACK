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
    <title>Registro elettronico</title>
  </head>
  <body>

    <?php
     require_once('php/config.php');

     session_start();

     if (isset($_SESSION['username'])) {
      if ($_SESSION['tipoUtente'] == 1) {
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
          <a href="studente-page.php"> <i class="fas fa-user"></i> </a>
          <a href="logout.php"> <i class="fas fa-sign-out iconlogout"></i> </a> 
          </div>
        </header>
        <div class="home-background"></div>
        ';
      }elseif ($_SESSION['tipoUtente'] == 2) {
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
          <a href="admin-page.php"> <i class="fas fa-user"></i> </a>
          <a href="logout.php"> <i class="fas fa-sign-out"></i> </a> 
          </div>
        </header>
        ';
      }
      }else {
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

        <section class="hero1">
          <a href="registrazione.php">
            <div class="register form">
              <img src="img/registrazione.jpg" alt="" />
              <div class="text">registrazione studente</div>
            </div>
          </a>
          <a href="login.php">
            <div class="stud-login form">
              <img src="img/login-studente.jpg" alt="" />
              <div class="text">login</div>
            </div>
          </a>
        </section>
        ';
      }
   

  ?>
  </body>
</html>
