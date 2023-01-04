<?php
session_start();

include_once 'dbconnect.php';

$login = 0;



if (isset($_SESSION['login_id'])) {
    if ($_SESSION['login_type'] == "ADMIN") {
        header("Location:admin_panel.php?id=" . $_SESSION['login_id']);
    } else {
        header("Location:user.php?id=" . $_SESSION['login_id']);
    }
} else if (isset($_COOKIE['login_id'])) {
    if ($_COOKIE['login_type'] == "ADMIN") {
        header("Location:admin_panel.php?id=" . $_COOKIE['login_id']);
    } else {
        header("Location:user.php?id=" . $_COOKIE['login_id']);
    }
}


$errorMessage = 0;

$cookie_name = 'login_check';





if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);



    if (isset($_POST['keep_login'])) {
        $keep_login = $_POST['keep_login'];
    }

    $loginQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    if ($conn->query($loginQuery) == TRUE) {

        $result = $conn->query($loginQuery);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            //            echo $row['id'];

            $_SESSION['login_id'] = $row['id'];
            $_SESSION['login_type'] = $row['type'];
            $_SESSION['login_time'] = date("H:i:s");


            if (isset($_POST['keep_login'])) {
                setcookie('login_id', $row['id'], time() + 3600 * 20);
                setcookie('login_type', $row['type'], time() + 3600 * 20);
                setcookie('login_time', date("H:i:s"), time() + 3600 * 20);
            }
            if ($row['type'] == "ADMIN") {
                header("Location:admin_panel.php?id=" . $row['id']);
            } else {
                header("Location:user.php?id=" . $row['id']);
            }
        } else {
            $errorMessage = 1;
        }
    } else {
        die($conn->error);
    }
}

$checkUpdate = 0;
$checkUpdateEmail = 1;

//Signup part
$randomNum = mt_rand(1000, 9999);
$id = "172" . $randomNum;

if (isset($_POST['submit_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $type = 'USER';


    $checkEmail = "SELECT* FROM users WHERE email='$email'";
    if ($conn->query($checkEmail) == TRUE) {
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            $checkUpdateEmail = 0;
        } else {

            $insertSql = "INSERT INTO users VALUES ('$id', '$name', '$email', '$pass', '$phone', '$type')";
            if ($conn->query($insertSql) == TRUE) {
                $checkUpdate = 1;
            } else {
                die($conn->error);
            }
        }
    } else {
        die($conn->error);
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Leave Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body style="">


    <!-- Log In Page -->


    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12"></div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form">
                        <ul class="tab-group">
                            
                            

                            

                        </ul>
                        <div class="tab-content">
                            <div id="login">
                                <h1 class="text-center">Welcome!</h1><br />
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">User Email: </label>
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input class="form-control" type="email" name="email" placeholder="Enter your email address" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Password: </label>
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input class="form-control" type="password" name="password" placeholder="Enter password" />
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="keep_login" name="keep_login" checked>Remember me</label>
                                            </a>?</label>
                                        </div>
                                    </div>
                                    <div class="login">
                                        <button type="submit" value="Login" name="login_btn" class="login_button btn btn-block btn-lg"><span class="glyphicon glyphicon-off"></span> Log In</button>
                                    </div>
                                </form>
                            </div>
                            <div id="signup">
                                <h1 class="text-center">Sign Up for Free</h1><br />

                                <form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Name:</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="name" placeholder="Enter last name" /><br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Email:</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="email" name="email" placeholder="Enter email" required="" /><br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Password:</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="password" placeholder="Enter password" required="" /><br />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Phone Number:</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="phone" placeholder="Enter phone number" required="" /><br />
                                        </div>
                                    </div>




                                    <br><br>
                                    <div class="col-sm-6">
                                        <button type="submit" name="submit_btn" value="Submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-check-square-o" aria-hidden="true"> Submit</i></button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-danger btn-lg btn-block"><span class="fa fa-undo"> Reset</span></button>
                                    </div>

                                    <br><br>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        $('.tab a').on('click', function(e) {

            e.preventDefault();

            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');

            target = $(this).attr('href');

            $('.tab-content > div').not(target).hide();

            $(target).fadeIn(600);

        });
    </script>

</body>

</html>