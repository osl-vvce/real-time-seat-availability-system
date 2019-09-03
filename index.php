<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Easy-Transit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/user.css">
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>
body {
    background: #333333;
    background: -webkit-linear-gradient(to right, #dd1818, #333333); 
    background: linear-gradient(to right, #dd1818, #333333); 
}
.label {
    font-size: 50px;
}
.container {
    margin-top: 20px;
    width:100%;
    height: auto;
}
.centerd {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

@font-face {
  font-family: 'Dosis';
  font-style: normal;
  font-weight: 700;
  src: local('Dosis Bold'), local('Dosis-Bold'), url(https://fonts.gstatic.com/s/dosis/v8/HhyXU5sn9vOmLzHTLuCFMI4.ttf) format('truetype');
}

.value .value2 .value3{
  /* border-bottom: 4px dashed #bdc3c7; */
  text-align: center;
  font-weight: bold;
  font-size: 30px;
  width: 300px;
  height: 100px;
  line-height: 60px;
  margin: 40px auto;
  letter-spacing: -0.07em;
  text-shadow: white 2px 2px 2px;
}
input[type="range"] {
  display: block;
  -webkit-appearance: none;
  background-color: #bdc3c7;
  width: 300px;
  height: 5px;
  border-radius: 5px;
  margin: 0 auto;
  outline: 0;
}
input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  background-color: #e74c3c;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  border: 2px solid white;
  cursor: pointer;
  transition: 0.3s ease-in-out;
}
​ input[type="range"]::-webkit-slider-thumb:hover {
  background-color: white;
  border: 2px solid #e74c3c;
}
input[type="range"]::-webkit-slider-thumb:active {
  transform: scale(1.6);
}


</style>

<body>
    
    <?php
        include ('database/db.php');
        if(!$_GET) {
            echo "
            <div class='container'>
            <div class='cardcontain' style='height: 200px;'>
                    <div class='card'>
                        <div class='front'><h4>Welcome to Easy-Transit</br><hr>Enter your Bus Credentials to Login</h4></div>
                        <div class='back'>
                            <form action='functions/login.php'>   
                                Enter Bus Number:</br>
                                <input name='busno' type='number'></br>
                                Enter your password:</br>
                                <input name='password' typ  e='password' ></br>
                                <input name='submit' type='submit'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ";
        } else {
            $busid = $_GET['busno'];
            $sql = "SELECT * from routes where busid = '$busid'";
            $result = $con->query($sql);
            $total = -1;
            $total2 = 0;
            while($row =$result->fetch_assoc()) {
                $total++;
                $total2++;
            }
            
            echo "
            <div class='container'>
                <div class='busname'>
                    <img src='https://www.w3schools.com/howto/img_avatar.png' alt='Avatar' class='avatar'></br>  
                    <div class='centered'><span class='label'>".$busid."</span></div>
                </div>
                <div class='cardcontain' style='height: 300px;'>
                    <div class='card'>
                        <div class='front'><h4>Ticket Issuing System</br><hr>Click here to Issue Ticket</h4></div>
                        <div class='back'>
                            <form action='functions/ticket.php'> 
                                <input type='hidden' id='bus' name='bus' value=".$busid.">
                                Start Point: <span class='value'>1</span>
                                <input name='start' class='range1' type='range' min='1' max='".$total."' step='1' value='1'></br></br>
                                Destinations: <span class='value1'>2</span>
                                <input name='route' class='range2' type='range' min='2' max='".$total2."' step='1' value='1'></br></br>
                                Passengers: <span class='value2'>1</span>
                                <input name='traveller' class='range3' type='range' min='1' max='10' step='1' value='1'>
                                <input name='submit' type='submit' style='margin-top: 30px;'>
                            </form>
                        </div>
                    </div>
                </div>                
            
            ";
            echo "<div class='btn'>";
            $sql = "SELECT * from routes where busid = '$busid'";
            $result = $con->query($sql);
            while($row =$result->fetch_assoc()) {
                $rt = $row['routname'];
                $rtid = $row['routeid'];
                echo "<button id=".$rtid." onClick='status(this.id)'>".$rt."</button>";
            }
            echo "</div>";
        }
    ?>
    </div>
    <script src="js/user.js"></script>
    <script src="js/index.js"></script>
    <script type="text/javascript">
        function status(clicked_id) {
                window.location.href = ("functions/status.php?status="+clicked_id+"&busno="+<?php echo $busid; ?>);		
        }	
    </script>
</body>
</html>