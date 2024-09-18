<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $memberID = $_POST['memberID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    // Print received data for debugging
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE Member SET FirstName=?, LastName=?, Username=?, Email=?, DOB=? WHERE MemberID=?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $bindResult = $stmt->bind_param("sssssi", $firstName, $lastName, $username, $email, $dob, $memberID);
    if ($bindResult === false) {
        die("Bind failed: " . $stmt->error);
    }

    // Execute the statement
    $executeResult = $stmt->execute();
    if ($executeResult) {
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
