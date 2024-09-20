<?php
session_start();

// Include the database connection
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch the form data
    $fullname = mysqli_real_escape_string($con, $_POST['full_name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $pet_id = mysqli_real_escape_string($con, $_POST['pet_id']);
    $pet_name = mysqli_real_escape_string($con, $_POST['pet_name']);
    $reason = mysqli_real_escape_string($con, $_POST['reason']);
    
        // Save the application data into the database
        $query = "INSERT INTO adoption_applications (MemberID, PetID, PetName, FullName, PhoneNumber, Address, ReasonForAdopting) 
                  VALUES ('{$_SESSION['MemberID']}', '$pet_id', '$pet_name', '$fullname', '$phone', '$address', '$reason')";

       if (mysqli_query($con, $query)) {
            // Redirect back to pets.php after successful submission
            header("Location: pets.php?application=success");
            exit(); // Make sure no further code is executed after the redirect
        } else {
            // Redirect with error message
            header("Location: pets.php?application=error");
            exit();
        }
    } else {
        // If the user is not logged in, redirect to login page
        header("Location: login.php?error=login_required");
        exit();
        }
?>
