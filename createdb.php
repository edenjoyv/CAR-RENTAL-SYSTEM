<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
	include_once 'pdolib.php';

	$dbc = new Pdolib();

	$table1 = 'admin';
	$query1 = "CREATE TABLE IF NOT EXISTS admin
	(
		admin_id int(5) NOT NULL AUTO_INCREMENT,
		uname varchar(30) NOT NULL,
		pword varchar(30) NOT NULL,
		Primary Key(admin_id),
        UNIQUE KEY uname(uname,pword)
	) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=10001;";
	
	$insert1 = "INSERT INTO admin (uname,pword) 
				VALUES('admin','eden');";
				
	if (!$dbc->tableExists($table1) ) {	
		$dbc->createTable($table1,$query1);
		$dbc->insertRecord($insert1);
	}		
	$table2 = 'cars';
	$query2 = "CREATE TABLE IF NOT EXISTS cars
	(
		car_id Int(11) NOT NULL AUTO_INCREMENT,
        manu_id varchar(50) NOT NULL,
		model varchar(50) NOT NULL,
		year int(11) NOT NULL,
		class varchar(50) NOT NULL,
		details varchar(50) NOT NULL,
		cost double NOT NULL,
		car_serial varchar(50) NOT NULL,
		mileage varchar(50) NOT NULL,
		action varchar(50) NOT NULL,
        tuneup varchar(50) NOT NULL,
		Primary Key(car_id),
        UNIQUE KEY car_serial(car_serial)
	) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=104;";
	
	$insert2 = " INSERT INTO cars(car_id,manu_id,model,year,class,details,cost,car_serial,mileage,action,tuneup) 
				VALUES 
                (101, 8881, 'ZT102', 2016, 'Class A', 'Mitsubishi Mirrage', 4500, 'QDF03', '1200 km/hr', 'Available', '03/10/16'),
                (102, 8882, 'GT100', 2015, 'Class A', 'Toyota Vios', 5000, 'GTR08', '1400 km/hr', 'Available', ''),
                (103, 8883, 'XT100', 2014, 'Class A', 'Kia Rio', 5200, 'CSR302', '1600 km/hr', 'Available', '');";
				
	if (!$dbc->tableExists($table2)) {	
		$dbc->createTable($table2,$query2);
		$dbc->insertRecord($insert2);
	}
	
	$table3 = 'car_maintenance';
	$query3 = "CREATE TABLE IF NOT EXISTS car_maintenance
	(
		id int(11) NOT NULL AUTO_INCREMENT,
        car_serial varchar(50) NOT NULL,
		tuneup_date varchar(50) NOT NULL,
		tuneup_finish varchar(50) NOT NULL,
		action varchar(50) NOT NULL,
		Primary Key(id)
	) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=011;";
	
	$insert3 = " INSERT INTO car_maintenance(id,car_serial,tuneup_date,tuneup_finish,action)
                VALUES (010, 'QDF03', '03/10/16', '03/10/16', 'Tune Up Finish');";
			
	if (!$dbc->tableExists($table3) ) {	
		$dbc->createTable($table3,$query3);
		$dbc->insertRecord($insert3);
	}
	
	$table4 = 'customer';
	$query4 = "CREATE TABLE IF NOT EXISTS customer
	(
		cust_id int(11) NOT NULL AUTO_INCREMENT,
		fname varchar(50) NOT NULL,
		mname varchar(50),
        lname varchar(50) NOT NULL,
        bdate date NOT NULL,
        age int(11) NOT NULL,
        sex varchar(10) NOT NULL,
        address varchar(100) NOT NULL,
        contact varchar(50) NOT NULL,
        credit_rate varchar(50) NOT NULL,
		Primary Key (cust_id)
	) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1011;";

	$insert4 =  "INSERT INTO customer(cust_id,fname,mname,lname,bdate,age,sex,address,contact,credit_rate) 		
				VALUES(1010, 'Mariel', 'Espina', 'Estrella', '1997-09-25', 18, 'Female', 'Tipolo Mandaue City', '09102626010', '54000');";
	
	if (!$dbc->tableExists($table4) ) {	
		$dbc->createTable($table4,$query4);
		$dbc->insertRecord($insert4);	
	}
    
    $table5 = 'cust_rec';
	$query5 = "CREATE TABLE IF NOT EXISTS cust_rec
	(
		id int(11) NOT NULL AUTO_INCREMENT,
		last_rec int(11) NOT NULL,
		Primary Key(id)
	) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;";

	$insert5 =  "INSERT INTO cust_rec(id,last_rec)		
				VALUES(1,1010)";
	
	if (!$dbc->tableExists($table5)) {	
		$dbc->createTable($table5,$query5);
		$dbc->insertRecord($insert5);
		
	}

