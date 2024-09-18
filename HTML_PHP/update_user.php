<?php
// Include the database connection file
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $memberID = $_POST['MemberID'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $dob = $_POST['DOB'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE Member SET FirstName=?, LastName=?, Username=?, Email=?, DOB=? WHERE MemberID=?");
    $stmt->bind_param("sssssi", $firstName, $lastName, $username, $email, $dob, $memberID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>Record updated successfully.</p>";
    } else {
        echo "<p>Error updating record: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the user list (or another page)
    header("Location: manage_user.php");
    exit();
} else {
    echo "<p>Invalid request method.</p>";
}
?>
