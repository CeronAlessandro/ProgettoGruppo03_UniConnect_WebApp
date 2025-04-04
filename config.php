<?php
    $HOST = "127.0.0.1";
    $DB_USER = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "db_uniconnect";
    $DB_PORT = 3306;

    $conn = new mysqli($HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

    if($conn->error){
        echo "Error: " . $conn->error;
    }
?>