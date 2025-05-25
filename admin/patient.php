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
        
        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        
        body.dark-mode .container {
            background-color: #1e1e1e;
        }
        
        body.dark-mode .menu {
            background-color: #252525;
        }
        
        body.dark-mode .dash-body {
            background-color: #1e1e1e;
        }
        
        body.dark-mode .menu-text {
            color: #e0e0e0;
        }
        
        body.dark-mode .sub-table {
            background-color: #252525;
            color: #e0e0e0;
        }
        
        body.dark-mode .table-headin {
            background-color: #333;
            color: #e0e0e0;
        }
        
        body.dark-mode .popup {
            background-color: #252525;
            color: #e0e0e0;
        }
        
        body.dark-mode .input-text,
        body.dark-mode select,
        body.dark-mode textarea {
            background-color: #333;
            color: #e0e0e0;
            border-color: #444;
        }
        
        body.dark-mode .btn-primary {
            background-color: #0d6efd;
        }
        
        body.dark-mode .non-style-link {
            color: #e0e0e0;
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
        <td class="menu-btn menu-icon-doctor">
            <a href="doctors.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="material-symbols-outlined">supervised_user_circle</i>
                        Staff
                    </p>
                </div>
            </a>
        </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-appointment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">
                        <i class="custom-icon"><img src="../img/icons/appointment-icon.png" alt="Equipment Icon" style="opacity: 75%;"></i>
                        Appointment
                    </p>
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
            <a href="#" class="non-style-link-menu" onclick="toggleDarkMode(); return false;">
                <div>
                    <p class="menu-text"><i class="material-symbols-outlined">settings</i>Toggle Dark Mode</p>
                </div>
            </a>
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
                                    <!-- <i class="fa-solid fa-gift"></i>   -->
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
                <!--  <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td> -->
                <td>

                    <!--  <form action="" method="post" class="header-search">
 
                            <?php
                            // echo '<datalist id="patient">';
                            // $list11 = $database->query("select  pname,pemail from patient;");

                            // for ($y=0;$y<$list11->num_rows;$y++){
                            //  $row00=$list11->fetch_assoc();
                            //  $d=$row00["pname"];
                            //  $c=$row00["pemail"];
                            //  echo "<option value='$d'><br/>";
                            //  echo "<option value='$c'><br/>";
                            //};

                            // echo ' </datalist>';
                            ?>
                
                        </form>
                         -->
                </td>
                <!-- <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');

                            $date = date('Y-m-d');
                            echo $date;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
 -->

            </tr>


            <tr style="background: #dae1f3;">
                <?php $list11 = $database->query("select  fname,mname ,lname,pemail from patient;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                } ?>

                <td>
                    <p style="margin-left: 45px;font-size:18px;background: #dae1f3;margin:0px;padding: 12px;color: #444;">All Patients (<?php echo $list11->num_rows; ?>)</p>
                </td>


                <td>

                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="patient">';

                        $id = $row00["fname"] . " - " . $row00["mname"] . " - " . $row00["lname"];
                        $c = $row00["pemail"];
                        echo "<option value='$d'><br/>";
                        echo "<option value='$c'><br/>";

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                    </form>
                </td>
                <?php $list112 = $database->query("select  fname,mname ,lname,student_id from pending_patient;");
                for ($y = 0; $y < $list112->num_rows; $y++) {
                    $row00 = $list112->fetch_assoc();
                } 


                ?>




                <td style="background: #dae1f3; padding: 5px 30px; text-align: right;">
                    <a href="admin-dashboard.php" class="non-style-link" title="Pending Patients"
                        style="
         display: inline-flex;
         align-items: center;
         gap: 8px;
         background-color: #1877f2;  /* Facebook blue */
         color: white;
         padding: 8px 16px;
         border-radius: 12px;
         font-size: 16px;
         font-weight: 600;
         box-shadow: 0 4px 6px rgba(24, 119, 242, 0.3);
         text-decoration: none;
         position: relative;
       ">
                        <div style="position: relative;">
                            <i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"></i>
                            <?php if ($list112->num_rows > 0): ?>
                                <span style="
                    position: absolute;
                    top: -6px;
                    right: -10px;
                    background: #ff3b3b;
                    color: white;
                    font-size: 12px;
                    padding: 2px 6px;
                    border-radius: 50%;
                    font-weight: bold;
                    box-shadow: 0 0 4px rgba(0,0,0,0.3);
                ">
                                    <?php echo $list112->num_rows; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <span>Pending Patients</span>
                    </a>
                </td>




            </tr>
            <?php
            if ($_POST) {
                $keyword = $_POST["search"];

                $sqlmain = "select *, image from patient where pemail='$keyword' or fname='$keyword' or fname like '$keyword%' or fname like '%$keyword' or fname like '%$keyword%' ";
            } else {
                $sqlmain = "select *, image from patient order by pid desc";
            }



            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Profile
                                        </th>
                                        <th class="table-headin">
                                            Name
                                        </th>
                                        <th class="table-headin">
                                            Student ID
                                        </th>
                                        <th class="table-headin">
                                            Course
                                        </th>
                                        <th class="table-headin">
                                            Date of Birth
                                        </th>
                                        <th class="table-headin">
                                            Action
                                        </th>
                                    </tr>

                                </thead>
                                <tbody class="data">

                                    <?php


                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="6">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.png" width="30%">
                                    
                                    <br>
                                    <p class="heading-main12"font-size:20px;color:rgb(49, 49, 49)">No patient, no problem — ready for anything.</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $pid = $row["pid"];
                                            $fname = $row["fname"];
                                            $mname = $row["mname"];
                                            $lname = $row["lname"];
                                            $email = $row["pemail"];
                                            $pbarangay = $row["pbarangay"];
                                            $pcity = $row["pcity"];
                                            $pprovince = $row["pprovince"];
                                            $student_id = $row["student_id"];
                                            $dob = $row["pdob"];
                                            $tel = $row["ptel"];
                                            
                                            // Check if image exists and provide fallback to default
                                            if (!empty($row["image"]) && file_exists("../uploads/patients/" . $row["image"])) {
                                                $imagePath = "../uploads/patients/" . $row["image"];
                                            } else {
                                                // Use a placeholder image from a public CDN
                                                $imagePath = "https://ui-avatars.com/api/?name=" . urlencode($fname . "+" . $lname) . "&background=random&color=fff&size=128";
                                            }

                                            echo '<tr>
                                        <td style="text-align: center; padding: 10px;">
                                            <img src="' . $imagePath . '" alt="Profile" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">
                                        </td>
                                        <td> &nbsp;'
                                                . substr($lname, 0, 35) . ', '
                                                . substr($fname, 0, 35) . ' '
                                                . substr($mname, 0, 35) .
                                                '</td>
                                        <td>
                                            ' . substr($student_id, 0, 10) . '
                                        </td>
                                        <td>
                                            ' . (isset($row["course"]) ? substr($row["course"], 0, 10) : 'N/A') . '
                                        </td>
                                        <td>
                                        ' . substr($dob, 0, 20) . '
                                         </td>
                                        
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                      <a href="?action=view&id=' . $pid . '" class="non-style-link badge badge-solid-green">
                                            View</a>
                                       
                                        <a href="?action=create-appointment&id=' . $pid . '" class="non-style-link badge badge-solid-blue" style="margin-left: 10px;">
                                            Create Appointment</a>
                                        </div>
                                        </td>
                                    </tr>';
                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>
    <?php
    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        
        if($action == 'create-appointment') {
            $sqlmain = "select * from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $mname = $row["mname"];
            $lname = $row["lname"];
            $email = $row["pemail"];
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Create New Appointment</h2>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">
                            <form action="add-appointment.php" method="POST" class="add-new-form">
                                <input type="hidden" name="pid" value="'.$id.'">
                                <input type="hidden" name="pname" value="'.$lname.', '.$fname.' '.$mname.'">
                                
                                <div class="form-group">
                                    <label for="docid">Select Doctor:</label>
                                    <select name="docid" id="docid" class="box" required>
                                        <option value="" disabled selected>Choose Doctor</option>';
                                        
                                        $list11 = $database->query("select * from doctor order by docname asc");
                                        for ($y=0; $y<$list11->num_rows; $y++) {
                                            $row00 = $list11->fetch_assoc();
                                            $sn = $row00["docname"];
                                            $id00 = $row00["docid"];
                                            echo "<option value='$id00'>$sn</option>";
                                        }
                                        
                                    echo '</select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="appodate">Appointment Date:</label>
                                    <input type="date" name="appodate" id="appodate" class="input-text" min="'.date('Y-m-d').'" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="appotime">Appointment Time:</label>
                                    <input type="time" name="appotime" id="appotime" class="input-text" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="reason">Reason for Visit:</label>
                                    <textarea name="reason" id="reason" class="input-text" rows="3" required></textarea>
                                </div>
                                
                                <div style="display: flex;justify-content: center;margin-top: 20px;">
                                    <input type="submit" value="Schedule Appointment" class="login-btn btn-primary btn">
                                </div>
                            </form>
                        </div>
                    </center>
            </div>
            </div>';
        } else if ($action == 'view') {
    $sqlmain = "SELECT * FROM patient WHERE pid='$id'";
    $result = $database->query($sqlmain);

    if ($result && $result->num_rows > 0) {
        $patient = $result->fetch_assoc();

        // Escape all output to avoid XSS
        $fname = htmlspecialchars($patient["fname"]);
        $mname = htmlspecialchars($patient["mname"]);
        $lname = htmlspecialchars($patient["lname"]);
        $email = htmlspecialchars($patient["pemail"]);
        $pbarangay = htmlspecialchars($patient["pbarangay"]);
        $pcity = htmlspecialchars($patient["pcity"]);
        $pprovince = htmlspecialchars($patient["pprovince"]);
        $student_id = htmlspecialchars($patient["student_id"]);
        $dob = htmlspecialchars($patient["pdob"]);
        $tel = htmlspecialchars($patient["ptel"]);

        // Image path with fallback
        if (!empty($patient['image']) && file_exists('../uploads/patients/' . $patient['image'])) {
            $imagePath = '../uploads/patients/' . htmlspecialchars($patient['image']);
        } else {
            // Use a placeholder image from a public CDN
            $imagePath = "https://ui-avatars.com/api/?name=" . urlencode($fname . "+" . $lname) . "&background=random&color=fff&size=128";
        }

        // Success message if medicine was added
        $successMessage = '';
        if (isset($_GET['status']) && $_GET['status'] == 'medicine_added') {
            $successMessage = '<div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                Medicine added successfully!
            </div>';
        }

        // Error message if there was an error
        $errorMessage = '';
        if (isset($_GET['error'])) {
            $errorMessage = '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                Error: ' . htmlspecialchars($_GET['error']) . '
            </div>';
        }

        echo '
        <div id="popup1" class="overlay" style="
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        ">
            <div class="popup" style="
                background: #fff;
                border-radius: 10px;
                width: 90%;
                max-width: 700px;
                max-height: 85vh;
                display: flex;
                flex-direction: column;
                box-shadow: 0 0 15px rgba(0,0,0,0.3);
                position: relative;
                overflow: hidden;
                font-family: Arial, sans-serif;
                color: #333;
            ">
                <a class="close" href="patient.php" style="
                    position: absolute;
                    top: 15px;
                    right: 20px;
                    font-size: 28px;
                    text-decoration: none;
                    color: #aaa;
                    z-index: 10;
                ">&times;</a>
                <h2 style="text-align:center; margin: 20px 0 10px;">Patient Details</h2>

                <div class="content" style="
                    padding: 0 20px 20px 20px;
                    overflow-y: auto;
                    flex: 1;
                ">
                    ' . $successMessage . '
                    ' . $errorMessage . '
                    <div style="display: flex; align-items: flex-start; gap: 25px; margin-bottom: 25px;">
                        <div style="flex: 1; font-size: 15px; line-height: 1.5;">
                            <p><strong>Full Name:</strong> ' . $fname . ' ' . $mname . ' ' . $lname . '</p>
                            <p><strong>Student ID:</strong> ' . $student_id . '</p>
                            <p><strong>Course:</strong> ' . (isset($patient['course']) ? $patient['course'] : 'Not specified') . '</p>
                            <p><strong>Email:</strong> ' . $email . '</p>
                            <p><strong>Date of Birth:</strong> ' . $dob . '</p>
                            <p><strong>Contact Number:</strong> ' . $tel . '</p>
                            <p><strong>Address:</strong> ' . $pbarangay . ', ' . $pcity . ', ' . $pprovince . '</p>
                        </div>
                        <div style="flex-shrink: 0; width: 220px; height: 220px; border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">
                            <img src="' . $imagePath . '" alt="Patient Image" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>

            <!-- Medicine History Table -->
            <h3 style="margin-bottom: 15px; border-bottom: 2px solid #007BFF; padding-bottom: 5px;">Medicine History</h3>
            <div class="abc scroll" style="max-height: 220px; overflow-y: auto; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 20px;">
                <table width="100%" class="sub-table scrolldown" border="0" cellspacing="0" cellpadding="8" style="border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f0f8ff;">
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Medicine</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Dosage</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Instructions</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Date Given</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Appointment</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Fixed query - now using pid instead of appoid
    $histq = $database->query("
        SELECT h.*, DATE_FORMAT(a.appodate, '%Y-%m-%d') as appointment_date, a.apponum
        FROM history h 
        LEFT JOIN appointment a ON h.appoid = a.appoid 
        WHERE h.pid = '$id'
        ORDER BY h.date_given DESC
    ");
    
    if ($histq->num_rows == 0) {
        echo '<tr><td colspan="5" style="text-align: center; padding: 15px;">No medicine history found for this patient</td></tr>';
    } else {
        while($hist = $histq->fetch_assoc()) {
            echo '<tr style="border-bottom: 1px solid #eee;">
                    <td>'.htmlspecialchars($hist['medicine']).'</td>
                    <td>'.htmlspecialchars($hist['dosage']).'</td>
                    <td>'.htmlspecialchars($hist['instructions']).'</td>
                    <td>'.htmlspecialchars($hist['date_given']).'</td>
                    <td>'.htmlspecialchars((!empty($hist['appointment_date']) ? $hist['appointment_date'] . ' (#' . $hist['apponum'] . ')' : 'Unknown')).'</td>
                </tr>';
        }
    }
    echo '
                    </tbody>
                </table>
            </div>

            <!-- Add Medicine Form -->
            <div class="add-medicine-section">
            <h4 style="margin-top: 10px; margin-bottom: 12px;">Add Medicine to History</h4>
            <form action="add-history.php" method="POST" class="add-new-form" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
                <input type="hidden" name="pid" value="'.htmlspecialchars($id).'">
                
                <label for="appoid" style="flex: 1 1 200px; min-width: 180px;">Appointment:<br>
                    <select name="appoid" id="appoid" required style="width: 100%; padding: 6px; margin-top: 4px;">
                        <option value="" disabled selected>Select Appointment</option>';

    // Get patient's appointments
    $appQuery = $database->query("SELECT * FROM appointment WHERE pid='$id' ORDER BY appodate DESC");
    if ($appQuery->num_rows > 0) {
        while($app = $appQuery->fetch_assoc()) {
            echo '<option value="'.htmlspecialchars($app['appoid']).'">'.
                htmlspecialchars(date('Y-m-d', strtotime($app['appodate']))).' (#'.htmlspecialchars($app['apponum']).')'.
                '</option>';
        }
    }
    echo '
                    </select>
                </label>
                
                <label for="medicine" style="flex: 1 1 200px; min-width: 180px;">Medicine:<br>
                    <select name="medicine" id="medicine" required style="width: 100%; padding: 6px; margin-top: 4px;">
                        <option value="" disabled selected>Select Medicine</option>';

    $medlist = $database->query("SELECT * FROM medicine ORDER BY brand ASC");
    while($med = $medlist->fetch_assoc()) {
        $brand = htmlspecialchars($med['brand']);
        echo '<option value="'.$brand.'">'.$brand.'</option>';
    }
    echo '
                    </select>
                </label>
                <label for="dosage" style="flex: 1 1 150px; min-width: 140px;">Dosage:<br>
                    <input type="text" name="dosage" id="dosage" placeholder="Dosage" required style="width: 100%; padding: 6px; margin-top: 4px;">
                </label>
                <label for="instructions" style="flex: 1 1 250px; min-width: 200px;">Instructions:<br>
                    <input type="text" name="instructions" id="instructions" placeholder="Instructions" required style="width: 100%; padding: 6px; margin-top: 4px;">
                </label>
                <div style="flex: 0 0 auto; margin-top: 24px;">
                    <button type="submit" class="btn-primary btn" style="padding: 8px 18px; cursor: pointer;">Add Medicine</button>
                </div>
            </form>
            </div>

            <!-- Medical Certificate Section -->
            <h4 style="margin-top: 40px; margin-bottom: 12px;">Medical Certificate Details</h4>
            <form id="medcert-details-form" style="margin-bottom: 20px;">
                <textarea name="cert_reason" rows="3" style="width: 100%; padding: 8px; font-size: 14px; resize: vertical; margin-bottom: 12px;" placeholder="Reason for certificate (doctor input)"></textarea>
                <textarea name="cert_validity" rows="1" style="width: 100%; padding: 8px; font-size: 14px; resize: vertical;" placeholder="Validity period (e.g. 7 days)"></textarea>
            </form>

           

            <div style="text-align: center;">
             <button onclick="printPopup()" class="btn-primary btn" style="padding: 10px 22px; margin-bottom: 25px; cursor: pointer;">Print Medical Certificate</button>
                <a href="delete-appointment.php?id='.$id.'" class="btn-danger btn" style="display: inline-block; padding: 10px 24px; background: #dc3545; color: #fff; border-radius: 5px; text-decoration: none; font-weight: 600;">Remove Appointment</a>
            </div>
        </div>
    </div>
</div>';

/* PRINT STYLES - expand all scrollable content and center popup on page */
echo '<style>
@media print {
    body * {
        visibility: hidden !important;
    }
    .popup, .popup * {
        visibility: visible !important;
    }
    .popup {
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: 90% !important;
        max-width: none !important;
        max-height: none !important;
        height: auto !important;
        overflow: visible !important;
        background: #fff !important;
        box-shadow: none !important;
        padding: 20px !important;
        font-size: 14pt !important;
        color: #000 !important;
        border-radius: 0 !important;
        display: block !important;
    }
    .popup .content {
        overflow: visible !important;
        max-height: none !important;
        height: auto !important;
    }
    .abc.scroll {
        overflow: visible !important;
        max-height: none !important;
        height: auto !important;
    }
    
    /* Hide buttons and navigation elements */
    .close, .btn-danger, .btn-primary {
        display: none !important;
    }
    
    /* Specifically hide Add Medicine section */
    .add-medicine-section {
        display: none !important;
    }
    
    /* Clean format for printing */
    #medcert-details-form {
        margin-top: 30px !important;
        border-top: 1px solid #ccc !important;
        padding-top: 20px !important;
    }
    
    #medcert-details-form textarea {
        border: none !important;
        font-size: 14pt !important;
        font-family: inherit !important;
        padding: 0 !important;
        resize: none !important;
        background: transparent !important;
    }
    
    /* Format for the certificate details */
    .certificate-section {
        margin-top: 30px !important;
        text-align: left !important;
    }
    
    /* Clean table format */
    table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-bottom: 20px !important;
    }
    
    th, td {
        padding: 8px !important;
        text-align: left !important;
        border-bottom: 1px solid #ddd !important;
    }
    
    th {
        font-weight: bold !important;
    }
}
</style>';

/* Print function */
echo '<script>function printPopup() { window.print(); }</script>';

        } else if($action == 'drop' && isset($_GET['id'])) {
            $id = $_GET['id'];
            if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                // Delete related history and appointments
                $database->query("DELETE FROM history WHERE pid='$id'");
                $database->query("DELETE FROM appointment WHERE pid='$id'");
                $database->query("DELETE FROM patient WHERE pid='$id'");
                header("location: patient.php?status=deleted");
                exit();
            } else {
                // Show confirmation popup
                echo '<div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                            <h2>Are you sure you want to delete this patient?</h2>
                            <a class="close" href="patient.php">&times;</a>
                            <div class="content"></div>
                            <div style="display: flex;justify-content: center;">
                                <a href="patient.php?action=drop&id='.$id.'&confirm=yes" class="btn-danger btn" style="margin-right: 10px;">Yes, Delete</a>
                                <a href="patient.php" class="btn-primary btn">Cancel</a>
                            </div>
                        </center>
                    </div>
                    </div>';
                exit();
            }
        }
    }}  

    ?>
    </div>
    <script>
        // Function to toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            
            // Save preference to localStorage
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        }
        
        // Check if dark mode was previously enabled
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
</body>

</html>