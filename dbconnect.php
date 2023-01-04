<?php

// $host = "localhost";
// $username = "root";
// $pass = "";
// $database = "leave_management";
// $conn = mysqli_connect($host, $username, $pass, $database);
// if ($conn->connect_error) {
//     die("Database Error: " . $conn->error);
// }

define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'leave_management');
   $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
