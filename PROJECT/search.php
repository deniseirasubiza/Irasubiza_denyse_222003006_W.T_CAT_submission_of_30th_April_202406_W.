<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    include('database_connection.php');

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'booking' => "SELECT numberofticket FROM booking WHERE numberofticket LIKE '%$searchTerm%'",
        'event' => "SELECT eventname FROM event WHERE eventname LIKE '%$searchTerm%'",
        'payment' => "SELECT transactionstatus FROM payment WHERE transactionstatus LIKE '%$searchTerm%'",
        'notification' => "SELECT notificationtype FROM notification WHERE notificationtype LIKE '%$searchTerm%'",
        'report' => "SELECT reporttype FROM report WHERE reporttype LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
