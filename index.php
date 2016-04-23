<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
	include 'confg.php';
	include 'pdo.php';
    require_once 'createdb.php';
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
    <?php
			session_start();

			if(isset($_SESSION['user_id'])){

				header('location:rent_home.php');
			}
			elseif(isset($_SESSION['m_id'])){

				header('location:maintain.php');
			}
			elseif(isset($_SESSION['admin_id'])){

				header('location:employee.php');
			}

			if(isset($_POST['log'])){

				car::login();
			}

		?>
	<div class="container">
		<div>
            <img class="img-responsive" src="images/logoheader.png">
		</div><br>
		<div style="background-image: url(images/banner005.jpg);">
			<div class="logbody table-responsive">
			<form  method="POST">
				<table align="center">
					<tr>
						<td colspan="2" align="center"><img class="img-responsive" src="images/logofinal.png"></td>
					</tr>
					<tr>
						<br><td align="right"><img class="img-responsive" src="images/username.png"></td>
						<td align="right"><input type="text" id="username" name="username" class="col-sm-12 tb5" placeholder="Enter username" required></td>
					</tr>
					<tr>
						<td align="right"><br><img class="img-responsive" src="images/password.png"></td>
						<td align="right"><input type="password" name="pass" class="col-sm-12 tb5" placeholder="Enter password" required></td>
					</tr>
					<tr>
                        <td></td>
						<td align="right">
                            <br><button type="submit" class="btn btn-primary" name="log">
                                <span class="glyphicon glyphicon-log-in"></span> Login
                            </button>	
						</td>
					</tr>
				</table>
			</form>
			</div>
		</div>
		<div>
			<center>
				<?php include 'homefooter.php'; ?>
			</center>
		</div>
	</div>
</body>	
</html>