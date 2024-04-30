<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO booking(id, bookingdateandtime, numberofticket, totalprice) VALUES (?, ?, ?, ?)"); 
    $stmt->bind_param("ssss", $id, $bookingdateandtime, $numberofticket, $totalprice);
    // Set parameters and execute
    $id = $_POST['id'];
    $bookingdateandtime = $_POST['bookingdateandtime'];
    $numberofticket = $_POST['numberofticket'];
    $totalprice = $_POST['totalprice'];
   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the booking table
$sql = "SELECT * FROM booking";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of booking</title>
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
    <center><h2>Table of booking</h2></center>
    <table border="5">
        <tr>
            <th>id</th>
            <th>bookingdateandtime</th>
            <th>numberofticket</th>
            <th>totalprice</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any bookings
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $id = $row['id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['bookingdateandtime'] . "</td>
                    <td>" . $row['numberofticket'] . "</td>
                    <td>" . $row['totalprice'] . "</td>
                    <td><a style='padding:4px' href='delete_booking.php?id=$id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_booking.php?id=$id'>Update</a></td> 
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
