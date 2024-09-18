<?php
// Include the database connection file
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $petID = $_POST['petID'];
    $name = $_POST['name'];
    $imageUrl = $_POST['image_url'];
    $age = $_POST['age'];
    $petSpecies = $_POST['petSpecies'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $size = $_POST['size'];
    $colour = $_POST['colour'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE Pets SET Name=?, image_url=?, Age=?, PetSpecies=?, Breed=?, Gender=?, Price=?, Status=?, Size=?, Colour=? WHERE PetID=?");
    $stmt->bind_param("ssissssssi", $name, $imageUrl, $age, $petSpecies, $breed, $gender, $price, $status, $size, $colour, $petID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>Record updated successfully.</p>";
    } else {
        echo "<p>Error updating record: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the pets list (or another page)
    header("Location: manage_pets.php");
    exit();
} else {
    echo "<p>Invalid request method.</p>";
}
?>
