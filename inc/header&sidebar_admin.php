<?php
session_start();
if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
        header("location: ../login.php");
    }
}else{
    header("location: ../login.php");
}

include("../connection.php");
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                                    <i class="material-symbols-outlined">dashboard</i>
                                    Dashboard
                                </p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-medicine">
                        <a href="medicine.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">
                                    <i class="material-symbols-outlined">
                                        <img src="../img/icons/medicine-icon.png" style="width: 28px; opacity: 70%;">
                                    </i>
                                    Medicine
                                </p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-equipment">
                        <a href="equipment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">
                                    <i class="custom-icon">
                                        <img src="../img/icons/equipment-icon.png" alt="Equipment Icon" style="opacity: 75%;">
                                    </i>
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
                                    <i class="custom-icon">
                                        <img src="../img/icons/appointment-icon.png" alt="Appointment Icon" style="opacity: 75%;">
                                    </i>
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
                                <p class="menu-text">
                                    <i class="material-symbols-outlined">face</i>
                                    Patients
                                </p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="#" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">
                                    <i class="material-symbols-outlined">settings</i>
                                    Settings
                                </p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="../logout.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">
                                    <i class="material-symbols-outlined">power_settings_new</i>
                                    Logout
                                </p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <div class="header-content">
                        <nav class="navbar navbar-expand">
                            <div class="collapse navbar-collapse justify-content-between">
                                <div class="header-left">
                                    <div class="dashboard_bar" style="text-transform: capitalize;"></div>
                                </div>
                                <ul class="navbar-nav header-right">
                                    <?php
                                    $email = $_SESSION['user'];
                                    $query = "SELECT * FROM admin WHERE aemail = '$email'";
                                    $result = $database->query($query);

                                    if ($result && $result->num_rows == 1) {
                                        $admin = $result->fetch_assoc();
                                        $aname = $admin['aname'];
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
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
         