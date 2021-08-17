<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db, "select * from train_schedules where schedule_id='$id'"); // select query

//Select from  stations--------------------------------------------------------------------------------------------------
//Start Menu
$startQry = mysqli_query($db, "SELECT * FROM stations");

//End Menu

$endQry = mysqli_query($db, "SELECT * FROM stations");




//---------------------------------------------------------------------------------------------------------------------------

$data = mysqli_fetch_array($qry); // fetch data

if (isset($_POST['update'])) // when click on Update button
{
    $station_name = $_POST['station_name'];
    $age = $_POST['age'];

    $edit = mysqli_query($db, "update tblemp set station_name='$station_name', age='$age' where id='$id'");

    if ($edit) {
        mysqli_close($db); // Close connection
        // header("location:all_records.php"); // redirects to all records page
        exit;
    } else {
        echo mysqli_error(mysqli);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<html>

<head>
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


    <script type='text/javascript'>
        /*$('#dealer').change(function () {
     $("#emp_number").val($(this).val());*/
        function updateMyText() {
            var start = document.getElementById('start');
            var end = document.getElementById('end');
            var price = Math.abs(start.value - end.value);
            // alert(price);
            document.getElementById("price").value = price * 2;

        }
    </script>
</head>

<body>

    <h3 align="center">Booking</h3>

    <form method="POST" align="center" action="booking_insert.php">

    <div class="control-group">
            <label class="control-label">User Id</label>
            <div class="controls">
            <input type="text" name="user_id" id="user_id" value="" placeholder="Enter User Id" Required > 
            </div>
    </div>


    <div class="control-group">
            <label class="control-label">Train Name</label>
            <div class="controls">
            <input type="text" name="station_name" value="<?php echo $data['train_name'] ?>"  Required readonly> 
            </div>
    </div>

    <div class="control-group">
            <label class="control-label">Platform Number</label>
            <div class="controls">
            <input type="text" name="platform_id" value="<?php echo $data['platform_id'] ?>"  Required readonly> 
            </div>
    </div>

    <div class="control-group">
            <label class="control-label">Schedule Id</label>
            <div class="controls">
            <input type="text" name="schedule_id" value="<?php echo $data['schedule_id'] ?>"  Required readonly> 
            </div>
    </div>
        



        <div class="control-group">
            <label class="control-label">Start</label>
            <div class="controls">
                <select id="start" name="start" onchange="updateMyText()">
                    <?php
                    while ($rows = mysqli_fetch_array($startQry)) {
                    ?>
                        <option value="<?php echo $rows['points']; ?>"><?php echo $rows['station_name']; ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>



        <div class="control-group">
            <label class="control-label">End</label>
            <div class="controls">
                <select id="end" name="end" onchange="updateMyText()">
                    <?php
                    while ($rows = mysqli_fetch_array($endQry)) {
                    ?>
                        <option value="<?php echo $rows['points']; ?>"><?php echo $rows['station_name']; ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Price (Rs.)</label>
            <div class="controls">
                <input type="text" name="price" class="price" id="price" readonly>
            </div>
        </div>



        <button class="btn btn-success" type="submit" name="book" value="book"> Book </button>
    </form>

</body>

</html>