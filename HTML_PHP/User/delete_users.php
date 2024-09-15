<?php
// Include the database connection file
include 'config.php';

// Check if the 'MemberID' is passed via GET request
if (isset($_GET['MemberID'])) {
    // Get the MemberID from the URL
    $memberID = $_GET['MemberID'];

    // Prepare a SQL query to delete the member from the Member table
    $sql = "DELETE FROM Member WHERE MemberID = ?";

    // Initialize a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter (i stands for integer)
        $stmt->bind_param("i", $memberID);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Member deleted successfully.";
        } else {
            echo "Error deleting member: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No MemberID provided.";
}

// Close the database connection
$conn->close();
?>
