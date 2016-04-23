<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include	'confg.php';
    include	'pdo.php'; 
    include 'session3.php';
	$username = $_SESSION['username'];
	$m_id = $_SESSION['m_id'];
?>
<html>
<head>
    <link rel="stylesheet" media="screen" href="style.css">
</head>
<body>
	<div class="container">
		<?php include 'main_header1.php'; ?><br>
		<center>
			<h2 class="welcome"><img class="img-responsive" src="images/welcomemain.png">&nbsp;<?php echo $username;?><img src="images/punc.png"></h2>
		</center>
		<div class="container">
            <img class="img-responsive" src="images/under.png">
			<form class="form-horizontal" action="" method="GET">
				<div class="form-group">
                    <div class="col-sm-4">
                        <input class="form-control input" type="text" id="sm" name="query" placeholder="Search car serial" align="right" required>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary" name="search">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                        <a href="tune_finish.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-refresh"></i> All Records</a>
                    </div>
                </div>
			</form>
		</div>
		<div class="container">
			<form method="POST">
                <div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tr>
						<th>Car Serial</th>
						<th>TuneUp Date</th>
						<th colspan="2" align="center">Actions</th>
					</tr>
					<?php
						if(isset($_GET['search'])){
							$query = strtoupper($_GET["query"]);
                            $DB_con = Database::connect();
                            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM car_maintenance where action='Under Maintenance' and car_serial like '%$query%'";
                        }   
                         
						else
						{
                            $DB_con = Database::connect();
                            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM car_maintenance where action='Under Maintenance'";

						}

                        $result = $DB_con->query($sql);
                            if($result->rowCount()>0)
                            {
                                while($row=$result->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                    <tr>
										<td><?php print($row['car_serial']); ?></td>
										<td><?php print($row['tuneup_date']); ?></td>
										<td><a href="tuneup_done.php?car_id=<?php echo md5($row['car_serial']);?>"><font color="blue"><b>Finish Tune Up</b></font></a>
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
            <?php include 'homefooter.php'; ?>
        </div>
	</div>
</body>
</html>