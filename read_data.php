<?php

//Anropa databas connection
require_once 'db_connection.php';

//Ansluta till databasen
$conn = connectDatabase();

// Läsa data från info_table
$sql = "SELECT country, gender FROM info_table";
$result = $conn->query($sql);

// Initiera en array för att lagra counts
$counts = array();

//Loopa igenom resultatet och räkna antalet men och kvinnor per land
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $country = $row["country"];
        $gender = $row["gender"];

        if (!isset($counts[$country])) {
            $counts[$country] = array("male" => 0, "female" => 0);
        }

        if ($gender === "male") {
            $counts[$country]["male"]++;
        } elseif ($gender === "female") {
            $counts[$country]["female"]++;
        }
    }
}


$conn->close();

// Omvandla php array till JSON
echo json_encode($counts);
?>
