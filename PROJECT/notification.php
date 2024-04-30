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
    $stmt = $connection->prepare("INSERT INTO notification(notificationid, notificationtype, notificationmessage, notificationdateandtime,notificationstatus) VALUES (?, ?, ?, ?,?)"); 
    $stmt->bind_param("sssss", $notificationid, $notificationtype, $notificationmessage, $notificationdateandtime,$notificationstatus);
    // Set parameters and execute
$notificationid = $_POST['notificationid'];
   $notificationtype = $_POST['notificationtype'];
   $notificationmessage = $_POST['notificationmessage'];
   $notificationdateandtime = $_POST['notificationdateandtime'];
    $notificationstatus = $_POST['notificationstatus'];

   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the notification table
$sql = "SELECT * FROM notification";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of notification</title>
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
    <center><h2>Table of notification</h2></center>
    <table border="5">
        <tr>
            <th>notificationid</th>
            <th>notificationtype</th>
            <th>notificationmessage</th>
            <th>notificationdateandtime</th>
            <th>notificationstatus</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any bookings
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $notificationid = $row['notificationid']; // Fetch the id
                echo "<tr>
                    <td>" . $row['notificationid'] . "</td>
                    <td>" . $row['notificationtype'] . "</td>
                    <td>" . $row['notificationmessage'] . "</td>
                    <td>" . $row['notificationdateandtime'] . "</td>
                    <td>" . $row['notificationstatus'] . "</td>
                    <td><a style='padding:4px' href='delete_notification.php?notificationid=$notificationid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_notification.php?notificationid=$notificationid'>Update</a></td> 
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
