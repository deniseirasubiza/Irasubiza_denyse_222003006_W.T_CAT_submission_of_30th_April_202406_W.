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
    $stmt = $connection->prepare("INSERT INTO event(eventid, eventname, eventdate,eventtime,eventlocation,eventdescription,eventcapacity, ticketprice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
    $stmt->bind_param("ssssssss", $eventid, $eventname, $eventdate, $eventtime,$eventlocation,$eventdescription,$eventcapacity,$ticketprice);
    // Set parameters and execute
    $eventid = $_POST['eventid'];
   $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
     $eventtime = $_POST['eventtime'];
      $eventlocation = $_POST['eventlocation'];
     $eventdescription= $_POST['eventdescription'];
      $eventcapacity = $_POST['eventcapacity'];
    $ticketprice = $_POST['ticketprice'];
   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the event table
$sql = "SELECT * FROM event";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of event</title>
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
    <center><h2>Table of event</h2></center>
    <table border="8">
        <tr>
            <th>eventid</th>
            <th>eventname</th>
            <th>eventdate</th>
            <th>eventtime</th>
            <th>eventlocation</th>
            <th>eventdescription</th>
            <th>eventcapacity</th>
            <th>ticketprice</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any event
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $eventid = $row['eventid']; // Fetch the id
                echo "<tr>
                    <td>" . $row['eventid'] . "</td>
                    <td>" . $row['eventname'] . "</td>
                    <td>" . $row['eventdate'] . "</td>
                    <td>" . $row['eventtime'] . "</td>
                    <td>" . $row['eventlocation'] . "</td>
                    <td>" . $row['eventdescription'] . "</td>
                    <td>" . $row['eventcapacity'] . "</td>
                    <td>" . $row['ticketprice'] . "</td>
                    <td><a style='padding:4px' href='delete_event.php?eventid=$eventid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_event.php?eventid=$eventid'>Update</a></td> 
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
