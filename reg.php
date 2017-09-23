<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php require_once("Includes/db.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$fnameErr = $lnameErr = $emailErr = $unameErr = $passwordErr = $conpassErr = "";
$fname = $lname = $email = $username = $password = $conpass = $role = "";
$color = "";

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_encrypt($password);
    $conpass = $_POST['conpass'];
    //$hashed_conpassword = password_encrypt($conpass);
    $role = "member";
    $count = 0;
    $res = "SELECT * FROM member WHERE username = '$_POST[username]'";
    $result = mysqli_query($conn, $res);
    //$member = mysqli_fetch_assoc($select_set);
    $count = mysqli_num_rows($result);

    if (empty($_POST["fname"])) {
        $fnameErr = "* First Name is required";
        $color = "red";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
        $fnameErr = "* Please provide a valid name";
        $color = "red";
    } else if (empty($_POST["lname"])) {
        $lnameErr = "* Last Name is required";
        $color = "red";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
        $lnameErr = "* Please provide a valid name";
        $color = "red";
    } else if (empty($_POST["email"])) {
        $emailErr = "* Email is required";
        $color = "red";
    } else if (empty($_POST["username"])) {
        $unameErr = "* Username is required";
        $color = "red";
    } else if (empty($_POST["password"])) {
        $passwordErr = "* Password is required";
        $color = "red";
    } else if (empty($_POST["conpass"])) {
        $conpassErr = "* Password confirming is required";
        $color = "red";
    } else if ($password != $conpass) {
        $conpassErr = "* Password doesn't match";
        $color = "red";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "* Invalid email format";
        $color = "red";
        if (empty($_POST["email"])) {
            $emailErr = "* Email is required";
        }
    } else if (preg_match('/\s/', $username)) {
        $unameErr = "* There should not be white spaces in username";
        $color = "red";
    } else if (strlen($password) < 8) {
        $passwordErr = "* Password should have at least 8 characters";
        $color = "red";
    } else if ($count > 0) {
        $unameErr = "* That username already exists. Please try again with different username";
        $color = "red";
    } else {
        $sql = "INSERT INTO member(fname,lname,email,username,password,role) VALUES('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[username]','$hashed_password','$role')";
        mysqli_query($conn, $sql);
    }
}
?>
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
        <link rel="stylesheet" type="text/css" href="css/reg.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Sign Up</title>
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
                                    echo '<li class="active"><a href="reg.php"><b>SIGN UP</b></a></li>';
                                    echo '<li><a href="profile_admin.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="manage_admin.php"><b>MANAGE ADMIN</b></a></li>';
                                    echo '<li><a href="addUpdates.php"><b>ADD UPDATES</b></a></li>';
                                } else {
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li class="active"><a href="profile_member.php"><b>PROFILE</b></a></li>';
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
        <div class=""container-fluid">
             <div class="row" id="background">
                <div class="container">
                    <div class="col-md-6">
                        <br> <br>
                        <center>
                            <h2>
                                <b>Sign Up Now</b>
                            </h2>
                        </center>
                        <form action="reg.php" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="First"
                                               name="fname" id="fname" value="<?php echo $fnameErr; ?>" style="color: <?php echo $color; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Last"
                                               name="lname" id="lname" value="<?php echo $lnameErr; ?>" style="color: <?php echo $color; ?>">
                                    </div>
                                </div><br> 
                                <label>Email</label> 
                                <input type="text" class="form-control" value="<?php echo $emailErr; ?>" style="color: <?php echo $color; ?>" id="email" placeholder="eg:hello@gmail.com" name="email"> <br> 
                                <label>Username</label> 
                                <input type="text" class="form-control" value="<?php echo $unameErr; ?>" style="color: <?php echo $color; ?>" placeholder="Username" name="username" id="username"><br>
                                <label>Password</label>
                                <input type="text" class="form-control" value="<?php echo $passwordErr; ?>" style="color: <?php echo $color; ?>" placeholder="Enter your password" name="password" id="password"><br>
                                <label>Confirm Password</label>
                                <input type="text" class="form-control" value="<?php echo $conpassErr; ?>" style="color: <?php echo $color; ?>" placeholder="Re-enter your password" name="conpass" id="conpass"><br>
                                <hr>
                                <input type="submit" class="btn btn-success" value="REGISTER" name="submit" style="background-color: #023e17;" id=""submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include("Includes/footer.php"); ?>
        <script type="text/javascript" src="js/reg.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>