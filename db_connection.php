<?php

function connectDatabase()
{
    $servername = "mysql95.unoeuro.com";
    $username = "jeydivfx_se";
    $password = ""; 	//Jag döljer lösenordet för säkerhetsskäl
    $dbname = "jeydivfx_se_db";

    // Skapa connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kolla om det går att ansluta till databasen
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>