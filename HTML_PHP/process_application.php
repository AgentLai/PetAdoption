<?php
session_start();
include("config.php");

if (isset($_POST['application_id'])) {
    $applicationID = $_POST['application_id'];
    
    if (isset($_POST['approve'])) {
        // Update the application status to 'Approved'
        $query = "UPDATE adoptionapplication SET Status = 'Approved' WHERE ApplicationID = '$applicationID'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Application approved successfully.";
        } else {
            $_SESSION['message'] = "Error approving application: " . mysqli_error($conn);
        }
    }

    if (isset($_POST['deny'])) {
        // Update the application status to 'Denied'
        $query = "UPDATE adoptionapplication SET Status = 'Rejected' WHERE ApplicationID = '$applicationID'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Application denied successfully.";
        } else {
            $_SESSION['message'] = "Error denying application: " . mysqli_error($conn);
        }
    }
}

// Redirect back to the applications page
header("Location: applications.php");
exit();
?>
