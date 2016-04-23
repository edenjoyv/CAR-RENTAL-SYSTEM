<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include	'confg.php';
    include	'pdo.php'; 
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
        <?php include 'emp_header.php'; ?>
        <div class="container">
            <center>
                <h2 class="welcome"><img class="img-responsive" src="images/welcome.png"><?php echo $username;?><img class="img-responsive" src="images/punc.png"></h2>
            </center>
        </div>
        <div class="container">
            <form action="" method="post">
                <img class="img-responsive" src="images/manu.png">&nbsp;
                <select class="input" id="id_select" name='subject' onchange="this.form.submit();">
                    <option value="default" selected="default">Select manufacturer</option>
                    <?php
                        car::dropdown();
                    ?>
                </select>
            </form>
        </div><br>
        <div class="container">
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Car Serial</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Details</th>
                            <th>Rent Per Day</th>
                            <th colspan="3" align="center">Actions</th>
                        </tr>
                        <?php
                            if(isset($_GET['search'])){
                                $query = strtoupper($_GET["query"]);
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT * FROM cars where action='Available' and car_serial like '%$query%' or model like '%$query%'";
                            }   
                            elseif(isset($_POST['subject'])){
                                $sub=$_POST['subject'];
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT * FROM cars where action='Available' and manu_id like '%$sub%' ";
                            }                            
                            else
                            {
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT * FROM cars where action='Available'";
                            }	
                            $result = $DB_con->query($sql);
                            if($result->rowCount()>0)
                            {
                                while($row=$result->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                    <tr>
										<td><?php print($row['car_serial']); ?></td>
										<td><?php print($row['manu_id']); ?></td>
										<td><?php print($row['model']); ?></td>
										<td><?php print($row['year']); ?></td>
										<td><?php print($row['details']); ?></td>
										<td><?php print($row['cost']); ?></td>
										<td align="center">
											<a href="cust.php?car_id=<?php echo md5($row['car_id']);?>"><font color="blue"><b>Rent</b></font></a>
										</td>
                                    </tr>
									<?php
                                }
                                
                            }
                            else {
                                echo "<center><p><h4><b> No Records Found</b></h4></p></center>";
                            }
                        ?>
                    </table>
                </div>
            </form>
        </div>
        <div class="container">
            <form class="form-horizontal" action="" method="GET">
				<div class="form-group">
                    <div class="col-sm-4">
                        <input class="form-control input" type="text" id="sm" name="query" placeholder="Search by Car Serial or Car Model" align="right" required>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary" name="search">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                        <a href="maintain.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-refresh"></i> All Records</a>
                    </div>
                </div>
			</form>
        </div>
        <div class="container">
            <?php include 'homefooter.php'; ?>
        </div>
    </div>
</body>
</html>