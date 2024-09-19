<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST['name'];
    $imageUrl = $_POST['image_url'];
    $age = $_POST['age'];
    $petSpecies = $_POST['petSpecies'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];
    $petDesc = $_POST['petDesc']; // Added field

    // Validate inputs (e.g., sanitize and/or validate data as needed)
    if (empty($name) || empty($gender) || empty($status)) {
        die("Required fields are missing.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Pets (PetName, image_url, Age, PetSpecies, Breed, Gender, PetDesc, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $bindResult = $stmt->bind_param("ssisssss", $name, $imageUrl, $age, $petSpecies, $breed, $gender, $petDesc, $status);
    if ($bindResult === false) {
        die("Bind failed: " . $stmt->error);
    }

    // Execute the statement
    $executeResult = $stmt->execute();
    if ($executeResult) {
        // Redirect to manage_pets.php after success
        header("Location: manage_pet.php");
        exit();
    } else {
        echo "<p>Error adding pet: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request method.</p>";
}
?>
