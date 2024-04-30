<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO report(reportid, reporttype, reportgenerationdateandtime, reportcontent) VALUES (?, ?, ?, ?)"); 
    $stmt->bind_param("ssss",  $reportid, $reporttype, $reportgenerationdateandtime,  $reportcontent);
    // Set parameters and execute
   $reportid = $_POST['reportid'];
   $reporttype=$_POST['reporttype'];
   $reportgenerationdateandtime = $_POST['reportgenerationdateandtime'];
    $reportcontent = $_POST['reportcontent'];
   

    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the payment table
$sql = "SELECT * FROM report";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of report</h2></center>
    <table border="5">
        <tr>
            <th>reportid</th>
            <th>reporttype</th>
            <th>reportgenerationdateandtime</th>
            <th>reportcontent</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $reportid = $row['reportid']; // Fetch the id
                echo "<tr>
                    <td>" . $row['reportid'] . "</td>
                    <td>" . $row['reporttype'] . "</td>
                    <td>" . $row['reportgenerationdateandtime'] . "</td>
                    <td>" . $row['reportcontent'] . "</td>
                    <td><a style='padding:4px' href='delete_report.php?reportid=$reportid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_report.php?reportid=$reportid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>

    <footer>
        <center> 
            <b><h2>UR CBE BIT &copy, 2024 &reg;, Designer by: @Irasubiza denyse</h2></b>
        </center>
    </footer>
</body>
</html>
