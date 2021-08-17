<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "2021eticket");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$user_id = mysqli_real_escape_string($link, $_REQUEST['user_id']);
$station_name = mysqli_real_escape_string($link, $_REQUEST['station_name']);
$platform_id = mysqli_real_escape_string($link, $_REQUEST['platform_id']);
$schedule_id = mysqli_real_escape_string($link, $_REQUEST['schedule_id']);
$start = mysqli_real_escape_string($link, $_REQUEST['start']);
$start = substr($start, strpos($start, ":") + 1);
$end = mysqli_real_escape_string($link, $_REQUEST['end']);
$end = substr($end, strpos($end, ":") + 1);
$train_name = mysqli_real_escape_string($link, $_REQUEST['train_name']);
$platform_id = mysqli_real_escape_string($link, $_REQUEST['platform_id']);
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$time = mysqli_real_escape_string($link, $_REQUEST['time']);




$price = mysqli_real_escape_string($link, $_REQUEST['price']);

// Attempt insert query execution
$sql = "INSERT INTO bookings ( schedule_id, user_id ,booking_start, booking_end, price, train_name, platform_id, date, time ) VALUES ('$schedule_id', '$user_id', '$start', '$end', '$price', '$train_name', '$platform_id', '$date', '$time')";
if(mysqli_query($link, $sql)){
    echo '<script>alert("Records added successfully.")</script>';
    header("Location: all_records.php");
    exit();
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
