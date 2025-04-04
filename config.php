<?php
//credenziali del database
$HOST="localhost";
$DB_NAME="db_uniconnect";
$DB_USER="root";
$DB_PASSWORD="";
$DB_PORT=3306;

//connessione al database 
$conn=new mysqli($HOST,$DB_USER,$DB_PASSWORD,$DB_NAME,$DB_PORT);

if($conn->error){
    echo "Error: ". $conn->error;
}
?>