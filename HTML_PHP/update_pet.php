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
    $petName = $_POST['petName'];
    $imageUrl = $_POST['image_url'];
    $age = $_POST['age'];
    $petSpecies = $_POST['petSpecies'];
    $gender = $_POST['gender'];
    $petDesc = $_POST['petDesc'];
    $disabilities = $_POST['disabilities']; // New field for disabilities
    $status = $_POST['status'];

    // Initialize breed variables
    $dogBreed = null;
    $catBreed = null;

    // Determine the breed based on species
    if ($petSpecies === 'Dog') {
        $dogBreed = $_POST['breed']; // Dog breed
    } elseif ($petSpecies === 'Cat') {
        $catBreed = $_POST['breed']; // Cat breed
    }

    // Print received data for debugging
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Prepare and bind
    // Adjust SQL statement to include the breed column for both dogs and cats
    $stmt = $conn->prepare("UPDATE Pets SET PetName=?, image_url=?, Age=?, PetSpecies=?, Dog_breed=?, Cat_breed=?, Gender=?, Disabilities=?, Status=? WHERE PetID=?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $bindResult = $stmt->bind_param("ssissssssi", $petName, $imageUrl, $age, $petSpecies, $dogBreed, $catBreed, $gender, $disabilities, $status, $petID);
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

