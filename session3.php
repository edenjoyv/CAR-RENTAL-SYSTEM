<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
session_start();

if(!isset($_SESSION['m_id']) || (trim($_SESSION['m_id']) == '')){
	header('location:index.php');
	exit();
}
$session_id = $_SESSION['m_id']; 
$session_id = $_SESSION['username']; 

?>