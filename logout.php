<!--
OOP FINAL PROJECT
TITLE: CAR RENTAL SYSTEM
CREATED BY: EDEN JOY VERGARA
COPYRIGHT 2016
-->

<?php
    session_start();
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['m_id']);
    unset($_SESSION['admin_id']);
    header('location:index.php');
    exit();
?>