<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appoid'])) {
    $appoid = $_POST['appoid'];
    $medicine = $_POST['medicine'];
    $dosage = $_POST['dosage'];
    $instructions = $_POST['instructions'];
    
    // Get the patient ID correctly
    if (isset($_POST['pid']) && !empty($_POST['pid'])) {
        $pid = $_POST['pid'];
    } else {
        // Fallback to lookup - this should rarely happen
        $lookup_sql = "SELECT pid FROM appointment WHERE appoid='$appoid'";
        $appq = $database->query($lookup_sql);
        if (!$appq || $appq->num_rows == 0) {
            die("Error: Appointment not found");
        }
        $app = $appq->fetch_assoc();
        $pid = $app['pid'];
        if (!$pid) {
            die("Error: Patient ID not found for this appointment");
        }
    }
    
    // Determine if we came from patient view or appointment view
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $fromPatientView = strpos($referrer, 'patient.php') !== false;
    
    // Insert into history
    $insert_sql = "INSERT INTO history (appoid, pid, medicine, dosage, instructions, date_given) 
                  VALUES ('$appoid', '$pid', '$medicine', '$dosage', '$instructions', NOW())";
    
    if ($database->query($insert_sql)) {
        // Success! Redirect back to the appropriate page
        if ($fromPatientView) {
            header("Location: patient.php?action=view&id=$pid&status=medicine_added");
        } else {
            header("Location: appointment.php?action=view&id=$appoid&status=success");
        }
        exit;
    } else {
        // Error handling
        if ($fromPatientView) {
            header("Location: patient.php?action=view&id=$pid&error=" . urlencode($database->error));
        } else {
            header("Location: appointment.php?action=view&id=$appoid&error=" . urlencode($database->error));
        }
        exit;
    }
} else {
    echo 'Invalid request.';
    exit;
}
?>
