<?php

set_time_limit(500);
// Include the PHP file containing the database connection
require_once("conn.php");

// Path to your CSV file
$csvFile = "data/Data.csv";

// Open the CSV file for reading
$file = fopen($csvFile, "r");

// Initialize a variable to count the number of lines
$nOfLines = 0;

// Count the number of lines in the file
while (!feof($file)) {
    // Read each line
    $line = fgets($file);
    
    // Increment the line count if the line is not empty
    if (!empty($line)) {
        $nOfLines++;
    }
}

// Reset file pointer to start reading from the beginning
rewind($file);

// Skip the title line
fgets($file); // Skip first line

// Initialize a variable to count successful insertions
$insertedLines = 0;

// Read and insert each line of data (excluding title and empty lines)
for ($i = 0; $i < $nOfLines; $i++) {
    // Read the data line
    $data = fgetcsv($file, 1000, ",");

    // Check if the line is empty
    if ($data === false || count($data) === 1) {
        continue; // Skip empty line
    }

    // Prepare SQL statement
    $sql = "INSERT INTO data (end_year, citylng, citylat, intensity, sector, topic, insight, swot, url, region, start_year, impact, added, published, city, country, relevance, pestle, source, title, likelihood) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddddssssssddssssssdds",
        $data[0], $data[1], $data[2], $data[3], $data[4],
        $data[5], $data[6], $data[7], $data[8], $data[9],
        $data[10], $data[11], $data[12], $data[13], $data[14],
        $data[15], $data[16], $data[17], $data[18], $data[19],
        $data[20]);

    // Execute the statement
    $stmt->execute();

    // Check if insertion was successful
    if ($stmt->affected_rows > 0) {
        $insertedLines++;
    }
}

// Close the file and connection
fclose($file);
$conn->close();

echo "Inserted " . $insertedLines . " lines successfully.";
?>