$table6 = 'maintenance';
	$query6 = "CREATE TABLE IF NOT EXISTS maintenance
	(
		m_id int(11) NOT NULL AUTO_INCREMENT,
		fname varchar(50) NOT NULL,
        mname varchar(50),
		lname varchar(50) NOT NULL,
		address varchar(100) NOT NULL,
        contact varchar(15) NOT NULL,
        username varchar(50) NOT NULL,
        password varchar(50) NOT NULL,
		Primary Key(m_id),
        UNIQUE KEY username(username)
	) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=10031;";

	$insert6 = "INSERT INTO maintenance(m_id,fname,mname,lname,address,contact,username,password) 		
				VALUES(10030, 'Maricris', 'Minoza', 'Montecillo', 'Tipolo Mandaue City',09324664774, 'mekis', 'mekis');";
	
	if (!$dbc->tableExists($table6)) {	
		$dbc->createTable($table6,$query6);
		$dbc->insertRecord($insert6);
	}

$table7 = 'manufacturer';
    $query7 = "CREATE TABLE IF NOT EXISTS manufacturer
    (
        manu_id int(11) NOT NULL AUTO_INCREMENT,
        name varchar(50) NOT NULL,
        country varchar(50) NOT NULL,
        PRIMARY KEY (manu_id)
    ) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8885;";

    $insert7 = "INSERT INTO manufacturer(manu_id,name,country)
                VALUES
                (8881, 'MITSUBISHI', 'Canada'),
                (8882, 'TOYOTA', 'Europe'),
                (8883, 'KIA','United States');";

    if (!$dbc->tableExists($table7) ) {	
		$dbc->createTable($table7,$query7);
		$dbc->insertRecord($insert7);
	}

$table8 = 'rental';
    $query8 = "CREATE TABLE IF NOT EXISTS rental
    (
        rent_id int(11) NOT NULL AUTO_INCREMENT,
        cust_id int(11) NOT NULL,
        car_serial varchar(50) NOT NULL,
        date_rent varchar(50) NOT NULL,
        date_return varchar(50) NOT NULL,
        charges double(10,0) NOT NULL,
        total_cost double(10,0) NOT NULL,
        action varchar(50) NOT NULL,
        PRIMARY KEY(rent_id)
    ) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=201;";

    $insert8 = "INSERT INTO rental(rent_id,cust_id,car_serial,date_rent,date_return,charges,total_cost,action)
                VALUES(200, 1010, 'QDF03', '03/10/16', '03/10/16', 1000, 5500, 'Returned');";

    if (!$dbc->tableExists($table8) ) {	
		$dbc->createTable($table8,$query8);
		$dbc->insertRecord($insert8);
	}

$table9 = 'users';
    $query9 = "CREATE TABLE IF NOT EXISTS users
    (
        user_id int(11) NOT NULL AUTO_INCREMENT,
        fname varchar(50) NOT NULL,
        mname varchar(50),
        lname varchar(50) NOT NULL,
        address varchar(100) NOT NULL,
        contact varchar(15) NOT NULL,
        username varchar(50) NOT NULL,
        password varchar(50) NOT NULL,
        PRIMARY KEY(user_id),
        UNIQUE KEY username(username)
    ) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=10021;";

    $insert9 = "INSERT INTO users(user_id,fname,mname,lname,address,contact,username,password)
                VALUES(10020, 'Junnel', 'Dela Cerna', 'Tiu', 'Talisay Cebu City',09123456789, 'junnel', 'tiu');";

    if (!$dbc->tableExists($table9) ) {	
		$dbc->createTable($table9,$query9);
		$dbc->insertRecord($insert9);
	}
?>