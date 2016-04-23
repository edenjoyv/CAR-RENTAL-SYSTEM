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
        <?php include 'main_header2.php'; ?>
        <center>
            <img class="img-responsive" src="images/carentry.png">
            <div class="container">
                <form method="post" name="myform" onsubmit="CheckForm()">
                    <?php 
                    if(isset($_POST['btn-save']))
                    {
                        car::add_car();
                    } 
                    ?>
                    <div class="table-responsive tb">
                        <table class="table table-bordered">
                            <tr>
                                <td align="right">Car Serial</td>
                                <td><input type='test' name='serial' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right"> Car Model</td>
                                <td><input type='text' name='model' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Year</td>
                                <td ><input type='text' name='year' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Class</td>
                                <td ><input type='text' name='class' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Details</td>
                                <td><input type='text' name='detail' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Mileage</td>
                                <td><input type='text' name='mileage' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Cost</td>
                                <td><input type='text' name='cost' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Manufacturer</td>
                                <td>
                                    <select name='manu' class='form-control'>
                                        <?php
                                            car::dropdown();
                                        ?>
                                    </select><br>
                                    <a href="add_manu.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> Add New Manufacturer</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button type="submit" class="btn btn-primary" name="btn-save">
                                        <span class="glyphicon glyphicon-plus"></span> Add
                                    </button>  
                                    <a href="maintain.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
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