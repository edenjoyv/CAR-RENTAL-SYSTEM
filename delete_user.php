<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    include'confg.php';
    include'pdo.php'; 
    include 'session1.php';
    $uname = $_SESSION['uname'];
    $admin_id = $_SESSION['admin_id'];
    
    try 
    {
        $id = $_GET['user_id'];
        $DB_con = Database::connect();
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $DB_con->prepare("delete from users where md5(user_id) = '$id'");
        $result->execute();
        
        header("Location: employee.php");
    }

    catch(PDOException $msg) 
    {
        die("Connection Failed " . $msg->getMessage());
    }
?>
