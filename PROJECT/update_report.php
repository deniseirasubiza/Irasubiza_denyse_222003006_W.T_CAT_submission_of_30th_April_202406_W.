<?php
include('database_connection.php');
// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['reportid'])) {
    $reportid = $_REQUEST['reportid'];
    
    $stmt = $connection->prepare("SELECT * FROM report WHERE reportid=?");
    $stmt->bind_param("i", $reportid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['reportid'];
        $y = $row['reporttype'];
        $z = $row['reportgenerationdateandtime'];
        $w = $row['reportcontent'];
    } else {
        echo "report not found.";
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
        <label for="reporttype">reporttype:</label>
        <input type="text" name="reporttype" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="reportgenerationdateandtime">reportgenerationdateandtime:</label>
        <input type="date" name="reportgenerationdateandtime" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="reportcontent">reportcontent:</label>
        <input type="text" name="reportcontent" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $reporttype = $_POST['reporttype'];
    $reportgenerationdateandtime = $_POST['reportgenerationdateandtime'];
    $reportcontent = $_POST['reportcontent'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE report SET reporttype=? ,reportgenerationdateandtime=?,reportcontent=? WHERE reportid=?");
    $stmt->bind_param("ssss", $reporttype, $reportgenerationdateandtime, $reportcontent, $reportid);
    $stmt->execute();
    
    // Redirect to booking.php
    header('Location: report.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
