<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and escape form data
    $petName = $conn->real_escape_string($_POST['name']);
    $age = $conn->real_escape_string($_POST['age']);
    $species = $conn->real_escape_string($_POST['petSpecies']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $status = $conn->real_escape_string($_POST['status']);
    $petDesc = $conn->real_escape_string($_POST['petDesc']);
    $disabilities = $conn->real_escape_string($_POST['disabilities']);
    
    // Determine the breed based on species
    $dog_breed = null;
    $cat_breed = null;

    if ($species == 'Dog') {
        $dog_breed = $conn->real_escape_string($_POST['Dog_breed']);
    } elseif ($species == 'Cat') {
        $cat_breed = $conn->real_escape_string($_POST['Cat_breed']);
    }

    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = basename($_FILES['image']['name']);
        $imageTmpName = $_FILES['image']['tmp_name'];
        $uploadDir = __DIR__ . '/uploads/';

        // Check if the directory exists
        if (!is_dir($uploadDir)) {
            echo "Directory does not exist: " . $uploadDir;
            exit();
        }

        // Set the image path as a relative path
        $imagePath = 'uploads/' . $imageName;

        // Move the file to the uploads directory
        if (move_uploaded_file($imageTmpName, $uploadDir . $imageName)) {
            $imagePath = $conn->real_escape_string($imagePath);
        } else {
            echo "Failed to upload image. Error: " . $_FILES['image']['error'];
            exit();
        }
    }

    // Insert pet data into the database
    $sql = "INSERT INTO Pets (PetName, Age, PetSpecies, Dog_breed, Cat_breed, Gender, Status, 
            PetDesc, Disabilities, image_url) VALUES 
            ('$petName', '$age', '$species', '$dog_breed', '$cat_breed', '$gender', '$status', 
            '$petDesc', '$disabilities', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_pet.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

