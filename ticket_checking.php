<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);


//Database connection
$con = mysqli_connect('localhost', 'root', '', '2021eticket');
$sql = "SELECT * FROM users WHERE rfid_id IS NULL OR rfid_id=''";
$res = mysqli_query($con, $sql);


//Adding RFID Update part
if (isset($_POST['add_rfid'])) {


    $rfid_id_val = $_POST['rfid_id_val'];
    $id = $_POST['username'];
    $query = "UPDATE users SET rfid_id='$rfid_id_val' WHERE id= $id ";
    $result = mysqli_query($con, $query);

    if ($result) {

        echo    "<script type='text/javascript'>
                    alert('Data entered');

                </script>";
    } else {
        echo 'Erro occured' . mysqli_error($con);
        echo "<script type='text/javascript'>alert('Error occured');</script>";
    }
    mysqli_close($con);
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" href="css/main.css"> -->
    <link rel="stylesheet" href="rfid_styles.css">

    <script>
        $(document).ready(function() {
            $("#getUID").load("../RFID/UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("../RFID/UIDContainer.php");
            }, 500);
        });


        function close_window() {
            if (confirm("Close Window?")) {
                close();
            }
        }



        // ----------------- Searching the data -------------------------

        $(document).ready(function() {
            $('.search-box textarea[type="text"]').on("keyup textarea", function() {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("ticket_checking_query.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('textarea[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });



    </script>



    <title>Ticket Cheker</title>
</head>

<body>
    <h2 align="center">Ticket Cheker</h2>


    <div class="container">
        <br>
        <div class="center" style="">
            <div class="row">
                <h3 align="center">Your Ticket Details</h3>
            </div>
            <br>
            <form class="form-horizontal" action="addRFID.php" method="POST" align="center">
                <div class="control-group">
                    <label class="control-label">ID</label>
                    <div class="controls">
                        <textarea name="rfid_id_val" id="getUID" placeholder="Please Scan Your RFID" rows="1" cols="1" required readonly></textarea>

                    </div>
                </div>


        <!-- seacrching part -->
                <div class="search-box">
                    <textarea type="text" name="rfid_id_val" id="getUID" autocomplete="off" placeholder="Search country..." ></textarea>
                    <div class="result"></div>
                </div>


                <div class="form-actions">
                    <button name="add_rfid" type="submit" class="btn btn-success">Add RFID</button>
                </div>


            </form>

        </div>
    </div>

</body>

</html>
