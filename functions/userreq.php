<?php

include ('../database/db.php');

$busID = $_GET['busno'];
$start = $_GET['source'];

$sql = "SELECT * from routes where busid = '$busID' AND routeid = '$start'";
$result = $con->query($sql);
if (!$result) {
    trigger_error('Invalid query: '.$con->error);
}
while($row =$result->fetch_assoc()) {
    $availsit = $row['sitting'];
    $availstand = $row['standing'];
    echo $availsit;
    echo $availstand;
}

header("Location:../user.php?sit=$availsit&stand=$availstand&bus=$busID&start=$start");

?>