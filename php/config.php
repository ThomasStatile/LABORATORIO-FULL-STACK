<?php

$servername = "localhost";
$user = "root";
$port = "3307";
$password = "password";
$database = "fullstack_laboratorio";

$connessione = new mysqli($servername, $user, $password, $database, $port);

if($connessione === false){
    die("Errore durante la connessione: " . $connessione->connect_error);
}

?>