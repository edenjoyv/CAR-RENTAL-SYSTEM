<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include 'confg.php';
    include 'pdo.php'; 
    include 'session3.php';
    $username = $_SESSION['username'];
    $m_id = $_SESSION['m_id'];
    $id = $_GET['car_id'];
    
    try
    {
        $id = $_GET['car_id'];
        $DB_con = Database::connect();
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $DB_con->prepare("SELECT * FROM cars where md5(car_serial) = '$id'");
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
    }

    catch (PDOException $msg) 
    {
        die("Connection Failed : " . $msg->getMessage());
    }

    $car=$row['car_serial'];
    if(isset($_POST['return']))
    {
        car::tune_done();
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
        <?php include 'main_header1.php'; ?>
        <center>
            <img class="img-responsive" src="images/finish.png">
            <div class="container">
                <form method="post">
                    <div class="table-responsive tb2">
                        <table class="table">
                            <?php  
                                try
                                {
                                    $DB_con = Database::connect();
                                    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $result = $DB_con->prepare("SELECT * FROM cars where car_serial = '$car'");
                                    $result->execute();
                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                }
                                catch (PDOException $msg) 
                                {
                                    die("Connection Failed : " . $msg->getMessage());
                                } 
                            ?>
                            <tr>
                                <input value="<?php echo $row['car_serial'];?>" type="text" name="serial" hidden>
                                <input value="<?php echo date("m/d/y");?>" type="text" name="date" hidden >
                                <td colspan="2"><img class="img-responsive" src="images/cartune.png"></td>
                            </tr>
                            <tr>
                                <td>Car Serial:</td>
                                <td><b><input class="form-control" value="<?php echo $row['car_serial'];?>" name="serial" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Car Model:</td>
                                <td><b><input class="form-control" value="<?php echo $row['model'];?>" name="model" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td><b><input class="form-control" value="<?php echo $row['year'];?>" name="year" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Class:</td>
                                <td><b><input class="form-control" value="<?php echo $row['class'];?>" name="class" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Mileage:</td>
                                <td><b><input class="form-control" value="<?php echo $row['mileage'];?>" name="mileage" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Rent Per Day:</td>
                                <td><b><input class="form-control" value="<?php echo $row['cost'];?>" name="cost" readonly></b></td>
                            </tr>
                            <tr>
                                <td>Details:</td>
                                <td><b><input class="form-control" value="<?php echo $row['details'];?>" name="detail" readonly></b></td>
                            </tr>
                            <tr>
                                <?php
                                try{
                                    $DB_con = Database::connect();
                                    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $result = $DB_con->prepare("SELECT cars.car_serial, manufacturer.name FROM cars INNER JOIN manufacturer ON cars.manu_id=manufacturer.manu_id where car_serial = '$car'; ");
                                    $result->execute();
                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                    
                                }catch (PDOException $msg) {
                                    die("Connection Failed : " . $msg->getMessage());
                                }
                                ?>
                                <td>Manufacturer:</td>
                                <td><b><input class="form-control" value="<?php echo $row['name'];?>" name="manu" readonly></b></td>
                            </tr>
                            <tr>
                                <?php  
                                try{
                                    $DB_con = Database::connect();
                                    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $result = $DB_con->prepare("SELECT * FROM car_maintenance where car_serial = '$car'");
                                    $result->execute();
                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                }catch (PDOException $msg) {
                                    die("Connection Failed : " . $msg->getMessage());
                                } 
                                ?>
                                <td>Date Tune Up:</td>
                                <td><b><?php echo $row['tuneup_date'];?></b></td>
                            </tr>
                            <tr>
                                <td>Date Finish:</td>
                                <td><b><?php echo date("m/d/y");?></b></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button type="submit" class="btn btn-primary" name="return">
                                        <span class="glyphicon glyphicon-refresh"></span> Finish Tune Up
                                    </button>  
                                    <a href="tune_finish.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </center>
        <div class="container">
            <?php include 'homefooter.php'; ?>
        </div>
    </div>
</body>
</html>