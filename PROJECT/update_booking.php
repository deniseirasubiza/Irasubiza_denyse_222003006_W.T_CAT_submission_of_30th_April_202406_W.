<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    
    $stmt = $connection->prepare("SELECT * FROM booking WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['bookingdateandtime'];
        $z = $row['numberofticket'];
        $w = $row['totalprice'];
    } else {
        echo "booking not found.";
    }
}
$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update products</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
?>

<html>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="bookingdateandtime">bookingdateandtime:</label>
        <input type="date" name="bookingdateandtime" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="numberofticket">numberofticket:</label>
        <input type="number" name="numberofticket" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="totalprice">totalprice:</label>
        <input type="number" name="totalprice" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $bookingdateandtime = $_POST['bookingdateandtime'];
    $numberofticket = $_POST['numberofticket'];
    $totalprice = $_POST['totalprice'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE booking SET bookingdateandtime=?,numberofticket=?, totalprice=? WHERE id=?");
    $stmt->bind_param("ssss", $bookingdateandtime, $numberofticket, $totalprice, $id);
    $stmt->execute();
    
    // Redirect to booking.php
    header('Location: booking.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
