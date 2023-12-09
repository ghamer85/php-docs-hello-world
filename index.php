<?php
//phpinfo();

$servername = "tlportal.mariadb.database.azure.com";
$username = "portadmin@tlportal";
$password = "RmPRevfFAJyS!3:";
$dbname = "thatsliving";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die("dead");


// Check connection
/*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/
echo $conn;
echo "Connected successfully";
/*
try {


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

} catch(Exeption $error) {
    echo $error;
}
?>*/

