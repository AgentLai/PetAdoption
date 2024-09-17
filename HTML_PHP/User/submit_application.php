<?php
session_start();

// Include the database connection
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch the form data
    $fullname = mysqli_real_escape_string($con, $_POST['full_name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $pet_name = mysqli_real_escape_string($con, $_POST['pet_name']);
    $reason = mysqli_real_escape_string($con, $_POST['reason']);

    // Retrieve PetID based on PetName (assuming PetName is unique)
    $pet_query = "SELECT PetID FROM pets WHERE LOWER(PetName) = LOWER('$pet_name') LIMIT 1";
    $pet_result = mysqli_query($con, $pet_query);
    
    if ($pet_result && mysqli_num_rows($pet_result) > 0) {
        $pet_id = mysqli_fetch_assoc($pet_result)['PetID'];

        // Save the application data into the database
        $query = "INSERT INTO adoption_applications (MemberID, PetID, PetName, FullName, PhoneNumber, Address, ReasonForAdopting) 
                  VALUES ('{$_SESSION['MemberID']}', '$pet_id', '$pet_name', '$fullname', '$phone', '$address', '$reason')";

        if (mysqli_query($con, $query)) {
            echo "Application submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: Pet name not found.";
    }
}
?>
