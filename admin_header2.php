<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<html lang="en">
<head>
	<title>Cebu Car Rental</title>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
<br>
    <div class="container design">
        <img class="img-responsive" src="images/logoheader.png">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">ADMIN</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="employee.php">Employees</a></li>
                        <li class="active"><a href="main_employee.php">Maintenance Employees</a></li>
                        <li><a href="customers.php">Customers</a></li>
                        <li><a href="cars.php">Cars</a></li>
                        <li><a href="rental.php">Rental</a></li>
                        <li><a href="maintenance.php">Car Maintenance</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="main_add.php"><span class="glyphicon glyphicon-user"></span> Add new employee</a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <center><img class="img-responsive" src="images/admin.png"></center>
    </div>
</body>
</html>