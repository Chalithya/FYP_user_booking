<?php

$db = mysqli_connect("localhost","root","","2021eticket");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>