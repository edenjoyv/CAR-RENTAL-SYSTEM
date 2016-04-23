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
    
    if(isset($_POST['btn-save']))
    {        
        car::manu_add();
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
        <?php include 'main_header2.php'; ?>
        <center>
            <img class="img-responsive" src="images/manuentry.png">
            <div class="container">
                <form method="post" name="myform" onsubmit="CheckForm()">
                    <div class="table-responsive tb">
                        <table class="table table-bordered">
                            <tr>
                                <td>New Manufacturer</td>
                                <td><input type='test' name='manu' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td><input type='test' name='country' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <button type="submit" class="btn btn-primary" name="btn-save">
                                        <span class="glyphicon glyphicon-plus"></span> Save
                                    </button>  
                                    <a href="add_car.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
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