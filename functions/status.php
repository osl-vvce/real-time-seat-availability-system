<?php

include ('../database/db.php');

$busID = $_GET['busno'];
$status = $_GET['status'];

$update = "UPDATE bus SET status = '$status' where busid = '$busID'";
            if ($con->query($update) === TRUE) {
                echo "Seats updated successfully";
                header("Location: ../index.php?busno=$busID");
            }
?>