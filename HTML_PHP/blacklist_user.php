<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user ID and blacklist reason
    $userID = $_POST['memberID'];
    $reason = $_POST['reason'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE Member SET Status='blacklisted', BlacklistReason=? WHERE MemberID=?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $bindResult = $stmt->bind_param("si", $reason, $userID);
    if ($bindResult === false) {
        die("Bind failed: " . $stmt->error);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "User blacklisted successfully.";
    } else {
        echo "Error blacklisting user: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
