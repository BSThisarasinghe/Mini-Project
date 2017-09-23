<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php include("Includes/db.php"); ?>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM member WHERE username = '$_POST[username]'";
    $role_set = mysqli_query($conn, $sql);
    $role = mysqli_fetch_assoc($role_set);
    if (!empty($username) && !empty($password)) {
        $found_admin = attempt_login($username, $password);

        if ($found_admin) {
            if ($role["role"] == "admin") {
                $_SESSION["id"] = $found_admin["id"];
                $_SESSION["username"] = $found_admin["username"];
                redirect_to("profile_admin.php");
            } else {
                $_SESSION["id"] = $found_admin["id"];
                $_SESSION["username"] = $found_admin["username"];
                redirect_to("profile_member.php");
            }
        } else {
            $_SESSION["message"] = "Login failed!";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Orbitron:400,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Sign In</title>
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
                                    echo '<li><a href="addUpdates.php"><b>ADD UPDATES</b></a></li>';
                                } else {
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="profile_member.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                }
                            } else {
                                echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                echo '<li class="active"><a href="login.php"><b>SIGN IN</b></a></li>';
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
        <div class=""container-fluid">
             <div class="row" id="background">
                <div class="col-md-4">

                </div>
                <div class="col-md-4"><br><br><br>
                    <div class="row text-center" id="login">
                        <h2>SIGN IN</h2><br><br>
                        <?php echo message(); ?>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username"><br>
                                <input type="password" class="form-control" placeholder="Password" name="password"><br><br>
                                <input type="submit" value="Log In" name="submit" class="form-control btn btn-success"><br>
                            </div>
                        </form><br><br>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <?php include("Includes/footer.php"); ?>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
