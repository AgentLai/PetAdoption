<?php
session_start();
include 'config.php';

if (!isset($_SESSION['MemberID'])) {
    header('Location: login.php');
    exit();
}

$memberID = $_SESSION['MemberID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $dob = htmlspecialchars($_POST['dob']);
    $email = htmlspecialchars($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        $update_query = "UPDATE Member SET FirstName = ?, LastName = ?, DOB = ?, Email = ? WHERE MemberID = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssssi", $first_name, $last_name, $dob, $email, $memberID);

        if ($stmt->execute()) {
            // Redirect back to profile.php after successful update
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . $stmt->error;
        }
    }
}
?>