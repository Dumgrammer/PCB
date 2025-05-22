<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appoid'])) {
    echo '<pre>';
    echo "POST DATA:\n";
    print_r($_POST);
    $appoid = $_POST['appoid'];
    $medicine = $_POST['medicine'];
    $dosage = $_POST['dosage'];
    $instructions = $_POST['instructions'];
    $pid = isset($_POST['pid']) ? $_POST['pid'] : '';
    if (!$pid) {
        // Fallback to lookup
        $lookup_sql = "SELECT pid FROM appointment WHERE appoid='$appoid'";
        echo "\nAPPOINTMENT LOOKUP SQL:\n$lookup_sql\n";
        $appq = $database->query($lookup_sql);
        if (!$appq || $appq->num_rows == 0) {
            echo "\nAppointment not found for appoid=$appoid\n";
            exit;
        }
        $app = $appq->fetch_assoc();
        $pid = $app['pid'];
        echo "\nLOOKUP RESULT: pid=$pid\n";
        if (!$pid) {
            echo "\nPatient ID not found for appoid=$appoid\n";
            exit;
        }
    }
    // Insert into history
    $insert_sql = "INSERT INTO history (appoid, pid, medicine, dosage, instructions, date_given) VALUES ('$appoid', '$pid', '$medicine', '$dosage', '$instructions', NOW())";
    echo "\nINSERT SQL:\n$insert_sql\n";
    if ($database->query($insert_sql)) {
        echo "\nInsert successful!\n";
    } else {
        echo "\nMySQL Error: " . $database->error . "\n";
    }
    echo '</pre>';
    exit;
} else {
    echo 'Invalid request.';
    exit;
}
?>
