<?php

$servername = "laboratorio-full-stack-db-1";
$user = "root";
$port = "3306";
$password = "root";
$database = "fullstack_laboratorio";

$connessione = new mysqli($servername, $user, $password, $database, $port);

if($connessione === false){
    die("Errore durante la connessione: " . $connessione->connect_error);
}

?>