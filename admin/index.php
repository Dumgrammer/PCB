<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="GinaFAcuna">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">

    <link rel="icon" href="../img/PCB.png">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>PCB CLINIC</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }


        .menu img {
            width: 70%;
            padding: 10%;
        }


        .card {

            background-image: url(../img/bgdash.jpg);
            background-size: cover;

        }

        .menu-text {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .menu-text i.material-symbols-outlined {
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-text i.custom-icon img {
            width: 24px;
            height: 24px;
            display: block;
            object-fit: contain;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }


    //import database
    include("../connection.php");


    ?>
    <div class="container">

        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td>
                        <table border="0" class="profile-container">
                            <tr>
                                <td>
                                    <img src="../img/PCB.png" alt="">
                                </td>

                            </tr>

                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">

                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">
                                    <i class="material-symbols-outlined"> dashboard</i>
                                    Dashboard
                                </p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-medicine">
                <a href="medicine.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text"><i class="material-symbols-outlined"> <img src="../img/icons/medicine-icon.png" style="width: 28px;
                            opacity: 70%;"></i>Medicine</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-equipment">
            <a href="equipment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="custom-icon"><img src="../img/icons/equipment-icon.png" alt="Equipment Icon" style="opacity: 75%;"></i>
                        Equipment
                    </p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">description</i>Appointment</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">face</i>Patients</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings   ">
            <a href="#" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">settings</i>Settings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="../logout.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">power_settings_new</i>Logout</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>
                <!--  <td>
          <marquee behavior="scroll" direction="left" scrollamount="4"><p style="color: blue;">
                KAMUSTA ANG BUHAY BUHAY </p>
            </marquee> 
                                </td> -->
                <td colspan="2" class="nav" style="float: right;">

                    <div class="header-content">

                        <nav class="navbar navbar-expand">
                            <div class="collapse navbar-collapse justify-content-between">
                                <div class="header-left">
                                    <div class="dashboard_bar" style="text-transform: capitalize;"></div>
                                </div>
                                <ul class="navbar-nav header-right">
                                    <li>
                                        <!-- <i class="fa-regular fa-bell"></i> -->
                                    </li>
                                    <li> <!-- <i class="fa-regular fa-message"></i> --></li>
                                    <li>
                                        <!-- <i class="fa-solid fa-gift"></i>  -->
                                    </li>

                                    <?php
                                    $email = $_SESSION['user'];
                                    $query = "SELECT * FROM admin WHERE aemail = '$email'";
                                    $result = $database->query($query);

                                    if ($result && $result->num_rows == 1) {
                                        $admin = $result->fetch_assoc();
                                        $aname = $admin['aname']; // Replace this with actual name column if available
                                        $aemail = $admin['aemail'];
                                    } else {
                                        $aname = "Unknown";
                                        $aemail = "No email";
                                    }
                                    ?>

                                    <div class="profile dropdown">
                                        <img src="../img/profile.png" width="45px">
                                        <div class="toggel">
                                            <span><?= htmlspecialchars($aname) ?></span><br>
                                            <span><?= htmlspecialchars($aemail) ?></span>
                                        </div>
                                    </div>


                                </ul>
                            </div>
                        </nav>
                    </div>
    </div>
    </div>

    </li>

    </ul>
    </div>
    </nav>
    </div>

    <!--  <form action="doctors.php" method="post" class="header-search">

                <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;
                <?php
                echo '<datalist id="doctors">';
                $list11 = $database->query("select  docname,docemail from  doctor;");

                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $d = $row00["docname"];
                    $c = $row00["docemail"];
                    echo "<option value='$d'><br/>";
                    echo "<option value='$c'><br/>";
                };

                echo ' </datalist>';
                ?>
                                    <input type="Submit" value="Search" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                
                                </form> -->

    </td>

    <!--  <?php
            date_default_timezone_set('Asia/Kolkata');

            $today = date('Y-m-d');
            echo $today;


            $patientrow = $database->query("select  * from  patient;");
            $doctorrow = $database->query("select  * from  doctor;");
            $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
            $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


            ?> -->



    </tr>

    <td colspan="4">

        <center>
            <table class="filter-container" style="border: none;" border="0">


                <div class="card">
                    <div class="body">

                        <div class="cards" style="float:left;">
                            <img src="../img/card.png" alt="">
                        </div>

                        <div class="head">
                            <h4 class="font-20 weight-500 mb-2">
                                MISSION
                            </h4>
                            <p>WE WILL ENRICH,EDUCATE AND ENLIGHTEN POLYTECHNIC COLLEGE OF BOTOLAN (PCB) STUDENT THROUGH PROVIDING ACCESSIBLE HEALTH CARE,PROMOTING PREVENTION AND PARTNERING WITH PARENTS AND STAFF TO ENABLE STUDENTS TO PERFORM AT THEIR PERSONAL BEST.
                            </p>
                            <mark>

                        </div>

                        <div class="head">
                            <h4 class="font-20 weight-500 mb-2">
                                VISION
                            </h4>
                            <p>POLYTECHNIC COLLEGE OF BOTOLAN (PCB) WILL BE HEALTHY AND SAFE WHILE ACHIEVING ACADEMIC SUCCESS.
                            </p>
                            <mark>

                        </div>

                    </div>
                </div>


                <tr>
                    <td style="width: 25%;">
                        <div class="dashboard-items bg-danger" style="padding:20px;margin:auto;width:95%;display: flex">
                            <div>

                                <div class="h3-dashboard">
                                    Nurse &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div> <br>
                                <div class="h1-dashboard">
                                    <?php echo $doctorrow->num_rows  ?>
                                </div>
                            </div>
                            <div class=" dashboard-icons">
                                <i class="fa fa-user-md"></i>
                            </div>
                    </td>

                    <td style="width: 25%;">
                        <div class="dashboard-items bg-success" style="padding:20px;margin:auto;width:95%;display: flex;">
                            <div>
                                <div class="h3-dashboard">
                                    Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div><br>
                                <div class="h1-dashboard">
                                    <?php echo $patientrow->num_rows  ?>
                                </div>

                            </div>
                            <!--  <div class="dashboard-icons">
                                    <i class="fa fa-wheelchair"></i>
                                </div>
                    </div>
                </td>

                 <td style="width: 25%;">
                    <div  class="dashboard-items bg-info"  style="padding:20px;margin:auto;width:95%;display: flex;">
                        <div>
                             <div class="h3-dashboard">
                                   Booking &nbsp;&nbsp;
                                </div><br>
                                <div class="h1-dashboard">
                                   <?php echo $appointmentrow->num_rows  ?>
                                </div> -->

                        </div>
</body>

</html>