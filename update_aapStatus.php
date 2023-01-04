<?php

session_start();
include_once 'dbconnect.php';
$ap_id = $_GET['id'];
$user_id = $_GET['user'];
$updateSql = "UPDATE application SET status='Approved' WHERE ap_id='$ap_id'";
if ($conn->query($updateSql) == TRUE) {
    header("Location:admin_panel.php?id=" . $user_id);
} else {
    die($conn->error);
}

