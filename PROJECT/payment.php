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
    $stmt = $connection->prepare("INSERT INTO payment(paymentid, paymentdateandtime, paymentamount, paymentmethod,transactionstatus) VALUES (?, ?, ?, ?,?)"); 
    $stmt->bind_param("sssss", $paymentid, $paymentdateandtime, $paymentamount, $paymentmethod,$transactionstatus);
    // Set parameters and execute
   $paymentid = $_POST['paymentid'];
   $paymentdateandtime = $_POST['paymentdateandtime'];
   $paymentamount = $_POST['paymentamount'];
    $paymentmethod = $_POST['paymentmethod'];
    $transactionstatus = $_POST['transactionstatus'];

   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the payment table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
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
    <center><h2>Table of payment</h2></center>
    <table border="5">
        <tr>
            <th>paymentid</th>
            <th>paymentdateadntime</th>
            <th>paymentamount</th>
            <th>paymentmethod</th>
            <th>transactionstatus</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $paymentid = $row['paymentid']; // Fetch the id
                echo "<tr>
                    <td>" . $row['paymentid'] . "</td>
                    <td>" . $row['paymentdateandtime'] . "</td>
                    <td>" . $row['paymentamount'] . "</td>
                    <td>" . $row['paymentmethod'] . "</td>
                    <td>" . $row['transactionstatus'] . "</td>
                    <td><a style='padding:4px' href='delete_payment.php?paymentid=$paymentid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payment.php?paymentid=$paymentid'>Update</a></td> 
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
