<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
	include_once 'confg.php';

	class car
	{
		public function login() {
            $DB_con = Database::connect();
            $user = $_POST['username'];
          	$pass =  $_POST['pass'];
			$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          	$stmt = $DB_con->prepare("SELECT * FROM admin where uname = '$user' and pword = '$pass'");
         	$stmt->execute();
            
			if($stmt->rowCount()>0)
            {
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					$_SESSION['admin_id'] = $row['admin_id'];
					$_SESSION['uname'] = $row['uname'];   
				}  
				
                header("Location: employee.php");
            }
			
            elseif($stmt->rowCount()==0)
          	{
                $stmt1 = $DB_con->prepare("SELECT * FROM users where username = '$user' and password = '$pass'");
                $stmt1->execute();
          	}
			
            if($stmt1->rowCount()>0)
            {
				while($row=$stmt1->fetch(PDO::FETCH_ASSOC))
				{
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];   
				}  
                
				header("Location: rent_home.php");
			}

            elseif($stmt1->rowCount()==0)
			{
             	$stmt2 = $DB_con->prepare("SELECT * FROM maintenance where username = '$user' and password = '$pass'");
              	$stmt2->execute();	
        	}	

			if($stmt2->rowCount()>0)
            {
				while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
				{
					$_SESSION['m_id'] = $row['m_id'];
					$_SESSION['username'] = $row['username'];   
				}  
                				
				header("Location: maintain.php");
            }
                	
			else
			{
                echo "<center><p style=color:red;>Invalid username or password</p></center>";
            }

            return true;
                	
        }

		public function dropdown() {
            $DB_con = Database::connect();
            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $DB_con->prepare("SELECT * FROM manufacturer ");
			$result->execute();
            
			while($row = $result->fetch(PDO::FETCH_ASSOC)) 
			{
                echo "<option value='" . $row['manu_id'] . "'>" . $row['name'] . "</option>";
            }
		}

		public function cust_add() {
            $date= $_POST['date'];
            $car = $_POST['serial'];
            $cust_id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname= $_POST['lname'];
            $mname = $_POST['mname'];
            $bdate = $_POST['bdate'];
            $age = $_POST['age'];
            $sex= $_POST['sex'];
            $contact = $_POST['contact'];
            $address = $_POST['add'];
            $credit = $_POST['credit'];
            $act="Rented";

            try {
                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "insert into customer(cust_id,fname,lname,mname,bdate,age,sex,address,contact,credit_rate) values(?,?,?,?,?,?,?,?,?,?)";
                $q = $DB_con->prepare($sql);
                $q->execute(array($cust_id,$fname, $lname, $mname,$bdate,$age,$sex,$address,$contact,$credit));
                                       
                $sql = "insert into rental(cust_id,car_serial,date_rent,action) values(?,?,?,?)";
                $q = $DB_con->prepare($sql);
                $q->execute(array($cust_id,$car,$date,$act));

                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE cust_rec set last_rec = '$cust_id' where id = '1'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($cust_id));

				$DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE cars set action = '$act' where car_serial = '$car'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($cust_id));

                header("Location: rent_home.php");
            }
			
			catch (PDOException $msg) {
                die("Connection Failed : " . $msg->getMessage());
            }
		}
		
		public function tune_add(){
            $date= $_POST['date'];
			$car = $_POST['serial'];
            $act="Under Maintenance";

			try{
				$DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "insert into car_maintenance(car_serial,tuneup_date,action) values(?,?,?)";
                $q = $DB_con->prepare($sql);
                $q->execute(array($car,$date, $act));
                                       
				$DB_con = Database::connect();
				$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE cars set action = '$act' where car_serial = '$car'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($cust_id));

                header("Location: maintain.php");
            }
			
			catch (PDOException $msg) {
                die("Connection Failed : " . $msg->getMessage());
            }
		}

		public function tune_done(){
            $date_finish= $_POST['date'];
            $detail = $_POST['detail'];
            $cost = $_POST['cost'];
            $class = $_POST['class'];
            $mileage = $_POST['mileage'];
            $act="Tune Up Finish";
            $avl="Available";
            $car = $_POST['serial'];

            try {
				$DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE car_maintenance set tuneup_finish='$date_finish',action = '$act' where car_serial = '$car'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($date_finish,$act));

                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE cars set tuneup = '$date_finish', action = '$avl', details = '$detail', class = '$class', mileage = '$mileage', cost = '$cost' where car_serial = '$car'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($date_finis,$avl, $detail, $class, $mileage, $cost, ));
                
				header("Location: tune_finish.php");
            }
			
			catch(PDOException $msg) {
                die("Connection Failed " . $msg->getMessage());
			}
		}

		public function customer(){
            try {
				$DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $result = $DB_con->prepare("SELECT * FROM customer where cust_id = '$cust'");
                $result->execute();
                $row = $result->fetch(PDO::FETCH_ASSOC);
            }
			
			catch (PDOException $msg) {
                die("Connection Failed : " . $msg->getMessage());
            }
        }

		public function rent_return(){
            $date_ret= $_POST['date'];
            $charge = $_POST['charge'];
            $total = $_POST['amnt'];
            $id = $_POST['rent'];
            $act="Returned";
            $avl="Available";
            $car = $_POST['serial'];

            try {
				$DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE rental set date_return='$date_ret',charges = '$charge', total_cost = '$total', action='$act' where rent_id = '$id'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($date_ret,$charge, $total, $act));

                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE cars set action = '$avl' where car_serial = '$car'";
                $q = $DB_con->prepare($sql);
                $q->execute(array($cust_id));
                
				header("Location: return.php");
			}
			
			catch(PDOException $msg) {
                die("Connection Failed " . $msg->getMessage());
            }
		}
        
		public function add_car(){
            $serial = $_POST['serial'];
			$model= $_POST['model'];
            $class = $_POST['class'];
            $year = $_POST['year'];
            $mileage = $_POST['mileage'];
            $details = $_POST['detail'];
            $cost = $_POST['cost'];
            $manu = $_POST['manu'];
            $act = "Available";

			try{ 
				$DB_con = Database::connect();
				$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "SELECT * FROM cars where car_serial like '%$serial%'";
				$result = $DB_con->query($sql);
			
				if($result->rowCount()>0){
				echo "<center><p><h4><b> Car Serial Duplicated</b><br/>Please Enter A Valid Car Serial</b></h4></p></center>";
			}
    
			else {
                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "insert cars (car_serial,model,class,year,mileage,details,cost,manu_id, action) values(?,?,?,?,?,?,?,?,?)";
                $q = $DB_con->prepare($sql);
				$q->execute(array($serial, $model, $class, $year, $mileage, $details, $cost, $manu, $act));
                
				header("Location: maintain.php");
            }        
        }
		
		catch (PDOException $msg) {
            die("Connection Failed : " . $msg->getMessage());
        }
	}
	
        public function manu_add(){
            $name = $_POST['manu'];
            $coun = $_POST['country'];

            try {
                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "insert into manufacturer(name,country) values(?,?)";
                $q = $DB_con->prepare($sql);
                $q->execute(array($name, $coun));

                header("Location: add_car.php");
		}
		
		catch (PDOException $msg) {
			die("Connection Failed : " . $msg->getMessage());
        }
	}
        
        public function add_user(){
            $fname = $_POST['fname'];
            $lname= $_POST['lname'];
            $mname = $_POST['mname'];
            $contact = $_POST['contact'];
            $address = $_POST['add'];
            $uname = $_POST['uname'];
            $pword = $_POST['pword'];
                    
            try{
                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "insert into users(fname,lname,mname,address,contact,username,password) values(?,?,?,?,?,?,?)";
                $q = $DB_con->prepare($sql);
                $q->execute(array($fname, $lname, $mname,$address,$contact,$uname,$pword));

                header("Location: employee.php");
        }
		
		catch (PDOException $msg) {
            die("Connection Failed : " . $msg->getMessage());
        }
	}
        
        public function edit_user() {
            $fname = $_POST['fname'];
            $lname= $_POST['lname'];
            $mname = $_POST['mname'];
            $contact = $_POST['contact'];
            $address = $_POST['add'];
            $uname = $_POST['uname'];
            $pword = $_POST['pword'];
            $id = $_POST['id'];

		try {
			$DB_con = Database::connect();
            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users set fname = '$fname', lname = '$lname', mname = '$mname', address='$address', contact='$contact', username='$uname', password='$pword' where user_id = '$id'";
            $q = $DB_con->prepare($sql);
            $q->execute(array($fname,$lname, $mname, $address, $contact,$uname,$pword));
            
			header("Location: employee.php");
        }
		
		catch(PDOException $msg) {
            die("Connection Failed " . $msg->getMessage());
        }
        }
        
        public function main_add(){
            $fname = $_POST['fname'];
            $lname= $_POST['lname'];
            $mname = $_POST['mname'];
            $contact = $_POST['contact'];
            $address = $_POST['add'];
            $uname = $_POST['uname'];
            $pword = $_POST['pword'];
                    
            try{
                $DB_con = Database::connect();
                $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "insert into maintenance(fname,lname,mname,address,contact,username,password) values(?,?,?,?,?,?,?)";
                $q = $DB_con->prepare($sql);
                $q->execute(array($fname, $lname, $mname,$address,$contact,$uname,$pword));
                
                header("Location: main_employee.php");                                    
            }
		
            catch (PDOException $msg) {
                die("Connection Failed : " . $msg->getMessage());
            }
        }
	
        public function main_edit(){
            $fname = $_POST['fname'];
            $lname= $_POST['lname'];
            $mname = $_POST['mname'];
            $contact = $_POST['contact'];
            $address = $_POST['add'];
            $uname = $_POST['uname'];
            $pword = $_POST['pword'];
            $id = $_POST['id'];

        try {
            $DB_con = Database::connect();
            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE maintenance set fname = '$fname', lname = '$lname', mname = '$mname', address='$address', contact='$contact', username='$uname', password='$pword' where m_id = '$id'";
            $q = $DB_con->prepare($sql);
            $q->execute(array($fname,$lname, $mname, $address, $contact,$uname,$pword));
            header("Location: main_employee.php");
        }
        
        catch(PDOException $msg) {
            die("Connection Failed " . $msg->getMessage());
        }
    }

    }
