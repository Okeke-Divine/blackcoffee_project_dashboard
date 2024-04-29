<?php
// Include the authentication validator and database connection
require_once('auth-validator.php');
require_once('conn.php');

$selector = isset($_GET['selector']) ? $_GET['selector'] : 'region';

// Query to get the count of posts by region
$query = "SELECT $selector, COUNT(*) AS post_count FROM data GROUP BY $selector";

// Execute the query
$result = $conn->query($query);

// Check if there are any results
if ($result->num_rows > 0) {
    $data = array();
    // Fetch data rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Send JSON response with the fetched data
    echo json_encode($data);
} else {
    // Send empty JSON response if no data found
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
