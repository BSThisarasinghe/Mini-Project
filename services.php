<html>
    <head>
        <title>Our Services</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400"
              rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Orbitron:400,900"
              rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/services.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed"
              rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="reg.php"><b>SIGN UP</b></a></li>';
                                    echo '<li><a href="profile_admin.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li class="active"><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                    echo '<li><a href="manage_admin.php"><b>MANAGE ADMIN</b></a></li>';
                                    echo '<li><a href="addUpdates.php"><b>ADD UPDATES</b></a></li>';
                                } else {
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="profile_member.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li class="active"><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                }
                            } else {
                                echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                echo '<li><a href="login.php"><b>SIGN IN</b></a></li>';
                                echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                echo '<li class="active"><a href="services.php"><b>SERVICES</b></a></li>';
                                echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid --> </nav>
        </div>
        <div class="container-fluid">
            <div class="row" id="background">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <b>OUR SERVICE</b>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-2 icon text-center">
                        <br><br>
                        <i class="fa fa-user-md icon_list" style="font-size:100px;"></i>
                        <h4>CHANNELING</h4>
                    </div>
                    <div class="col-md-2 icon text-center">
                        <br><br>
                        <i class="fa fa-ambulance icon_list" style="font-size:100px;"></i>
                        <h4>AMBULANCE</h4>
                    </div>
                    <div class="col-md-2 icon text-center">
                        <br><br>
                        <i class="fa fa-stethoscope icon_list" style="font-size:100px;"></i>
                        <h4>MEDICINE</h4>
                    </div>
                    <div class="col-md-2 icon text-center">
                        <br><br>
                        <i class="fa fa-medkit icon_list" style="font-size:100px;"></i>
                        <h4>NURSING</h4>
                    </div>
                    <div class="col-md-2 icon text-center">
                        <br><br>
                        <i class="fa fa-heartbeat icon_list" style="font-size:100px;"></i>
                        <h4>CHECK UPS</h4>
                    </div>
                    <div class="col-md-2 icon text-center">
                        <br><br>
                        <i class="fa fa-wheelchair icon_list" style="font-size:100px;"></i>
                        <h4>WHEELCHAIR</h4>
                    </div>

                </div>
            </div>
        </div>
        <?php include("Includes/footer.php"); ?>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>