<?php

include ('../database/db.php');

$busno = $_GET['busno'];
$password = $_GET['password'];

$busno = stripslashes($busno);
$password = stripslashes($password);
$busno = mysqli_real_escape_string($con,$busno);
$password = mysqli_real_escape_string($con,$password);

$query = mysqli_query($con,"SELECT * FROM bus where buspassword='$password' AND busid='$busno'");
$rows = mysqli_num_rows($query);
if($rows == 1) {
    header("Location:../index.php?busno=$busno");
} else {
    header("Location:../index.php");
}

?>