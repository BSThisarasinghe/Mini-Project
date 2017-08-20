<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php include("Includes/db.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$id = $_SESSION["id"];
$username = $_SESSION["username"];
$sql1 = "SELECT * FROM member WHERE id = '$id'";
$admin_set = mysqli_query($conn, $sql1);
$admin = mysqli_fetch_assoc($admin_set);

$sql = "SELECT * FROM visited WHERE username = '$username' ORDER BY id DESC";
$result_set = mysqli_query($conn, $sql);

$count = 0;
$sql2 = "SELECT * FROM details WHERE username = '$username'";
$select_set = mysqli_query($conn, $sql2);
$member = mysqli_fetch_assoc($select_set);

$count = mysqli_num_rows($select_set);

if ($count == 0) {
    echo "<script>";
    echo 'function myFunction() {';
    echo "document.getElementById('myBtn').disabled = true;";
    echo '}';
    echo "</script>";
}
?>
<html lang="en">
    <head>
        <title>Profile</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Orbitron:400,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/details.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed"
              rel="stylesheet">
    </head>
    <body onload="myFunction()">
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
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                    echo '<li><a href="manage_admin.php"><b>MANAGE ADMIN</b></a></li>';
                                } else {
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li class="active"><a href="profile_member.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                }
                            } else {
                                echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
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
        </div><br/><br/><br/>
        <div class="container" id="content">
            <div class="row">
                <div class="col-md-4" id="info">
                    <img src="<?php echo $member["photo"]; ?>" id="profilepic" onerror="if (this.src != 'pics/avatar.jpg') this.src = 'pics/avatar.jpg';" class="img-responsive img-circle" style="width: 300px; height: 300px;"><br>
                    <h2>
                        <b><?php echo $admin["fname"]; ?>
                            <?php echo $admin["lname"]; ?></b>
                    </h2>
                    <h3><?php echo $admin["username"]; ?></h3>
                    <p><?php echo $admin["email"]; ?></p>
                    <button type="button" id="myBtn" class="btn btn-default" data-toggle="modal" data-target="#myModal">Show Details</button><br><br>
                    <div class="modal fade" id="myModal" role="dialog">

                        <!-- Modal content-->
                        <div class="modal-content" id="myContent">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Patient Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Full Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["FullName"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>National Identity Card Number</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["nic"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Faculty</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["faculty"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Civil Status</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["status"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Religion</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["religion"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nationality</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["nationality"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Family Position</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["familyposition"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Permanent Address</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["permenantAddress"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Current Address</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["currentAddress"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Guardian/Parent</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["guardian"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Boarding/Relation</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["boarding"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Amount Paid For Month</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["payment"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Occupation Father/Mother</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["guardianJob"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Are you getting bursary?</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["bursary"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Last school attended</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["lastschool"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Games played at school</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["gamesatschool"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <h4>Family Medical History</h4>
                                    <div class="col-md-4">
                                        <label>Mother's age(If dead, age at death and cause of death)</label>
                                    </div>
                                    <div class="col-md-8">

                                        <p><?php echo $member["momage"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Father's age(If dead, age at death and cause of death)</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["dadage"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Brother's age(If dead, age at death and cause of death)</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["broage"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Sister's age(If dead, age at death and cause of death)</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["sisage"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Vegitarian/Non-vegitarian</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["vegi"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Living Condition</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["home"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Number of inmates</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["inmates"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Number of rooms</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["rooms"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Floor-Cement/Semi Permanent</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["floor"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Roof/Permanent</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["roof"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Latring-Water</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["toilets"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Water</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["water"]; ?></p>
                                    </div>
                                </div><div class="row">
                                    <div class="col-md-4">
                                        <label>Drinking Water</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["drinkingwater"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Income from all sources</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["income"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h4>Previous Medical History</h4>
                                    <div class="col-md-4">
                                        <label>Infection Diseases</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["infectiondiseases"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Worm Infections</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["worm"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Tropical Diseases</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["tropical"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Respiratory</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["respiratory"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Circulatory</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["circulatory"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>E.N.T</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["ent"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Eye</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["eye"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nervous System</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["nervous"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Surgical</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["surgical"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Misc</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["misc"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Immunisations</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["immunisations"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Stress</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["stress"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Present Complaints</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["sickness"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h4>Menstrual History</h4>
                                    <div class="col-md-4">
                                        <label>Age at set</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["startage"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Period</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["period"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Flow</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["flow"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Pain</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["pain"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Number of Days</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $member["days"]; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-1">

                </div>
                <diV class="col-md-6">
                    <?php while ($result = mysqli_fetch_assoc($result_set)) { ?>
                        <div class="row" id="visit">
                            <h4><b>Sickness:</b> <?php echo $result["sickness"]; ?></h4>
                            <p><b>Medicine:</b> <?php echo $result["medicine"]; ?></p>
                            <p class="text-right"><b>Date:</b> <?php echo $result["date"]; ?></p>
                        </div><br>
                    <?php } ?>
                </diV>
                <div class="col-md-1">

                </div>
            </div>
        </div>
        <?php include("Includes/footer.php"); ?>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>