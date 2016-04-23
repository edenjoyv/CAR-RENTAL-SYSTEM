<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include'confg.php';
    include'pdo.php'; 
    include 'session.php';
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    if(isset($_POST['rent']))
    {
        car::cust_add(); 
    }
    
    try
    {
        $id = $_GET['car_id'];
        $DB_con = Database::connect();
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $DB_con->prepare("SELECT * FROM cars where md5(car_id) = '$id'");
        $result->execute();
       $row = $result->fetch(PDO::FETCH_ASSOC);
    }
    
    catch (PDOException $msg) 
    {
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
        <?php include 'emp_header.php'; ?>
        <center>
            <img class="img-responsive" src="images/rentcar.png">
            <div class="container">
                <form method="post">
                    <div class="table-responsive tb">
                        <table class="table table-bordered">
                            <tr>
                                <td align="right">Car Serial:</td>
                                <td ><b><?php echo $row['car_serial'];?></b></td>
                                <input value="<?php echo $row['car_serial'];?>" type="text" name="serial" hidden>
                                <input value="<?php echo date("m/d/y");?>" type="text" name="date" hidden >
                            </tr>
                            <tr>
                                <td align="right">Car Model:</td>
                                <td><b><?php echo $row['model'];?></b></td>
                            </tr>
                            <tr>
                                <td align="right">Year:</td>
                                <td><b><?php echo $row['year'];?></b></td>
                            </tr>
                            <tr>
                                <td align="right">Car Details:</td>
                                <td><b><?php echo $row['details'];?></b></td>
                            </tr>
                            <tr>
                                <td align="right">Car Mileage:</td>
                                <td><b><?php echo $row['mileage'];?></b></td>
                            </tr>
                            <tr>
                                <td align="right">Rent Per Day:</td>
                                <td><b><?php echo "Php".$row['cost'];?></b></td>
                            </tr>
                            <tr>
                                <?php
                                try{
                                    $id = $_GET['car_id'];
                                    $DB_con = Database::connect();
                                    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $result = $DB_con->prepare("SELECT cars.car_serial, manufacturer.name FROM cars INNER JOIN manufacturer ON    cars.manu_id=manufacturer.manu_id where md5(car_id) = '$id'; ");
                                    $result->execute();
                                    $row = $result->fetch(PDO::FETCH_ASSOC);
                                }
                                catch (PDOException $msg) {
                                    die("Connection Failed : " . $msg->getMessage());
                                }
                                ?>
                                <td align="right">Manufacturer:</td>
                                <td><b><?php echo $row['name'];?></b></td>
                            </tr>
                                <?php
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $result = $DB_con->prepare("SELECT * FROM cust_rec ");
                                $result->execute();
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                $rec_add="1";
                                $last=$row['last_rec'];
                                $rec=$last+$rec_add;
                                ?>
                            <tr>
                                <input type="text" value="<?php echo $rec;?>"name="id" hidden >
                                <td align="right"><b>First Name:</b></td>
                                <td><input class="form-control" type="text" name="fname" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Middle Name:</b></td>
                                <td><input class="form-control" type="text" name="mname"></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Last Name:</b></td>
                                <td><input class="form-control" type="text" name="lname" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Birth Date:</b></td>
                                <td><input class="form-control" type="date" name="bdate" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Age:</b></td>
                                <td><input class="form-control" size="8" type="text" name="age" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Sex:</b></td>
                                <td>
                                    <select name="sex">
                                        <option value="Male" selected="Male">Male</option>
                                        <option value="Female" >Female</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><b>Contact:</b></td>
                                <td><input class="form-control" type="text" name="contact" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Address:</b></td>
                                <td><input class="form-control" type="text" name="add" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Credit Rating:</b></td>
                                <td><input class="form-control" type="text" name="credit" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button type="submit" class="btn btn-primary" name="rent">
                                        <span class="glyphicon glyphicon-plus"></span> Rent
                                    </button>  
                                    <a href="rent_home.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
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