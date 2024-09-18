<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the 'MemberID' is passed via POST request
if (isset($_POST['MemberID'])) {
    // Get the MemberID from the POST request
    $memberID = $_POST['MemberID'];

    // Validate that MemberID is a number
    if (!filter_var($memberID, FILTER_VALIDATE_INT)) {
        die("Invalid MemberID.");
    }

    // Prepare a SQL query to delete the member from the Member table
    $sql = "DELETE FROM Member WHERE MemberID = ?";

    // Initialize a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter (i stands for integer)
        $stmt->bind_param("i", $memberID);

        // Execute the statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Member deleted successfully.";
            } else {
                echo "No member found with ID: $memberID.";
            }
        } else {
            echo "Error deleting member: " . $stmt->error;
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
