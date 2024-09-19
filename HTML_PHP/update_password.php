<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['MemberID'])) {
    header('Location: login.php');
    exit();
}

$memberID = $_SESSION['MemberID'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    // Get the form inputs
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Debugging: Print the inputs
    // echo "Current Password: " . htmlspecialchars($current_password) . "<br>";
    // echo "New Password: " . htmlspecialchars($new_password) . "<br>";
    // echo "Confirm Password: " . htmlspecialchars($confirm_password) . "<br>";

    // Get the current hashed password from the database
    $query = "SELECT Password FROM Member WHERE MemberID = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $memberID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Verify the current password
    if (password_verify($current_password, $user['Password'])) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the new password in the database
            $update_query = "UPDATE Member SET Password = ? WHERE MemberID = ?";
            $update_stmt = $conn->prepare($update_query);
            if (!$update_stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $update_stmt->bind_param("si", $hashed_new_password, $memberID);

            if ($update_stmt->execute()) {
                // Redirect back to profile.php after a successful update
                header('Location: profile.php?password_update=success');
                exit();
            } else {
                echo "Error updating password: " . $update_stmt->error;
            }
        } else {
            echo "New password and confirmation do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>
