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
    $petID = $_POST['petID'];
    $petName = $_POST['name'];
    $imageUrl = $_POST['image_url'];
    $age = $_POST['age'];
    $petSpecies = $_POST['petSpecies'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    // Print received data for debugging
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE Pets SET PetName=?, image_url=?, Age=?, PetSpecies=?, Breed=?, Gender=?, Status=? WHERE PetID=?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $bindResult = $stmt->bind_param("ssissssi", $petName, $imageUrl, $age, $petSpecies, $breed, $gender, $status, $petID);
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

    // Redirect back to the pet list (or another page)
    header("Location: manage_pet.php");
    exit();
} else {
    echo "<p>Invalid request method.</p>";
}
?>
