<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberID = $_POST['memberID'];

    // Update the status to 'blacklisted'
    $update_sql = "UPDATE Member SET Status = 'blacklisted' WHERE MemberID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $memberID);

    if ($stmt->execute()) {
        echo 'User has been blacklisted.';
    } else {
        echo 'Error updating status.';
    }

    $stmt->close();
}
$conn->close();
?>
