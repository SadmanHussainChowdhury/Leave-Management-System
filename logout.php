<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
date_default_timezone_set('Asia/Dhaka');

include_once 'dbconnect.php';


    session_destroy();
    setcookie('employee_role', '', time() - 3600);
    setcookie('late_reason_box', '', time() - 3600);
    setcookie('login_id', '', time() - 3600);
    setcookie('login_time', '', time() - 3600);
    header("Location:index.php");



    



