<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "2021eticket");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM Bookings WHERE (user_id IN (SELECT id FROM users WHERE rfid_id LIKE ?))";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Set parameters
        $param_term = $_REQUEST["term"] . '%';

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

?>

<div class="control-group">
    <label class="control-label">Ticket Start</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly><?php echo $row['booking_start']; ?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Ticket End</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly><?php echo $row['booking_end']; ?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Train</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly><?php echo $row['train_name']; ?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Platform No</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly><?php echo $row['platform_id']; ?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Date</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly><?php echo $row['date']; ?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Time</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly><?php echo $row['time']; ?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Status</label>
    <div class="controls">
        <textarea rows="1" cols="1" required readonly>Activated</textarea>
    </div>
</div>

<?php
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// close connection
mysqli_close($link);
?>
