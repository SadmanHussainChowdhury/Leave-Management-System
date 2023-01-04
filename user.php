<?php
session_start();


if (isset($_SESSION['login_id']) || isset($_COOKIE['login_id'])) {

    include_once 'dbconnect.php';

    $id = $_SESSION['login_id'];
    $name = NULL;
    $email = NULL;
    $type = NULL;
    $dept = NULL;
    $status = NULL;

    $loginQuery = "SELECT* FROM users WHERE id='$id'";

    if ($conn->query($loginQuery) == TRUE) {

        $result = $conn->query($loginQuery);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            //            echo $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $type = $row['type'];
            $dept = $row['dept'];

            $select = "SELECT * FROM application where user_id='$id' ORDER BY ap_id DESC LIMIT 1";
            $result = $conn->query($select);

            if ($result->num_rows > 0) {
                while ($app = $result->fetch_assoc()) {
                    $status = $app['status'];
                }
            } else {
                $status = "Please submit an application first";
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <title>Side navbar manu - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <style type="text/css">
            .navbar-login {
                width: 305px;
                padding: 10px;
                padding-bottom: 0px;
            }

            .navbar-login-session {
                padding: 10px;
                padding-bottom: 0px;
                padding-top: 0px;
            }

            .icon-size {
                font-size: 87px;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a target="_blank" href="#" class="navbar-brand">My App.</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Leave
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="user.php?id=<?php echo $id; ?>">Profile</a></li>
                                <li><a href="home.php?id=<?php echo $id; ?>">Apply</a></li>
                                <li><a href="view_appStatus.php?id=<?php echo $id; ?>">View Status</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span>
                                <strong><?php echo $name; ?></strong>
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="navbar-login">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="text-center">
                                                    <span class="glyphicon glyphicon-user icon-size"></span>
                                                </p>
                                            </div>
                                            <div class="col-lg-8">
                                                <p class="text-left"><strong><?php echo $name; ?></strong></p>
                                                <p class="text-left small"><?php echo $email; ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="navbar-login navbar-login-session">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>
                                                    <a href="logout.php" class="btn btn-danger btn-block">Logout</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="container" style="margin-top: 100px;">
            <div class="jumbotron">
                <h2 class="text-center">Profile Info</h2>
                <div class=" row " style="padding-top: 20px;">
                    <div class="col-sm-3 bg-primary lead">
                        <h5>Name</h5>
                    </div>
                    <div class="col-sm-9 lead">
                        <h4><?php echo $name ?></h4>
                    </div>
                </div>
                <div class=" row ">
                    <div class="col-sm-3 bg-primary lead">
                        <h5>Email</h5>
                    </div>
                    <div class="col-sm-9 lead">
                        <h4><?php echo $email ?></h4>
                    </div>
                </div>
                <div class=" row ">
                    <div class="col-sm-3 bg-primary lead">
                        <h5>Department</h5>
                    </div>
                    <div class="col-sm-9 lead">
                        <h4><?php echo $dept ?></h4>
                    </div>
                </div>
                <div class=" row ">
                    <div class="col-sm-3 bg-primary lead">
                        <h5>Current Application Status</h5>
                    </div>
                    <div class="col-sm-9 lead">
                        <h4><?php echo $status ?></h4>
                    </div>
                </div>

            </div>
        </div>



    </body>

    </html>
<?php
} else {
    header("Location:index.php");
}
