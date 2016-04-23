<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include'confg.php';
    include'pdo.php'; 
    include 'session3.php';
    $username = $_SESSION['username'];
    $m_id = $_SESSION['m_id'];
   
    if(isset($_POST['rent']))
    {
        car::tune_add(); 
    }
    try{
        $id = $_GET['car_id'];
        $DB_con = Database::connect();
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $DB_con->prepare("SELECT * FROM cars where md5(car_id) = '$id'");
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $msg) {
        die("Connection Failed : " . $msg->getMessage());
    }
?>
<html lang="en">
<head>
	<title> Car Rental System </title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="stylesheet" href="bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'main_header.php'; ?><br>
        <div class="container">
            <center>
                <img class="img-responsive" src="images/tuneup.png">
            </center>
        </div>
        <div class="container">
            <form  method="POST">
                <center>
                    <div class="table-responsive tb2">
                        <table class="table">
                            <tr>
                                <td colspan="2"><b><h4 class="date"><img class="img-responsive" src="images/last.png"><?php echo $row['tuneup'];?></h3></b></td>
                            </tr>
                            <tr>
                                <td>Car Serial:</td>
                                <td><b><input class="form-control" value="<?php echo $row['car_serial'];?>" readonly></b></td>
                                <input value="<?php echo $row['car_serial'];?>" type="text" name="serial" hidden>
                                <input value="<?php echo date("m/d/y");?>" type="text" name="date" hidden >
                            </tr>
                            <tr>
                                <td>Car Model:</td>
                                <td><b><input class="form-control" value="<?php echo $row['model'];?>" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td><b><input class="form-control" value="<?php echo $row['year'];?>" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Car Details:</td>
                                <td><b><input class="form-control" value="<?php echo $row['details'];?>" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Car Mileage:</td>
                                <td><b><input class="form-control" value="<?php echo $row['mileage'];?>" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Rent Per Day:</td>
                                <td><b><input class="form-control" value="<?php echo "Php".$row['cost'];?>" readonly></b></td>
                            </tr>
                            <?php
                            try
                            {
                                $id = $_GET['car_id'];
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $result = $DB_con->prepare("SELECT cars.car_serial, manufacturer.name FROM cars INNER JOIN manufacturer ON cars.manu_id=manufacturer.manu_id where md5(car_id) = '$id'; ");
                                $result->execute();
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                            }
                            catch (PDOException $msg) 
                            {
                                die("Connection Failed : " . $msg->getMessage());
                            }
                            ?>
                            <tr>
                                <td>Manufacturer: </td>
                                <td><b><input class="form-control" value="<?php echo $row['name'];?>" readonly></b></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"><br>
                                    <button type="submit" class="btn btn-primary" name="rent">
                                        <span class="glyphicon glyphicon-plus"></span> Tune Up Car
                                    </button>
                                    <a href="maintain.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i>       Cancel</a>
                                </td>   
                            </tr>
                        </table>
                    </div>
                </center>
            </form>
        </div>
        <div class="container">
            <?php include 'homefooter.php'; ?>
        </div>
    </div>
</body>
</html>