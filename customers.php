<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include	'confg.php';
    include	'pdo.php';
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
        <?php include 'admin_header4.php'; ?><br>
        <img class="img-responsive" src="images/cus.png">
        <div class="container">
            <form class="form-horizontal" action="" method="get">
                <div class="form-group">
                    <div class="col-sm-4">
                        <input class="form-control input" type="text" id="sm" name="query" placeholder="Search first name" align="right" required>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary" name="search">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                        <a href="customers.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-refresh"></i> All Records</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Credit Rating</th>
                        </tr>
                        <?php
                            if(isset($_GET['search']))
                            {							
                                $query = strtoupper($_GET["query"]);
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT * FROM customer where fname like '%$query%'";
                            }                            
                            else
                            {
                                $DB_con = Database::connect();
                                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT * FROM customer";
                            }
                            $result = $DB_con->query($sql);
                            if($result->rowCount()>0)
                            {
                                while($row=$result->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                    <tr>
										<td><?php print($row['cust_id']); ?></td>
										<td><?php print($row['fname']." ".$row['mname']." ".$row['lname']); ?></td>
										<td><?php print($row['bdate']); ?></td>
										<td><?php print($row['age']); ?></td>
										<td><?php print($row['sex']); ?></td>
										<td><?php print($row['contact']); ?></td>
										<td><?php print($row['address']); ?></td>
										<td><?php print($row['credit_rate']); ?></td>
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
            <?php include 'homefooter.php';?>
        </div>
    </div>
</body>
</html>