<?php

// Include the PHP file containing the authentication validator and database connection
require_once("auth-validator.php");
require_once("conn.php");

// Default sorting and ordering parameters
$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'id';
$order = isset($_GET['order']) && ($_GET['order'] == 'desc') ? 'DESC' : 'ASC';
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
$limit = (int)$limit;

// Query to fetch data from the database, filtering out NULL values for the sorting column
$query = "SELECT * FROM data WHERE $sortBy IS NOT NULL ORDER BY $sortBy $order LIMIT $limit";

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
