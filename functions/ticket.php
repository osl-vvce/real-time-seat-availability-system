<?php

include ('../database/db.php');

$busID = $_GET['bus'];
$startID = $_GET['start'];
$routeID = $_GET['route'];
$traveller = $_GET['traveller'];
/* $startID = 1;
$routeID = 3;
$traveller = 55; */

$sql = "SELECT * from bus where busid = '$busID'";
$result = $con->query($sql);
if (!$result) {
    trigger_error('Invalid query: '.$con->error);
}
while($row =$result->fetch_assoc()) {
    $maxsit = $row['sittingcap'];
    $maxstand = $row['standingcap'];
    echo $maxsit." ";
    echo $maxstand." ";
}

$sql2 = "SELECT * from routes where busid = '$busID' AND routeid = '$startID'";
$result2 = $con->query($sql2);

while($row =$result2->fetch_assoc()) {
    $cursit = $row['sitting'];
    $curstand = $row['standing'];
    echo $cursit." ";
    echo $curstand." ";
}

$counter  = $routeID - 1;

while ($counter >= $startID) {
    if($cursit < $maxsit) {
        if(($cursit + $traveller) <= $maxsit) {
            $update = "UPDATE routes SET sitting = sitting + '$traveller' where busid = '$busID' AND routeid = '$counter'";
            if ($con->query($update) === TRUE) {
                echo "Seats updated successfully";
                /*header("Location: ");*/
            }
        } else {
            $standstate = ($cursit + $traveller) - $maxsit;
            $sitstate = $traveller - $standstate;
            $update = "UPDATE routes SET sitting = sitting + '$sitstate', standing = standing + '$standstate' where busid = '$busID' AND routeid = '$counter'";
            if ($con->query($update) === TRUE) {
                echo "sitting Standing updated successfully";
                /*header("Location: ");*/
            }
        }       
    } else {
        $standstate = ($cursit + $traveller) - $maxsit;
        $sitstate = $traveller - $standstate;
        $update = "UPDATE routes SET sitting = sitting + '$sitstate', standing = standing + '$standstate' where busid = '$busID' AND routeid = '$counter'";
        if ($con->query($update) === TRUE) {
            echo "Standing updated successfully";
            /*header("Location: ");*/
        }       
    }
    $counter--;
}
$calid = $startID+1;
echo $calid;
$sql2 = "SELECT * from routes where busid = '$busID' AND routeid = '$calid'";
$result2 = $con->query($sql2);

while($row =$result2->fetch_assoc()) {
    $calsit = $row['sitting'];
    $calstand = $row['standing'];
    $calroute = $row['routeid'];
    if($calsit < $maxsit) {
        $test1 = $maxsit-$calsit;
        if($calstand <= $test1 || $calstand != 0) {
            $newsit = $calsit+$calstand;
            $update = "UPDATE routes SET sitting = '$newsit', standing = 0 where busid = '$busID' AND routeid = '$calroute'";
            if ($con->query($update) === TRUE) {
                echo "Standing updated successfully";
            } 
        } else {
            $newstand = $calstand - $test1;
            $newsit = $calsit+$test1;
            $update = "UPDATE routes SET sitting = '$newsit', standing = '$newstand' where busid = '$busID' AND routeid = '$calroute'";
            if ($con->query($update) === TRUE) {
                echo "Standing updated successfully";
            } 
        }
    }
    
    header("Location:../index.php?busno=$busID");
}



?>