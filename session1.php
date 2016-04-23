<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    session_start();

    if(!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == ''))
    {
        header('location:index.php');
        exit();
    }

    $session_id = $_SESSION['admin_id'];  
    $session_id = $_SESSION['uname'];
?>