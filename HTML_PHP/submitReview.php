<?php
session_start();
include("config.php");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Updated from $conn to $con
}

if (isset($_SESSION['MemberID']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the MemberID from the session
    $member_id = $_SESSION['MemberID'];
    
    // Get the rating and comments from the form
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    
    // Prepare the SQL statement to insert the review
    $stmt = $con->prepare("INSERT INTO Reviews (MemberID, Rating, Comments, ReviewDate) VALUES (?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->bind_param("iis", $member_id, $rating, $comments);
    
    if ($stmt->execute()) {
        // Redirect back to FAQs.php after successful submission
        header("Location: FAQs.php?success=1"); // Adds a success parameter to show a message if needed
        exit(); // Ensures the script stops executing after redirection
    } else {
        echo "Error submitting review: " . $conn->error;
    }
    
    // Close the statement and connection
    $stmt->close();
}

$con->close();
?>
