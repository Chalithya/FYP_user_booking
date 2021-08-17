<!DOCTYPE html>
<html>
<head>
  <title>Train Schedules</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" href="css/main.css"> -->
    <link rel="stylesheet" href="rfid_styles.css">

</head>
<body>

<h2>Train Schedules </h2>

<table border="1" s >
  <tr>
    <td>Schedule ID</td>
    <td>Train Name</td>
    <td>Platform ID</td>
    <td>Train Start</td>
    <td>Train Haults</td>
    <td>Train End</td>
    <td>Date</td>
    <td>Time</td>
    <td>Book</td>
    <td>Delete</td>
  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from train_schedules"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['schedule_id']; ?></td>
    <td><?php echo $data['train_name']; ?></td>
    <td><?php echo $data['platform_id']; ?></td>    
    <td><?php echo $data['train_start']; ?></td>    
    <td><?php echo $data['train_haults']; ?></td>    
    <td><?php echo $data['train_end']; ?></td>    
    <td><?php echo $data['date']; ?></td>    
    <td><?php echo $data['time']; ?></td>    
    <td><a href="booking.php?id=<?php echo $data['schedule_id']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['schedule_id']; ?>">Delete</a></td>
  </tr>	
<?php
}
?>
</table>

</body>
</html>