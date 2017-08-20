<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php include("Includes/db.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$upload_errors = array(
    UPLOAD_ERR_OK => "No errors.",
    UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL => "Partial upload.",
    UPLOAD_ERR_NO_FILE => "No file.",
    UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
    UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
    UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
);
$username = $_GET["username"];
$sql1 = "SELECT * FROM member WHERE username = '$username'";
$admin_set = mysqli_query($conn, $sql1);
$admin = mysqli_fetch_assoc($admin_set);

$count = 0;
$sql2 = "SELECT * FROM details WHERE username = '$username'";
$select_set = mysqli_query($conn, $sql2);
$member = mysqli_fetch_assoc($select_set);

$count = mysqli_num_rows($select_set);

if ($count > 0) {
    echo "<script>";
    echo 'function myFunction() {';
    echo "document.getElementById('myBtn').disabled = true;";
    echo '}';
    echo "</script>";
}

if ($count == 0) {
    echo "<script>";
    echo 'function myFunction() {';
    echo "document.getElementById('myBtn2').disabled = true;";
    echo '}';
    echo "</script>";
}

$sql4 = "SELECT * FROM visited WHERE username = '$username' ORDER BY id DESC";
$result_set = mysqli_query($conn, $sql4);


$usernameErr = "";
if (isset($_POST['submit'])) {

    $fullname = $_POST["name"];
    $nic = $_POST["nic"];
    $faculty = $_POST["faculty"];
    $status = $_POST["status"];
    $religion = $_POST["religion"];
    $nationality = $_POST["nationality"];
    $position = $_POST["position"];
    $padd = $_POST["padd"];
    $cadd = $_POST["cadd"];
    $guardian = $_POST["guardian"];
    $boarding = $_POST["boarding"];
    $payment = $_POST["payment"];
    $occupation = $_POST["occupation"];
    $bursary = $_POST["bursary"];
    $school = $_POST["school"];
    $games = $_POST["games"];
    $father = $_POST["father"];
    $mother = $_POST["mother"];
    $brother = $_POST["brother"];
    $sister = $_POST["sister"];
    $vegi = $_POST["vegi"];
    $home = $_POST["home"];
    $inmates = $_POST["inmates"];
    $rooms = $_POST["rooms"];
    $floor = $_POST["floor"];
    $roof = $_POST["roof"];
    $lat = $_POST["lat"];
    $water = $_POST["water"];
    $drinking = $_POST["drinking"];
    $income = $_POST["income"];
    $infection = $_POST["infection"];
    $worm = $_POST["worm"];
    $tropical = $_POST["tropical"];
    $respiratory = $_POST["respiratory"];
    $circulatory = $_POST["circulatory"];
    $ent = $_POST["ent"];
    $eye = $_POST["eye"];
    $nervous = $_POST["nervous"];
    $surgical = $_POST["surgical"];
    $misc = $_POST["misc"];
    $immuzation = $_POST["immuzation"];
    $stress = $_POST["stress"];
    $complaints = $_POST["complaints"];
    $onset = $_POST["onset"];
    $period = $_POST["period"];
    $flow = $_POST["flow"];
    $pain = $_POST["pain"];
    $daynumber = $_POST["daynumber"];

    $tmp_file = $_FILES['file_upload']['tmp_name'];
    $target_file = basename($_FILES['file_upload']['name']);
    $upload_dir = "uploads";

    if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)) {
        $message = "File uploaded successfully.";
    } else {
        $error = $_FILES['file_upload']['error'];
        $message = $upload_errors[$error];
    }
    $file = "uploads/" . $_FILES["file_upload"]["name"];
    if ($count > 0) {
        $usernameErr = "That username already exists";
    } else {
        $sql3 = "INSERT INTO details(username,FullName,photo,nic,faculty,status,religion,nationality,familyposition,permenantAddress,currentAddress,guardian,boarding,payment,guardianJob,bursary,lastschool,gamesatschool,momage,dadage,broage,sisage,vegi,home,inmates,rooms,floor,roof,toilets,water,drinkingwater,income,infectiondiseases,worm,tropical,respiratory,circulatory,ent,eye,nervous,surgical,misc,immunisations,stress,sickness,startage,period,flow,pain,days) VALUES ('$username','$_POST[name]','$file','$_POST[nic]','$_POST[faculty]','$_POST[status]','$_POST[religion]','$_POST[nationality]','$_POST[position]','$_POST[padd]','$_POST[cadd]','$_POST[guardian]','$_POST[boarding]','$_POST[payment]','$_POST[occupation]','$_POST[bursary]','$_POST[school]','$_POST[games]','$_POST[father]','$_POST[mother]','$_POST[brother]','$_POST[sister]','$_POST[vegi]','$_POST[home]','$_POST[inmates]','$_POST[rooms]','$_POST[floor]','$_POST[roof]','$_POST[lat]','$_POST[water]','$_POST[drinking]','$_POST[income]','$_POST[infection]','$_POST[worm]','$_POST[tropical]','$_POST[respiratory]','$_POST[circulatory]','$_POST[ent]','$_POST[eye]','$_POST[nervous]','$_POST[surgical]','$_POST[misc]','$_POST[immuzation]','$_POST[stress]','$_POST[complaints]','$_POST[onset]','$_POST[period]','$_POST[flow]','$_POST[pain]','$_POST[daynumber]')";
        $var = mysqli_query($conn, $sql3);
        if ($var) {
            echo '<script> alert("Your data submission is successfull!"); </script>';
        } else {
            echo '<script> alert("Oops! Something is wrong.Please try again."); </script>';
        }
    }
}
if (isset($_POST['send'])) {
    $sick = $_POST["sick"];
    $medi = $_POST["medi"];
    $date = date("Y/m/d");

    $sql = "INSERT INTO visited(username,sickness,medicine,date) VALUES('$username','$_POST[sick]','$_POST[medi]','$date')";
    mysqli_query($conn, $sql);
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Orbitron:400,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/details.css">
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Details</title>
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
                                    echo '<li class="active"><a href="profile_admin.php"><b>PROFILE</b></a></li>';
                                    echo '<li><a href="logout.php"><b>LOGOUT</b></a></li>';
                                    echo '<li><a href="about.php"><b>ABOUT US</b></a></li>';
                                    echo '<li><a href="services.php"><b>SERVICES</b></a></li>';
                                    echo '<li><a href="comments.php"><b>CONTACT</b></a></li>';
                                    echo '<li><a href="manage_admin.php"><b>MANAGE ADMIN</b></a></li>';
                                    echo '<li><a href="addUpdates.php"><b>ADD UPDATES</b></a></li>';
                                } else {
                                    echo '<li><a href="index.php"><b>HOME</b><span class="sr-only">(current)</span></a></li>';
                                    echo '<li><a href="profile_member.php"><b>PROFILE</b></a></li>';
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
                    <button id="myBtn" class="btn btn-default">Add Details</button><br><br>
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>

                            <form action="details.php?username=<?php echo urlencode($admin["username"]); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">

                                    <label>Full Name</label>
                                    <input type="text" placeholder="Full Name" name="name" class="form-control"><br>
                                    <label>Upload a profile picture</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                    <input type="file" name="file_upload" id="fileToUpload"><br>
                                    <label>NIC</label>
                                    <input type="text" placeholder="National Identity Card Number" name="nic" class="form-control"><br>
                                    <label>Faculty</label>
                                    <input type="text" placeholder="Faculty" name="faculty" class="form-control"><br>
                                    <label>Civil Status</label>
                                    <input type="text" placeholder="Civil Status" name="status" class="form-control"><br>
                                    <label>Religion</label>
                                    <input type="text" placeholder="Religion" name="religion" class="form-control"><br>
                                    <label>Nationality</label>
                                    <input type="text" placeholder="Nationality" name="nationality" class="form-control"><br>
                                    <label>Family Position</label>
                                    <input type="text" placeholder="Family Position" name="position" class="form-control"><br>
                                    <label>Permanent Address</label>
                                    <input type="text" placeholder="Permanent Address" name="padd" class="form-control"><br>
                                    <label>Current Address</label>
                                    <input type="text" placeholder="Current Address" name="cadd" class="form-control"><br>
                                    <label>Parent/Guardian</label>
                                    <input type="text" placeholder="Name of the Parent/Guardian" name="guardian" class="form-control"><br>
                                    <label>Boarding/Relative</label>
                                    <input type="text" placeholder="Boarding/Relative" name="boarding" class="form-control"><br>
                                    <label>Amount paid for month</label>
                                    <input type="text" placeholder="Amount paid for month" name="payment" class="form-control"><br>
                                    <label>Occupation Father/Mother</label>
                                    <input type="text" placeholder="Occupation Father/Mother" name="occupation" class="form-control"><br>
                                    <label>Are you getting bursary?</label>
                                    <input type="text" placeholder="Yes/No" name="bursary" class="form-control"><br>
                                    <label>Last School Attended</label>
                                    <input type="text" placeholder="Last School Attended" name="school" class="form-control"><br>
                                    <label>Games Played at School</label>
                                    <input type="text" placeholder="eg:Cricket, Volley Ball" name="games" class="form-control"><br>
                                    <label>Family Medical History</label><br><br>
                                    <label>Father's age(If dead enter the age at death and cause of death)</label>
                                    <input type="text" placeholder="Age(Reason)" name="father" class="form-control"><br>
                                    <label>Mother's age(If dead enter the age at death and cause of death)</label>
                                    <input type="text" placeholder="Age(Reason)" name="mother" class="form-control"><br>
                                    <label>Brother's age(If dead enter the age at death and cause of death)</label>
                                    <input type="text" placeholder="Age(Reason)" name="brother" class="form-control"><br>
                                    <label>Sister's age(If dead enter the age at death and cause of death)</label>
                                    <input type="text" placeholder="Age(Reason)" name="sister" class="form-control"><br>
                                    <label>Vegitarian/Non-vegitarian</label>
                                    <input type="text" placeholder="Vegitarian/Non-vegitarian" name="vegi" class="form-control"><br>
                                    <label>Living Condition(Home)</label>
                                    <input type="text" placeholder="Poor/Normal/Rich" name="home" class="form-control"><br>
                                    <label>Number of Inmates</label>
                                    <input type="text" placeholder="Family Members" name="inmates" class="form-control"><br>
                                    <label>Number of Rooms</label>
                                    <input type="text" placeholder="Number of Rooms at house" name="rooms" class="form-control"><br>
                                    <label>Floor</label>
                                    <input type="text" placeholder="Cement/Semi permanent" name="floor" class="form-control"><br>
                                    <label>Roof</label>
                                    <input type="text" placeholder="Permanent Yes/No" name="roof" class="form-control"><br>
                                    <label>Latring - water</label>
                                    <input type="text" placeholder="Carbiage/Pit/Bucket" name="lat" class="form-control"><br>
                                    <label>Water</label>
                                    <input type="text" placeholder="Pipe/Well/River" name="water" class="form-control"><br>
                                    <label>Drinking Water</label>
                                    <input type="text" placeholder="Boiled/ Unboiled" name="drinking" class="form-control"><br>
                                    <label>Income from all Sources</label>
                                    <select name="income" class="form-control">
                                        <option></option>
                                        <option value="Under Rs. 12,000.00 per year">Under Rs. 12,000.00 per year</option>
                                        <option value="Between Rs. 24,000.00 - Rs. 48,000.00 per year">Between Rs. 24,000.00 - Rs. 48,000.00 per year</option>
                                        <option value="Between Rs. 48,000.00 - Rs. 96,000.00 per year">Between Rs. 48,000.00 - Rs. 96,000.00 per year</option>
                                        <option value="Over Rs. 96,000.00 per year">Over Rs. 96,000.00 per year</option>
                                    </select>
                                    <br><br>
                                    <label>Previous medical history - Have you been suffered from any of the following?</label><br><br>
                                    <label>Infection Diseases</label>
                                    <input type="text" placeholder="Mumps,Measles,Poliomyelitis,Rubella,InfectiveHepatits,Chicken Pox,Small Pox,Whooping Cough,Tetanus,Diphtheria,Others" name="infection" class="form-control"><br>
                                    <label>Worm Infections</label>
                                    <input type="text" placeholder="Round Worm,Hook Worm,Thread Worm,Tape Worm,Filaria,Others" name="worm" class="form-control"><br>
                                    <label>Tropical Diseases</label>
                                    <input type="text" placeholder="Malaria,Amoebiodycentry,Bacillary Dycentry,Others" name="tropical" class="form-control"><br>
                                    <label>Respiratory</label>
                                    <input type="text" placeholder="Frequently Colds,May Fever,Bronchitis,Asthma,Pleurisy,Nemonta,T.D. Other" name="respiratory" class="form-control"><br>
                                    <label>Circulatory</label>
                                    <input type="text" placeholder="Heat Diseases,Blood Preasure" name="circulatory" class="form-control"><br>
                                    <label>E. N. T</label>
                                    <input type="text" placeholder="Ear Infection,Sinusitis,Tonsilitis,Adenoides,Others" name="ent" class="form-control"><br>
                                    <label>Eye</label>
                                    <input type="text" placeholder="Short sight,Long sight,Infections,Injuries,Others" name="eye" class="form-control"><br>
                                    <label>Nervous System</label>
                                    <input type="text" placeholder="Nervous Breakdown,Epilepsy,Migraine,Others" name="nervous" class="form-control"><br>
                                    <label>Surgical</label>
                                    <input type="text" placeholder="Factors,Injuries,Operations" name="surgical" class="form-control"><br>
                                    <label>Misc</label>
                                    <input type="text" placeholder="Anaemia,Nephritis,Diabetes,Skin Disorders,Indigestion,Others" name="misc" class="form-control"><br>
                                    <label>Immunizations</label>
                                    <input type="text" placeholder="Have you been vaccinated or Inoculated against Diphtheria,Tetanus,Whooping,Cough,Polio,Small Pox,Typhoid,T.B.(BCG)" name="immuzation" class="form-control"><br>
                                    <label>Stress</label>
                                    <input type="text" placeholder="Have you any problems concerning Exam,Financial,Social,Home,Sex,Studies,Sports" name="stress" class="form-control"><br>
                                    <label>Present Complaints</label>
                                    <input type="text" placeholder="If any" name="complaints" class="form-control"><br><br>
                                    <label>Menstrual History</label><br><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Age at Onset</label>
                                            <input type="text" placeholder="Age at Onset" name="onset" class="form-control"><br>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Period</label>
                                            <input type="text" placeholder="Regular/Irregular" name="period" class="form-control"><br>
                                            <label>Flow</label>
                                            <input type="text" placeholder="Sight/Normal/Excessive" name="flow" class="form-control"><br>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Pain</label>
                                            <input type="text" placeholder="Yes/No" name="pain" class="form-control"><br>
                                            <label>Number of Days</label>
                                            <input type="text" placeholder="Number of Days" name="daynumber" class="form-control"><br>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-default" name="submit" value="SUBMIT">
                                </div>
                            </form>
                        </div>

                    </div>
                    <button type="button" id="myBtn2" class="btn btn-default" data-toggle="modal" data-target="#myModal2">Show Details</button><br><br>
                    <div class="modal fade" id="myModal2" role="dialog">

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
                    <button type="button" id="myBtn3" class="btn btn-default" data-toggle="modal" data-target="#myModal3">Add More</button><br><br>
                    <div class="modal fade" id="myModal3" role="dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Visited Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <form action="details.php?username=<?php echo urlencode($admin["username"]); ?>" method="post">
                                        <label>Sickness</label>
                                        <input type="text" placeholder="Sickness" name="sick" class="form-control"><br>
                                        <label>Medicine</label>
                                        <input type="text" placeholder="Medicine" name="medi" class="form-control"><br>
                                        <input type="submit" name="send" class="btn btn-default" value="Submit">
                                    </form>
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
        <script type="text/javascript" src="js/details.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

    </body>
</html>