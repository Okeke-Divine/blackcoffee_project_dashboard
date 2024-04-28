<?php require('auth-validator.php'); ?>
<?php
// Include the PHP file containing the database connection
require_once("conn.php");

// Set content type to JSON
header("Content-Type: application/json");

// Query to retrieve the first 10 entries from the database
$query = "SELECT * FROM data LIMIT 10";

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Initialize an array to store the results
    $data = array();

    // Fetch associative array of the result rows
    while ($row = $result->fetch_assoc()) {
        // Add each row to the data array
        $data[] = $row;
    }

    // Free the result set
    $result->free();

    // Convert the data array to JSON format
    $json = json_encode($data);

    // Output the JSON response
    echo $json;
} else {
    // If the query fails, return an error message
    echo json_encode(array("error" => "Failed to fetch data from the database."));
}

// Close the database connection
$conn->close();
?>
