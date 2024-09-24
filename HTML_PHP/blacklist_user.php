<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the 'MemberID' is passed via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['memberID'])) {
    $memberID = $_POST['memberID'];

    // Update the user's status to 'blacklisted'
    $sql = "UPDATE Member SET Status='blacklisted' WHERE MemberID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $memberID);

    if ($stmt->execute()) {
        echo "User successfully blacklisted.";
    } else {
        echo "Error blacklisting the user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>