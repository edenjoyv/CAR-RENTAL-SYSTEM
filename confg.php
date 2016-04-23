<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
class Database
{
		protected static $_dbhost = "localhost";
		protected static $_dbuser = "root";
		protected static $_password = "";
		protected static $_dbname = "car_rentdb";
		protected static $_con = NULL;
			
		public function __construct($con) {
			exit ("Not allowed Init");
		}
		
		public static function connect() {
			if (NULL == self::$_con) {
				try {
					self::$_con = new PDO("mysql:host=" . self::$_dbhost . ";" . "dbname=" .self::$_dbname, self::$_dbuser, self::$_password);
					
				}catch(PDOException $msg) {
					die($msg->getMessage());
				}
			}
			return self::$_con;
		}
		
		public static function disconnect() {
			self::$_con = null;
		}
	}
?>