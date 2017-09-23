<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php include("Includes/db.php"); ?>
<?php
$result = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $work = $_POST['work'];
    $date = date("Y/m/d");

    $sql1 = "SELECT * FROM doctorinfo WHERE name = '$_POST[name]'";
    $result_set = mysqli_query($conn, $sql1);
    $result = mysqli_fetch_assoc($result_set);
    $photo = $result["picture"];
    $sql2 = "UPDATE updates SET name = '$name',work = '$work',picture = '$photo',date = '$date'";
    mysqli_query($conn, $sql2);
}
?>
<html>
    <head>
        <title>Add Updates</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400"
              rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Orbitron:400,900"
              rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/about.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="reg.php"><b>SIGN UP</b></a></li>';
                                    echo '<li><a href="profile_admin.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="manage_admin.php"><b>MANAGE ADMIN</b></a></li>';
                                    echo '<li class="active"><a href="addUpdates.php"><b>ADD UPDATES</b></a></li>';
                                } else {
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="profile_member.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                }
                            } else {
                                echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                echo '<li><a href="login.php"><b>SIGN IN</b></a></li>';
                                echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid --> </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <form action="addUpdates.php" method="post">
                            <div class="form-group">
                                <label>Doctor's name</label>
                                <select name="name" class="form-control">
                                    <option></option>
                                    <option value="Dr.Smith">Dr.Smith</option>
                                    <option value="Dr.Mike">Dr.Mike</option>
                                    <option value="Doctor is absent today">Doctor is absent today</option>
                                </select><br>
                                <select name="work" class="form-control">
                                    <option value=""></option>
                                    <option value="At Work today">At Work today</option>
                                </select><br>
                                <input type="submit" name="submit" value="SEND" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include("Includes/footer.php"); ?>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>