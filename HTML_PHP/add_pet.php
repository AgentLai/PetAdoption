<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $petName = $_POST['name'];
    $age = $_POST['age'];
    $petSpecies = $_POST['petSpecies'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];
    $petDesc = $_POST['petDesc'];
    $disabilities = $_POST['disabilities'];

    // Handle image file upload (if a file is uploaded)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file to the server
        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            die("Failed to upload image.");
        }
    } else {
        // Default image URL if none is uploaded
        $imagePath = null;
    }

    // Prepare the SQL statement for inserting the pet
    $stmt = $conn->prepare("INSERT INTO Pets (PetName, image_url, Age, PetSpecies, Dog_breed, Cat_breed, Gender, PetDesc, Disabilities, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Determine if the species is Dog or Cat and set the correct breed column
    $dogBreed = null;
    $catBreed = null;
    
    if ($petSpecies === 'Dog') {
        $dogBreed = $breed;
    } elseif ($petSpecies === 'Cat') {
        $catBreed = $breed;
    }

    // Bind the parameters
    $stmt->bind_param("ssisssssss", $petName, $imagePath, $age, $petSpecies, $dogBreed, $catBreed, $gender, $petDesc, $disabilities, $status);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>Pet added successfully.</p>";
    } else {
        echo "<p>Error adding pet: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the pet list (or another page)
    header("Location: manage_pet.php");
    exit();
}
?>

