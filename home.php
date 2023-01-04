<?php
session_start();


if (isset($_SESSION['login_id']) || isset($_COOKIE['login_id'])) {

    include_once 'dbconnect.php';

    $id = $_SESSION['login_id'];
    $name = NULL;
    $email = NULL;
    $type = NULL;

    $loginQuery = "SELECT* FROM users WHERE id='$id'";

    if ($conn->query($loginQuery) == TRUE) {

        $result = $conn->query($loginQuery);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            //            echo $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $type = $row['type'];
        }
    }

    $checkUpdate = 0;

    if (isset($_POST['submit_btn'])) {

        $randomNum = mt_rand(1000, 9999);
        $ap_id = "ap-" . $randomNum;

        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $days = mysqli_real_escape_string($conn, $_POST['days']);

        $insertSql = "INSERT INTO application VALUES ('$ap_id', '$subject', '$description', '$id', '$days', 'Pending')";
        if ($conn->query($insertSql) == TRUE) {
            $checkUpdate = 1;
        } else {
            die($conn->error);
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
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-xs-12 col-sm-6">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <h3 class="text-center">Apply For Leave Now</h3>
                        <hr>

                        <?php
                        if ($checkUpdate == 1) { ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong><?php echo ' Application has been sent.'; ?>
                            </div>


                        <?php }
                        ?>
                        <div class="form-group">
                            <label for="fullName"> Subject </label>
                            <input type="text" placeholder="Type subject" name="subject" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="message"> Description </label>
                            <textarea rows="3" class="form-control" name="description" placeholder="Type your description" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fullName"> Number of Days </label>
                            <input type="text" placeholder="Type subject" name="days" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit_btn" value="Submit" class="btn btn-primary btn-block"> Apply Now </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>



    </body>

    </html>
<?php
} else {
    header("Location:index.php");
}
