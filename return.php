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
        <?php include 'emp_header1.php';?><br>
        <div class="container">
            <center>
                <h2 class="welcome"><img class="img-responsive" src="images/welcome.png"><?php echo $username;?><img class="img-responsive" src="images/punc.png"></h2>
            </center>
            <img class="img-responsive" src="images/current.png">
        </div>
        <div class="container">
            <form class="form-horizontal" action="" method="get">
                <div class="form-group">
                    <div class="col-sm-4">
                        <input class="form-control input" type="text" id="sm" name="query" placeholder="Search customer ID or car rented" align="right" required>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary" name="search">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
            <form action="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Customer ID No.</th>
                            <th>Car Rented</th>
                            <th>Date Rented</th>
                            <th colspan="2" align="center">Actions</th>
                        </tr>
                        <?php
                        if(isset($_GET['search'])){
                            $query = strtoupper($_GET["query"]);
                            $DB_con = Database::connect();
                            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM rental where action='Rented' and cust_id like '%$query%' or car_serial like '%$query%'";
                        }   
						else
						{
                            $DB_con = Database::connect();
                            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM rental where action='Rented'";

						}

						$result = $DB_con->query($sql);
                            if($result->rowCount()>0)
                            {
                                while($row=$result->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                    <tr>
										<td><?php print($row['cust_id']); ?></td>
										<td><?php print($row['car_serial']); ?></td>
										<td><?php print($row['date_rent']); ?></td>
										<td>
										<a href="cust_return.php?rent_id=<?php echo md5($row['rent_id']);?>"><font color="blue"><b>Return</b></font></a>
                                    </tr>
                                           <?php
                                }
                                
                            }
                        else{
                             echo "<center><p><h4><b> No Records Found</b></h4></p></center>";
                        }
                        ?>
                    </table>
                </div>
            </form>
        </div>
        <div class="container">
            <a href="return.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-refresh"></i> All Records</a>
        </div>
        <div class="container">
            <?php include 'homefooter.php'; ?>
        </div>
    </div>
</body>
</html>