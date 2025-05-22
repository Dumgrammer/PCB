<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

// Debug log
error_log("Add Medicine Request Started");
error_log("POST data: " . print_r($_POST, true));
error_log("GET data: " . print_r($_GET, true));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $appoid = $_GET['id'];
    error_log("Appointment ID: " . $appoid);
    
    $appq = $database->query("SELECT * FROM appointment WHERE appoid='$appoid'");
    if (!$appq) {
        error_log("Error fetching appointment: " . $database->error);
        die("Error fetching appointment: " . $database->error);
    }
    
    $app = $appq->fetch_assoc();
    if (!$app) {
        error_log("Appointment not found with ID: " . $appoid);
        die("Appointment not found");
    }
    
    $pid = $app['pid'];
    error_log("Patient ID: " . $pid);
    
    if (!isset($_POST['medicine']) || !isset($_POST['dosage']) || !isset($_POST['instructions'])) {
        error_log("Missing required fields");
        die("Missing required fields");
    }
    
    $medicine = $database->real_escape_string($_POST['medicine']);
    $dosage = $database->real_escape_string($_POST['dosage']);
    $instructions = $database->real_escape_string($_POST['instructions']);
    
    error_log("Attempting insert with values - Medicine: $medicine, Dosage: $dosage, Instructions: $instructions");
    
    $sql = "INSERT INTO history (appoid, pid, medicine, dosage, instructions, date_given) 
            VALUES ('$appoid', '$pid', '$medicine', '$dosage', '$instructions', NOW())";
    
    error_log("SQL Query: " . $sql);
    
    if ($database->query($sql)) {
        error_log("Insert successful");
        echo "success";
    } else {
        $error = "MySQL Error: " . $database->error;
        error_log($error);
        die($error);
    }
} else {
    error_log("Invalid request method or missing ID");
    die("Invalid request");
}
?> 