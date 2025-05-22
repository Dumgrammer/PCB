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

if($_POST){
    $pid = $_POST["pid"];
    $pname = $_POST["pname"];
    $docid = $_POST["docid"];
    $appodate = $_POST["appodate"];
    $appotime = $_POST["appotime"];
    $reason = $_POST["reason"];
    
    // Generate a unique appointment number
    $apponum = date('YmdHis') . rand(100, 999);
    
    // Insert into schedule table
    $sql1 = "INSERT INTO schedule (docid, title, scheduledate, scheduletime) VALUES ('$docid', '$reason', '$appodate', '$appotime')";
    $result1 = $database->query($sql1);
    
    if($result1) {
        $scheduleid = $database->insert_id;
        
        // Insert into appointment table (now with reason)
        $sql2 = "INSERT INTO appointment (pid, scheduleid, apponum, appodate, reason) VALUES ('$pid', '$scheduleid', '$apponum', '$appodate', '$reason')";
        $result2 = $database->query($sql2);
        
        if($result2) {
            header("location: appointment.php?action=session-added&title=$reason");
        } else {
            header("location: patient.php?action=create-appointment&id=$pid&error=1");
        }
    } else {
        header("location: patient.php?action=create-appointment&id=$pid&error=1");
    }
}
?> 