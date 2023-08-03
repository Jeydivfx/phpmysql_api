<?php

//Anropa databas connection
require_once 'db_connection.php';

// Ta emot data från Javascript koden
$data = json_decode(file_get_contents('php://input'), true);

//Ansluta till databasen
$conn = connectDatabase();

// Kolla om det redan finns data i info_table 
$sql_check = "SELECT * FROM info_table";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // Om det finns, ta bort den
    $sql_delete = "DELETE FROM info_table";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Due to manage duplicates old data has been deleted.<br>";
    } else {
        echo "Error deleting data: <br>" . $conn->error;
    }
} else {
    echo "No data found in the table.<br>";
}


// Sätta in data i info_table 
$stmt = $conn->prepare("INSERT IGNORE INTO info_table (country, age, gender) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $country, $age, $gender);

foreach ($data as $user) {
    $country = $user['country'];
    $age = $user['age'];
    $gender = $user['gender'];

    $stmt->execute();
}


$stmt->close();
$conn->close();

echo "New data inserted successfully inte the database!";
?>
