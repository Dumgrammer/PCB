<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

// Add medicine to history handler (must be before any HTML or action handling)
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['appoid']) &&
    isset($_POST['pid']) &&
    isset($_POST['medicine']) &&
    isset($_POST['dosage']) &&
    isset($_POST['instructions'])
) {
    $appoid = $_POST['appoid'];
    $pid = $_POST['pid'];
    $medicine = $_POST['medicine'];
    $dosage = $_POST['dosage'];
    $instructions = $_POST['instructions'];
    $sql = "INSERT INTO history (appoid, pid, medicine, dosage, instructions, date_given) VALUES ('$appoid', '$pid', '$medicine', '$dosage', '$instructions', NOW())";
    if ($database->query($sql)) {
        header("Location: appointment.php?action=view&id=$appoid&status=success");
    } else {
        header("Location: appointment.php?action=view&id=$appoid&error=" . urlencode($database->error));
    }
    exit;
}

// Delete appointment handler
if (isset($_GET['action']) && $_GET['action'] == 'drop' && isset($_GET['id'])) {
    $appoid = $_GET['id'];
    // Optionally, delete related history records
    $database->query("DELETE FROM history WHERE appoid='$appoid'");
    $database->query("DELETE FROM appointment WHERE appoid='$appoid'");
    header("Location: appointment.php?status=deleted");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Admin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/PCB.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Appointments</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .menu {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            float: left;
            box-shadow: 2px 0 8px rgba(0,0,0,0.05);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 10;
        }
        .container {
            display: flex;
        }
        .dash-body {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <?php include("../inc/header&sidebar_admin.php"); ?>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <td colspan="2" class="nav" >
                        <div class="header-content">
                            <nav class="navbar navbar-expand">
                                <div class="collapse navbar-collapse justify-content-between">
                                    <div class="header-left">
                                        <div class="dashboard_bar" style="text-transform: capitalize;"></div>
                                    </div>
                                    <ul class="navbar-nav header-right">
                                        <li>
                                            <i class="fa-regular fa-bell"></i>
                                        </li>
                                        <li> <i class="fa-regular fa-message"></i></li>
                                        <li>
                                            <i class="fa-solid fa-gift"></i>    
                                        </li>
                                        <li>
                                            <div class="profile dropdown">
                                                <img src="../img/profile.png" width="45px">
                                                <div class="toggel">
                                                    <span style=""><?php echo htmlspecialchars($_SESSION['user']); ?></span><br>
                                                    <span style="">
                                                        <?php echo htmlspecialchars($_SESSION['user']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;background: #dae1f3;margin:0px;padding: 12px;color: #444;">Appointment Manager</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="width: 100%;background: #dae1f3; margin:0 ;">
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                            <td width="10%"></td> 
                            <td width="5%" style="text-align: center;">Date:</td>
                            <td width="30%">
                                <form action="" method="post">
                                    <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">
                            </td>
                        </tr>
                        </table>
                        </center>
                    </td>
                </tr>
                <?php
                $sqlmain= "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,CONCAT(patient.fname, ' ', patient.lname) AS pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid order by schedule.scheduledate desc";
                if($_POST){
                    if(!empty($_POST["sheduledate"])){
                        $sheduledate=$_POST["sheduledate"];
                        $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,CONCAT(patient.fname, ' ', patient.lname) AS pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate='$sheduledate' order by schedule.scheduledate desc";
                    }
                }
                ?>
                <tr>
                    <td colspan="4">
                        <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                            <th class="table-headin">Patient name</th>
                            <th class="table-headin">Appointment number</th>
                            <th class="table-headin">Doctor</th>
                            <th class="table-headin">Session Title</th>
                            <th class="table-headin">Session Date & Time</th>
                            <th class="table-headin">Appointment Date</th>
                            <th class="table-headin">Events</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result= $database->query($sqlmain);
                        if($result->num_rows==0){
                            echo '<tr><td colspan="7"><br><br><br><br><center><img src="../img/notfound.png" width="25%"><br><p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p><a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button></a></center><br><br><br><br></td></tr>';
                        } else {
                            for ( $x=0; $x<$result->num_rows;$x++){
                                $row=$result->fetch_assoc();
                                $appoid=$row["appoid"];
                                $scheduleid=$row["scheduleid"];
                                $title=$row["title"];
                                $docname=$row["docname"];
                                $scheduledate=$row["scheduledate"];
                                $scheduletime=$row["scheduletime"];
                                $pname=$row["pname"];
                                $apponum=$row["apponum"];
                                $appodate=$row["appodate"];
                                echo '<tr >
                                    <td style="font-weight:600;"> &nbsp;'.substr($pname,0,25).'</td >
                                    <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">'.$apponum.'</td>
                                    <td>'.substr($docname,0,25).'</td>
                                    <td>'.substr($title,0,15).'</td>
                                    <td style="text-align:center;;">'.substr($scheduledate,0,10).' @'.substr($scheduletime,0,5).'</td>
                                    <td style="text-align:center;">'.$appodate.'</td>
                                    <td><div style="display:flex;justify-content: center;">'
                                    .'<a href="?action=view&id='.$appoid.'" class="non-style-link badge badge-solid-green">View</a>'
                                    .'&nbsp;&nbsp;&nbsp;'
                                    .'&nbsp;&nbsp;&nbsp;'
                                    .'<a href="?action=drop&id='.$appoid.'&name='.$pname.'&session='.$title.'&apponum='.$apponum.'" class="non-style-link badge badge-solid-red">Remove</a>'
                                    .'&nbsp;&nbsp;&nbsp;</div></td>
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
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='add-session'){

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                    
                        <a class="close" href="schedule.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                   ""
                                
                                .'</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="title" class="form-label">Session Title : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="docid" class="form-label">Select Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="docid" id="" class="box" >
                                    <option value="" disabled selected hidden>Choose Doctor Name from the list</option><br/>';
                                        
        
                                        $list11 = $database->query("select  * from  doctor;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["docname"];
                                            $id00=$row00["docid"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
        
        
        
                                        
                        echo     '       </select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nop" class="form-label">Number of Patients/Appointment Numbers : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="nop" class="input-text" min="0"  placeholder="The final appointment number for this session depends on this number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Session Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="date" class="input-text" min="'.date('Y-m-d').'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Schedule Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="time" name="time" class="input-text" placeholder="Time" required><br>
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='session-added'){
            $titleget=$_GET["title"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Session Placed.</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                        '.substr($titleget,0,40).' was scheduled.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
            $nameget=$_GET["name"];
            $session=$_GET["session"];
            $apponum=$_GET["apponum"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Patient Name: &nbsp;<b>'.substr($nameget,0,40).'</b><br>
                            Appointment number &nbsp; : <b>'.substr($apponum,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif($action=='view'){
            // Fetch appointment details
            $appq = $database->query("SELECT * FROM appointment WHERE appoid='$id'");
            $app = $appq->fetch_assoc();
            $pid = $app['pid'];
            $pquery = $database->query("SELECT * FROM patient WHERE pid='$pid'");
            $patient = $pquery->fetch_assoc();
            
            // Success message if medicine was added
            $successMessage = '';
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
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
            
            echo '<div id="popup1" class="overlay" style="
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
                    <a class="close" href="appointment.php" style="
                        position: absolute;
                        top: 15px;
                        right: 20px;
                        font-size: 28px;
                        text-decoration: none;
                        color: #aaa;
                        z-index: 10;
                    ">&times;</a>
                    <h2 style="text-align:center; margin: 20px 0 10px;">Appointment Details</h2>

                    <div class="content" style="
                        padding: 0 20px 20px 20px;
                        overflow-y: auto;
                        flex: 1;
                    ">';
                    
                    // Check if patient has an image and display it
                    if (!empty($patient['image']) && file_exists('../uploads/patients/' . $patient['image'])) {
                        $imagePath = '../uploads/patients/' . htmlspecialchars($patient['image']);
                    } else {
                        // Use a placeholder image from a public CDN
                        $imagePath = "https://ui-avatars.com/api/?name=" . urlencode($patient['fname'] . "+" . $patient['lname']) . "&background=random&color=fff&size=128";
                    }
                    
                    echo '
                        ' . $successMessage . '
                        ' . $errorMessage . '
                        <div style="display: flex; align-items: flex-start; gap: 25px; margin-bottom: 25px;">
                            <div style="flex: 1; font-size: 15px; line-height: 1.5;">
                                <p><strong>Patient:</strong> '.htmlspecialchars($patient['fname'].' '.$patient['mname'].' '.$patient['lname']).'</p>
                                <p><strong>Student ID:</strong> '.htmlspecialchars($patient['student_id']).'</p>
                                <p><strong>Appointment Number:</strong> '.htmlspecialchars($app['apponum']).'</p>
                                <p><strong>Date:</strong> '.htmlspecialchars($app['appodate']).'</p>
                                <p><strong>Reason:</strong> '.htmlspecialchars($app['reason']).'</p>
                            </div>
                            <div style="flex-shrink: 0; width: 220px; height: 220px; border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">
                                <img src="' . $imagePath . '" alt="Patient Image" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        
                        <center>';
            
            // Current Appointment Medicine History Table
            echo '<h3 style="margin-bottom: 15px; border-bottom: 2px solid #007BFF; padding-bottom: 5px;">Current Appointment Medicine History</h3>
            <div class="abc scroll" style="max-height: 220px; overflow-y: auto; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 20px;">
                <table width="100%" class="sub-table scrolldown" border="0" cellspacing="0" cellpadding="8" style="border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f0f8ff;">
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Medicine</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Dosage</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Instructions</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Date Given</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            $histq = $database->query("SELECT * FROM history WHERE appoid='$id' ORDER BY date_given DESC");
            if ($histq->num_rows == 0) {
                echo '<tr><td colspan="4" style="text-align: center; padding: 15px;">No medicine history found for this appointment</td></tr>';
            } else {
                while($hist = $histq->fetch_assoc()) {
                    echo '<tr style="border-bottom: 1px solid #eee;">
                        <td>'.htmlspecialchars($hist['medicine']).'</td>
                        <td>'.htmlspecialchars($hist['dosage']).'</td>
                        <td>'.htmlspecialchars($hist['instructions']).'</td>
                        <td>'.htmlspecialchars($hist['date_given']).'</td>
                    </tr>';
                }
            }
            echo '</tbody></table></div>';

            // Patient's Full Medicine History (All Appointments)
            echo '<h3 style="margin-bottom: 15px; border-bottom: 2px solid #007BFF; padding-bottom: 5px;">Patient\'s Complete Medicine History</h3>
            <div class="abc scroll" style="max-height: 220px; overflow-y: auto; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 20px;">
                <table width="100%" class="sub-table scrolldown" border="0" cellspacing="0" cellpadding="8" style="border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f0f8ff;">
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Medicine</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Dosage</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Instructions</th>
                            <th style="border-bottom: 1px solid #ccc; text-align: left;">Date Given</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            $patient_histq = $database->query("
                SELECT h.*, a.reason as appointment_reason, s.title as schedule_title
                FROM history h 
                LEFT JOIN appointment a ON h.appoid = a.appoid 
                LEFT JOIN schedule s ON a.scheduleid = s.scheduleid
                WHERE h.pid = '{$pid}'
                ORDER BY h.date_given DESC
            ");
            
            if ($patient_histq->num_rows == 0) {
                echo '<tr><td colspan="4" style="text-align: center; padding: 15px;">No medicine history found for this patient</td></tr>';
            } else {
                while($hist = $patient_histq->fetch_assoc()) {
                    $isCurrentAppt = ($hist['appoid'] == $id) ? ' style="background-color: #f8f8ff; font-weight: bold;"' : ' style="border-bottom: 1px solid #eee;"';
                    
                    echo '<tr'.$isCurrentAppt.'>
                        <td>'.htmlspecialchars($hist['medicine']).'</td>
                        <td>'.htmlspecialchars($hist['dosage']).'</td>
                        <td>'.htmlspecialchars($hist['instructions']).'</td>
                        <td>'.htmlspecialchars($hist['date_given']).'</td>
                    </tr>';
                }
            }
            echo '</tbody></table></div>';

            // Add Medicine Form
            echo '<div class="add-medicine-section">';
            echo '<h4 style="margin-top: 10px; margin-bottom: 12px;" class="medicine-form-heading">Add Medicine to History</h4>
            <form action="add-history.php" method="POST" class="add-new-form" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
                <input type="hidden" name="appoid" value="'.htmlspecialchars($id).'">
                <input type="hidden" name="pid" value="'.htmlspecialchars($pid).'">
                <label for="medicine" style="flex: 1 1 200px; min-width: 180px;">Medicine:<br>
                    <select name="medicine" id="medicine" required style="width: 100%; padding: 6px; margin-top: 4px;">
                        <option value="" disabled selected>Select Medicine</option>';
            
            $medlist = $database->query("SELECT * FROM medicine ORDER BY brand ASC");
            while($med = $medlist->fetch_assoc()) {
                $brand = htmlspecialchars($med['brand']);
                echo '<option value="'.$brand.'">'.$brand.'</option>';
            }
            echo '</select>
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
            </form>';
            echo '</div>';

            // Add textareas for cert reason and validity
            echo '<h4 style="margin-top: 40px; margin-bottom: 12px;">Medical Certificate Details</h4>
            <form id="medcert-details-form" style="margin-bottom: 20px;">
                <textarea name="cert_reason" rows="3" style="width: 100%; padding: 8px; font-size: 14px; resize: vertical; margin-bottom: 12px;" placeholder="Reason for certificate (doctor input)"></textarea>
                <textarea name="cert_validity" rows="1" style="width: 100%; padding: 8px; font-size: 14px; resize: vertical;" placeholder="Validity period (e.g. 7 days)"></textarea>
            </form>';

            // Print and remove buttons
            echo '<div style="text-align: center;">
                <button onclick="printPopup()" class="btn-primary btn" style="padding: 10px 22px; margin-bottom: 25px; cursor: pointer;">Print Medical Certificate</button>
                <a href="delete-appointment.php?id='.$id.'" class="btn-danger btn" style="display: inline-block; padding: 10px 24px; background: #dc3545; color: #fff; border-radius: 5px; text-decoration: none; font-weight: 600;">Remove Appointment</a>
            </div>';
            
            // Print styles
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
                
                /* Keep the medical certificate details heading */
                h4:not(:contains("Medical Certificate Details")) {
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
            echo '<script>function printPopup() { window.print(); }</script>';
            echo '</center></div></div></div>';
        }
    }

    ?>
    </div>
    
</html>