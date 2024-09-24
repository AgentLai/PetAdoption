<?php
require 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['memberID'])) {
        $memberID = intval($_POST['memberID']);
        
        // Update the user status in the database
        $update_query = "UPDATE Member SET Status = 'active' WHERE MemberID = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('i', $memberID);

        if ($stmt->execute()) {
            echo 'success'; // Return success response
        } else {
            echo 'error'; // Return error response
        }
        
        $stmt->close();
    }
}
$conn->close();
