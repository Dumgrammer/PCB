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
                } ?>




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

                $sqlmain = "select * from patient where pemail='$keyword' or fname='$keyword' or fname like '$keyword%' or fname like '%$keyword' or fname like '%$keyword%' ";
            } else {
                $sqlmain = "select * from patient order by pid desc";
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

                                            Name


                                        </th>
                                        <th class="table-headin">


                                            Student ID

                                        </th>
                                        <th class="table-headin">


                                            Date of Birth

                                        </th>
                                        <th class="table-headin">

                                            Action

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

                                            echo '<tr>
                                        <td> &nbsp;'
                                                . substr($lname, 0, 35) . ', '
                                                . substr($fname, 0, 35) . ' '
                                                . substr($mname, 0, 35) .
                                                '</td>
                                        <td>
                                            ' . substr($student_id, 0, 10) . '
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
        } else if($action == 'view') {
            $sqlmain = "select * from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
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
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">
                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Patient Details.</p><br><br>
                            <h3>Medicine History</h3>';
            $histq = $database->query("SELECT h.*, a.apponum FROM history h LEFT JOIN appointment a ON h.appoid = a.appoid WHERE h.pid='$id' ORDER BY h.date_given DESC");
            echo '<div class="abc scroll">';
            echo '<table width="90%" class="sub-table scrolldown" border="0">';
            echo '<thead><tr>';
            echo '<th class="table-headin">Appointment #</th>';
            echo '<th class="table-headin">Medicine</th>';
            echo '<th class="table-headin">Dosage</th>';
            echo '<th class="table-headin">Instructions</th>';
            echo '<th class="table-headin">Date Given</th>';
            echo '</tr></thead>';
            echo '<tbody>';
            if ($histq->num_rows == 0) {
                echo '<tr><td colspan="5" style="text-align: center;">No medicine history found</td></tr>';
            } else {
                while($hist = $histq->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>'.htmlspecialchars($hist['apponum']).'</td>';
                    echo '<td>'.htmlspecialchars($hist['medicine']).'</td>';
                    echo '<td>'.htmlspecialchars($hist['dosage']).'</td>';
                    echo '<td>'.htmlspecialchars($hist['instructions']).'</td>';
                    echo '<td>'.htmlspecialchars($hist['date_given']).'</td>';
                    echo '</tr>';
                }
            }
            echo '</tbody></table></div><br>';
            echo '<div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                
                                <tr>
                                    <td>
                                        <label for="name" class="form-label">Name: </label>
                                    </td>
                                    <td>
                                        ' . $lname . ', ' . $fname . '  ' . $mname . ' <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="pdob" class="form-label">Date of Birth: </label>
                                    </td>
                                    <td>
                                    ' . $dob . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="ptel" class="form-label">Mobile Phone Number: </label>
                                    </td>
                                    <td>
                                    ' . $tel . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="student_id" class="form-label">Student ID: </label>
                                    </td>
                                    <td>
                                    ' . $student_id . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="" class="form-label">Email Address: </label>
                                        
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                 ' . $email . '<br><br>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="" class="form-label">Address: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ' . $pbarangay . ',  ' . $pcity . ', ' . $pprovince . '<br><br>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>

                                    <button type="button" class="login-btn btn-primary-soft btn" onclick="window.print();">
                                            Print
                                        </button>
                                        <a href="patient.php?action=drop&id='.$id.'" class="login-btn btn-danger btn" style="margin-left: 10px;">Delete Patient</a>
                                    </td>
                
                                </tr>
                                
                            </table>
                            </div>
                            <br><br>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
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
    }

    ?>
    </div>
</body>

</html>