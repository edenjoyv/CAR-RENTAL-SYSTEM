<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include 'confg.php';
    include 'pdo.php'; 
    include 'session1.php';
	$uname = $_SESSION['uname'];
	$admin_id = $_SESSION['admin_id'];
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
        <?php include 'admin_header3.php'; ?>
        <center>
            <img class="img-responsive" src="images/empentry.png">
            <div class="container">
                <form method='post' name='myform' onsubmit="CheckForm()">
                    <?php 
                        if(isset($_POST['btn-save']))
                        {
                            car::main_add();
                        } 
                    ?>
                    <div class="table-responsive tb">
                        <table class="table table-bordered">
                            <tr>
                                <td align="right">First Name</td>
                                <td><input type='test' name='fname' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Middle Name</td>
                                <td><input type='text' name='mname' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Last Name</td>
                                <td ><input type='text' name='lname' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Address</td>
                                <td ><input type='text' name='add' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Contact</td>
                                <td><input type='text' name='contact' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Username</td>
                                <td><input type='text' name='uname' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td align="right">Password</td>
                                <td><input type='password' name='pword' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button type="submit" class="btn btn-primary" name="btn-save">
                                        <span class="glyphicon glyphicon-plus"></span> Add
                                    </button>  
                                    <a href="main_employee.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i>  Cancel</a>
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