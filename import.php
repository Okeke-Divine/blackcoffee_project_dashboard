<?php
// Set maximum execution time to 500 seconds
set_time_limit(500);

// Include the PHP file containing the database connection
require_once("conn.php");

// Path to your CSV file
$csvFile = "data/Data.csv";

// Open the CSV file for reading
$file = fopen($csvFile, "r");

// Skip the title line
fgets($file); // Skip first line

// Define the number of lines to insert
$numberOfLines = 1000;

// Initialize a counter for inserted lines
$insertedLines = 0;

// Read and insert each line of data
while (($data = fgetcsv($file, 1000, ",")) !== false && $insertedLines < $numberOfLines) {
    // Check if the data line is valid
    if (count($data) > 1) {
        // Replace empty values with NULL or an empty string
        foreach ($data as &$value) {
            if (empty($value)) {
                $value = null; // or $value = ''; for string columns
            }
        }

        // Assign default value for citylng if it's empty
        if ($data[1] === null) {
            $data[1] = 0.0; // Or any other default value
        }

        // Prepare SQL statement
        $sql = "INSERT INTO data (end_year, citylng, citylat, intensity, sector, topic, insight, swot, url, region, start_year, impact, added, published, city, country, relevance, pestle, source, title, likelihood) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddddssssssddsssssssss",
            $data[0], $data[1], $data[2], $data[3], $data[4],
            $data[5], $data[6], $data[7], $data[8], $data[9],
            $data[10], $data[11], $data[12], $data[13], $data[14],
            $data[15], $data[16], $data[17], $data[18], $data[19],
            $data[20]);

            // echo $data[19]."<br />";
        // Execute the statement
        $stmt->execute();

        // Check if insertion was successful
        if ($stmt->affected_rows > 0) {
            $insertedLines++;
        }
    } else {
        // Handle invalid or empty data line
        // Optional: Log or display an error message
    }
}

// Close the file and connection
fclose($file);
$conn->close();

// Output the number of lines inserted
echo "Inserted " . $insertedLines . " lines successfully.";
?>
