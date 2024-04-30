<?php
    // Connection details
    $host = "localhost";
    $user = "irasubiza";
    $pass = "222003006";
    $database = "denise";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>