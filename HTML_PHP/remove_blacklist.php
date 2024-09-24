<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberID = $_POST['memberID'];

    // Update the status in the database
    $update_sql = "UPDATE Member SET Status = 'active' WHERE MemberID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $memberID);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
}
$conn->close();
?>
