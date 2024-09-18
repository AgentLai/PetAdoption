<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'config.php';

// Check if the 'PetID' is passed via POST request
if (isset($_POST['PetID'])) {
    // Get the PetID from the POST request
    $petID = $_POST['PetID'];

    // Validate that PetID is a number
    if (!filter_var($petID, FILTER_VALIDATE_INT)) {
        die("Invalid PetID.");
    }

    // Prepare a SQL query to delete the pet from the Pets table
    $sql = "DELETE FROM Pets WHERE PetID = ?";

    // Initialize a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter (i stands for integer)
        $stmt->bind_param("i", $petID);

        // Execute the statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Pet deleted successfully.";
            } else {
                echo "No pet found with ID: $petID.";
            }
        } else {
            echo "Error deleting pet: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No PetID provided.";
}

// Close the database connection
$conn->close();
?>
