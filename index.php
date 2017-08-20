<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php include("Includes/db.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400"
              rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Orbitron:400,900"
              rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Medical Center</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed"
              rel="stylesheet">
    </head>
    <body>
        <?php include("Includes/header.php"); ?>
        <div class="row">
            <nav class="navbar navbar-default" id="navBar"
                 style="margin-bottom: 0;">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed"
                                data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                                aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse"
                         id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if (isset($_SESSION["id"])) {
                                $user = $_SESSION["username"];
                                $myQuery = "SELECT * FROM member WHERE username = '$user'";
                                $query_set = mysqli_query($conn, $myQuery);
                                $fetch = mysqli_fetch_assoc($query_set);
                                if ($fetch["role"] == "admin") {
                                    echo '<li class="active"><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="reg.php"><b>SIGN UP</b></a></li>';
                                    echo '<li><a href="profile_admin.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                    echo '<li><a href="manage_admin.php"><b>MANAGE ADMIN</b></a></li>';
                                } else {
                                    echo '<li class="active"><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="profile_member.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                }
                            } else {
                                echo '<li class="active"><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                echo '<li><a href="login.php"><b>SIGN IN</b></a></li>';
                                echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid --> </nav>
        </div>
        <div class="row">
            <div class="col-md-12" style="width: 100%; height: 400px;"
                 id="picture">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="pics/1.jpg" style="width: 100%;" alt="Medical Center">
                        </div>

                        <div class="item">
                            <img src="pics/2.jpg" style="width: 100%;" alt="Medical Center">
                        </div>

                        <div class="item">
                            <img src="pics/3.jpg" style="width: 100%;" alt="Medical Center">
                        </div>

                        <div class="item">
                            <img src="pics/4.jpg" style="width: 100%;" alt="Medical Center">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel"
                       data-slide="prev"> <span
                            class="glyphicon glyphicon-chevron-left"></span> <span
                            class="sr-only">Previous</span>
                    </a> <a class="right carousel-control" href="#myCarousel"
                            data-slide="next"> <span
                            class="glyphicon glyphicon-chevron-right"></span> <span
                            class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-12 text-center"
                 style="background-color: #048263; color: white;" id="healthy">
                <h3>FOR A HEALTHY WORLD</h3>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-5">
                    <br> <br> <br>
                    <h3>
                        <b>About Our Care</b>
                    </h3>
                    <br>
                    <p>
                        We can help you to be a healthy person width the medicine we have
                        and advises. If we can't help you with medicine we make sure to
                        send you to a hospital.<br> <br> We do our best to help
                        you. If you have a problem with your health or if you are feeling
                        sick you can come to us. We will give you what you want.
                    </p>
                    <br> <br>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <br> <br> <br>
                    <h3>
                        <b>New Updates</b>
                    </h3>
                    <br>
                    <p>fdfsdds fdsfdfdsf fdfddf dfsder rerr ghh hhgdfgfd ggrhh
                        fdggdg e3424 d dfd fs ff f dfd f rtr fgdfgfdggg dfsfdfs sfsdf
                        ffdfsf dfsf fdsfsddf fdfssdf fsdfs dffd fdsfss fdsffds</p>
                    <br> <br>
                </div>
            </div>
        </div>
        <?php include("Includes/footer.php"); ?>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
