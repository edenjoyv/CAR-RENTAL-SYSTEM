<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    session_start();

    if(!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == ''))
    {
        header('location:index.php');
        exit();
    }

    $session_id = $_SESSION['user_id'];  
    $session_id = $_SESSION['username'];
?>