<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include 'confg.php';
    include 'pdo.php'; 
    include 'session.php';
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    try
    {
        $id = $_GET['rent_id'];
        $DB_con = Database::connect();
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $DB_con->prepare("SELECT * FROM rental where md5(rent_id) = '$id'");
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
    }
    
    catch (PDOException $msg) 
    {
        die("Connection Failed : " . $msg->getMessage());
    }
    
    $cust=$row['cust_id'];
    $car=$row['car_serial'];
    $rent=$row['rent_id'];
    if(isset($_POST['return']))
    {
        car::rent_return();
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
        <?php include 'emp_header1.php'; ?>
        <center>
            <img class="img-responsive" src="images/return.png">
            <div class="container">
                <form method="post">
                    <div class="table-responsive tb">
                        <table class="table">
                            <?php  
                                try
                                {
                                    $DB_con = Database::connect();
                                    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $result = $DB_con->prepare("SELECT * FROM customer where cust_id = '$cust'");
                                    $result->execute();
                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                }
                                catch (PDOException $msg) 
                                {
                                    die("Connection Failed : " . $msg->getMessage());
                                } 
                            ?>
                            <tr>
                                <input value="<?php echo $cust;?>" type="text" name="cust_id" hidden>
                                <input value="<?php echo $car;?>" type="text" name="car" hidden>
                                <input value="<?php echo $rent;?>" type="text" name="rent" hidden>
                                <input value="<?php echo date("m/d/y");?>" type="text" name="date" hidden >
                                <input value="<?php echo $row['car_serial'];?>" type="text" name="serial" hidden>
                                <th colspan="2"><img class="img-responsive" src="images/cusname.png"></th>
                            </tr>
                            <tr>
                                <td>Customer ID:</td>
                                <td><b><?php echo $row['cust_id'];?></b></td>
                            </tr>
                            <tr>
                                <td>Customer Name:</td>
                                <td><b><?php echo $row['fname']." ".$row['mname']." ".$row['lname'];?></b></td>
                            </tr>
                            <tr>
                                <td>Birth Date:</td>
                                <td><b><?php echo $row['bdate'];?></b></td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td><b><?php echo $row['age'];?></b></td>
                            </tr>
                            <tr>
                                <td>Sex:</td>
                                <td><b><?php echo $row['sex'];?></b></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><b><?php echo $row['address'];?></b></td>
                            </tr>
                            <tr>
                                <td>Contact:</td>
                                <td><b><?php echo $row['contact'];?></b></td>
                            </tr>
                            <tr>
                                <td>Credit Rating:</td>
                                <td><b><?php echo $row['credit_rate'];?></b></td>
                            </tr>
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
                                <th colspan="2"><img class="img-responsive" src="images/carname.png"></th>
                            </tr>
                            <tr>
                                <td>Car Serial:</td>
                                <td><b><?php echo $row['car_serial'];?></b></td>
                            </tr>
                            <tr>
                                <td>Car Model:</td>
                                <td><b><?php echo $row['model'];?></b></td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td><b><?php echo $row['year'];?></b></td>
                            </tr>
                            <tr>
                                <td>Class:</td>
                                <td><b><?php echo $row['class'];?></b></td>
                            </tr>
                            <tr>
                                <td>Mileage:</td>
                                <td><b><?php echo $row['mileage'];?></b></td>
                            </tr>
                            <tr>
                                <td>Rent Per Day:</td>
                                <td><b><?php echo $row['cost'];?></b></td>
                            </tr>
                            <tr>
                                <?php
                                    try
                                    {
                                        $DB_con = Database::connect();
                                        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $result = $DB_con->prepare("SELECT cars.car_serial, manufacturer.name FROM cars INNER JOIN manufacturer ON cars.manu_id=manufacturer.manu_id where car_serial = '$car'; ");
                                        $result->execute();
                                        $row = $result->fetch(PDO::FETCH_ASSOC);
                                    }
                                    catch (PDOException $msg) 
                                    {
                                        die("Connection Failed : " . $msg->getMessage());
                                    }
                                ?>
                                <td>Manufacturer:</td>
                                <td><b><?php echo $row['name'];?></b></td>
                            </tr>
                            <?php  
                            try
                            {
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $result = $DB_con->prepare("SELECT * FROM rental where rent_id = '$rent'");
                                $result->execute();
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                            }
                            catch (PDOException $msg) {
                                die("Connection Failed : " . $msg->getMessage());
                            } 
                            ?>
                            <tr><td></td><td></td></tr>
                            <tr>
                                <td>Date Rented:</td>
                                <td><b><?php echo $row['date_rent'];?></b></td>
                            </tr>
                            <tr>
                                <td>Date Returned:</td>
                                <td><b><?php echo date("m/d/y");?></b></td>
                            </tr>
                            <tr>
                                <td><b>Damage Charges:</b></td>
                                <td><input class="form-control" type="text" name="charge" required/></td>
                            </tr>
                            <tr>
                                <td><b>Total:</b></td>
                                <td><input class="form-control" type="text" name="amnt" required/></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button type="submit" class="btn btn-primary" name="return">
                                        <span class="glyphicon glyphicon-refresh"></span> Return Car
                                    </button>  
                                    <a href="return.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
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