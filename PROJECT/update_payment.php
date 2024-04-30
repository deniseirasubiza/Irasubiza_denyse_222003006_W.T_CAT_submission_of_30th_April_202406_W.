<?php
include('database_connection.php');
// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['paymentid'])) {
    $paymentid = $_REQUEST['paymentid'];
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE paymentid=?");
    $stmt->bind_param("i", $paymentid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['paymentid'];
        $y = $row['paymentdateandtime'];
        $z = $row['paymentamount'];
        $w = $row['paymentmethod'];
        $h = $row['transactionstatus'];
      
    } else {
        echo "payment not found.";
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
    <form method="POST" onsubmit="return confirmUpdate();"ssss>
        <label for="paymentdateandtime">paymentdateandtime:</label>
        <input type="date" name="paymentdateandtime" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="paymentamount">paymentamount:</label>
        <input type="number" name="paymentamount" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="paymentmethod">paymentmethod:</label>
        <input type="text" name="paymentmethod" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

    
         <label for="transactionstatus">transactionstatus:</label>
        <input type="text" name="transactionstatus" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>


        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $paymentdateandtime = $_POST['paymentdateandtime'];
    $paymentamount = $_POST['paymentamount'];
    $paymentmethod = $_POST['paymentmethod'];
    $transactionstatus = $_POST['transactionstatus'];
    
     
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE payment SET paymentdateandtime=? ,paymentamount=? ,paymentmethod=? ,transactionstatus=? WHERE paymentid=?");
    $stmt->bind_param("sssss", $paymentdateandtime, $paymentamount, $paymentmethod,$transactionstatus, $paymentid);
    $stmt->execute();


    // Redirect to booking.php
    header('Location:payment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
