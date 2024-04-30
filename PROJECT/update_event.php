<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['eventid'])) {
    $eventid = $_REQUEST['eventid'];
    
    $stmt = $connection->prepare("SELECT * FROM event WHERE eventid=?");
    $stmt->bind_param("i", $eventid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['eventid'];
        $y = $row['eventname'];
        $z = $row['eventdate'];
        $w = $row['eventtime'];
        $H = $row['eventlocation'];
        $A = $row['eventdescription'];
        $T = $row['eventcapacity'];
        $D = $row['ticketprice'];
    } else {
        echo "event not found.";
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
        <label for="eventname">eventname:</label>
        <input type="text" name="eventname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="eventdate">eventdate:</label>
        <input type="date" name="eventdate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="eventtime">eventtime:</label>
        <input type="number" name="eventtime" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

    s
         <label for="eventtime">eventlocation:</label>
        <input type="text" name="eventlocation" value="<?php echo isset($H) ? $H : ''; ?>">
        <br><br>

         <label for="eventdescription">eventdescription:</label>
        <input type="text" name="eventdescription" value="<?php echo isset($A) ? $A : ''; ?>">
        <br><br>

         <label for="eventcapacity">eventcapacity:</label>
        <input type="text" name="eventcapacity" value="<?php echo isset($T) ? $T : ''; ?>">
        <br><br>

         <label for="ticketprice">ticketprice:</label>
        <input type="number" name="ticketprice" value="<?php echo isset($D) ? $D : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
    $eventtime = $_POST['eventtime'];
    $eventlocation = $_POST['eventlocation'];
    $eventdescription = $_POST['eventdescription'];
    $eventcapacity = $_POST['eventcapacity'];
    $ticketprice = $_POST['ticketprice'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE event SET eventname=?, eventdate=?, eventtime=?,eventlocation=?, eventdescription=?, eventcapacity=?, ticketprice=? WHERE eventid=?");
    $stmt->bind_param("ssssssss",$eventname,$eventdate,$eventtime,$eventlocation,$eventdescription,$eventcapacity,$ticketprice,$eventid );
    $stmt->execute();
    
    // Redirect to booking.php
    header('Location:event.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
