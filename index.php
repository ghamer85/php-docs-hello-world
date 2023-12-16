<?php
// Use environment variables or a configuration file to store credentials
$servername = getenv('DB_SERVER') ?: "tlportal.mariadb.database.azure.com";
$username = getenv('DB_USERNAME') ?: "portadmin@tlportal";
$password = getenv('DB_PASSWORD') ?: "RmPRevfFAJyS!3:";
$dbname = getenv('DB_NAME') ?: "thatsliving";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch(PDOException $e) {
    // Log error message to a file or a logging system
    error_log("Connection failed: " . $e->getMessage());

    // Display a generic error message to the user
    echo "Connection failed";
}
?>


