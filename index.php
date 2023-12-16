<?php
// Define variables for database connection
$servername = getenv('DB_SERVER') ?: "tlportal.mariadb.database.azure.com";
$username = getenv('DB_USERNAME') ?: "portadmin@tlportal";
$password = getenv('DB_PASSWORD') ?: "RmPRevfFAJyS!3:";
$dbname = getenv('DB_NAME') ?: "thatsliving";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Initialize an empty results array
$results = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input
    $sku = $_POST['sku'];
    $sku = htmlspecialchars($sku);

    try {
        // Prepare a SQL query to search for the SKU in the 'items' table
        $stmt = $conn->prepare("SELECT * FROM items WHERE series LIKE ?");
        $searchTerm = "%$sku%";
        $stmt->execute([$searchTerm]);

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Item</title>
</head>
<body>
    <form method="post">
        <label for="sku">Enter SKU:</label>
        <input type="text" id="sku" name="sku">
        <input type="submit" value="Search">
    </form>

    <?php if (!empty($results)): ?>
        <h2>Search Results:</h2>
        <?php foreach ($results as $row): ?>
            <p>Item: <?php echo $row['item_name']; // Replace 'item_name' with your actual column name ?></p>
        <?php endforeach; ?>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No items found.</p>
    <?php endif; ?>
</body>
</html>



