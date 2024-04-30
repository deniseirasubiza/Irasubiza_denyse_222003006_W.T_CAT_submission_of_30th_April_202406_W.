<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['notificationid'])) {
    $notificationid= $_REQUEST['notificationid'];
    
    $stmt = $connection->prepare("SELECT * FROM notification WHERE notificationid=?");
    $stmt->bind_param("i",$notificationid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['notificationid'];
        $y = $row['notificationtype'];
        $z = $row['notificationmessage'];
        $w = $row['notificationdateandtime'];
        $H = $row['notificationstatus'];
      
    } else {
        echo "notification not found.";
    }
    $stmt->close(); // Close the statement after use
}
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
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="notificationid">notificationid:</label>
        <input type="number" name="notificationid" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="notificationtype">notificationtype:</label>
        <input type="text" name="notificationtype" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="notificationmessage">notificationmessage:</label>
        <input type="text" name="notificationmessage" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="notificationdateandtime">notificationdateandtime:</label>
        <input type="date" name="notificationdateandtime" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

         <label for="notificationstatus">notificationstatus:</label>
        <input type="text" name="notificationstatus" value="<?php echo isset($H) ? $H : ''; ?>">
        <br><br>

         
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $notificationid = $_POST['notificationid'];
    $notificationtype = $_POST['notificationtype'];
    $notificationmessage = $_POST['notificationmessage'];
    $notificationdateandtime = $_POST['notificationdateandtime'];
    $notificationstatus = $_POST['notificationstatus'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE notification SET notificationtype=?, notificationmessage=?, notificationdateandtime=?, notificationstatus=? WHERE notificationid=?");
    $stmt->bind_param("ssssi", $notificationtype, $notificationmessage, $notificationdateandtime, $notificationstatus, $notificationid);
    $stmt->execute();
    
    // Redirect to booking.php
    header('Location: notification.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
