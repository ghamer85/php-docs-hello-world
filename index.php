<?php
$servername = "tlportal.mariadb.database.azure.com";
$username = "portadmin@tlportal";
$password = "RmPRevfFAJyS!3:";
$dbname = "thatsliving";

// User input for series search
$userInputSeries = "CLA-017-061"; // Replace this with the actual user input

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Prepare and bind
$stmt = $conn->prepare("SELECT name FROM items WHERE series = ?");
$stmt->bind_param("s", $userInputSeries);

// Execute the query
$stmt->execute();

// Bind result variables
$stmt->bind_result($name);

// Fetch values
while ($stmt->fetch()) {
    echo "Name: " . $name . "<br>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

