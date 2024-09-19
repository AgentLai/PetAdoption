<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['MemberID'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}



$memberID = $_SESSION['MemberID'];
$query = "SELECT Username, FirstName, LastName, DOB, Email FROM Member WHERE MemberID = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_changes'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    // Update user details in the database
    $update_query = "UPDATE Member SET FirstName = ?, LastName = ?, DOB = ?, Email = ? WHERE MemberID = ?";
    $update_stmt = $con->prepare($update_query);
    $update_stmt->bind_param("sssii", $first_name, $last_name, $dob, $email, $memberID);

    if ($update_stmt->execute()) {
        $update_success_message = "Profile updated successfully.";
        // Refresh the user data after update
        $query = "SELECT Username, FirstName, LastName, DOB, Email, Password FROM Member WHERE MemberID = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $memberID);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } else {
        $update_error_message = "Error updating profile.";
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate current password
    if (password_verify($current_password, $user['Password'])) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_query = "UPDATE Member SET Password = ? WHERE MemberID = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("si", $hashed_new_password, $memberID);

            if ($update_stmt->execute()) {
                $password_success_message = "Password changed successfully.";
            } else {
                $password_error_message = "Error updating password.";
            }
        } else {
            $password_error_message = "New password and confirmation do not match.";
        }
    } else {
        $password_error_message = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <!-- Use for responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link To CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- link To JS -->
    <script src="IndexJava.js" defer></script>
    <script src="profile.js" defer></script>
    <!-- For Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/2.0.0/scrollReveal.js">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
        integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
        integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <!-- Link For Split Type -->
    <script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>

    <title>Pet Haven</title>
</head>


<body>
    <!-- Navbar -->
    <nav>
        <a href="index.html" class="brand">
            <h1>Pet<b class="accent">Haven</b></h1>
        </a>
        <div class="menu">
            <div class="btn">
                <i class="fas fa-times close-btn"></i>
            </div>
            <a href="index.php">Home</a>
            <a href="AboutUs.php">About Us</a>
            <a href="Pets.php">Pets</a>
            <a href="FAQs.php">FAQ's</a>
            <a href="index.php#stories">Stories</a>
        </div>
    </nav>

    <!-- Profile Page Content -->
    <div class="profile-container" id="account-general">
    <h4>Account Settings</h4>

    <div class="row">
        <div class="list-group-container">
            <div class="list-groups">
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-general">General</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-adoption-history">Adoption History</a>
            </div>
        </div>

        <div class="content-section">
            <!-- General Settings -->
            <div class="profile-account">
                <div class="profile-header">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="profile-image">
                    <div class="profile-media">
                        <button type="button" class="input-btn" id="uploadBtn">Upload new photo</button>
                        <input type="file" id="fileInput" accept="image/*" style="display: none;">
            &nbsp;
                        <button type="button" class="input-btn" id="resetBtn">Reset</button>
                        <div class="media-requirements">Allowed JPG, GIF or PNG. Max size of 800K</div>
                    </div>
                </div>
                
                <div class="profile-card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="AgentLai" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="Douglas" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="Lai" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="2000-12-02" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="douglaslys-sm23@student.tarc.edu.my" required>
                        </div>
                              <button type="submit" class="save-btn">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="password-change" id="account-change-password">
                  <h5>Change Password</h5>
                <div class="password-card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="form-label">Current password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">New password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm new password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" name="change_password" class="save-btn">Save Password</button>
                    </form>
                </div>
            </div>

            <?php
               // Get the MemberID from the session
              $member_id = $_SESSION['MemberID'];

               // Query to get adoption applications for the logged-in member
               $query = "SELECT PetName, Status FROM adoption_applications WHERE MemberID = '$member_id'";
               $result = mysqli_query($con, $query);
              ?>
            
            <!-- Adoption History -->
            <div class="adoption-history">
                 <h5>Adoption History</h5>

            <?php
                  if (mysqli_num_rows($result) > 0) {
                  // Loop through the results and display each application
                  while ($row = mysqli_fetch_assoc($result)) {
                  $pet_name = htmlspecialchars($row['PetName']);
                  $status = htmlspecialchars($row['Status']);
                  
                echo "<div class='adoption-item'>
                    <div class='adoption-header'>
                        <strong>Pet Name:</strong> $pet_name
                    </div>
                    <div class='adoption-status'  id='account-adoption-history'>
                        <strong>Status:</strong> <span class='status'>$status</span>
                    </div>
                  </div>";
                }
             } else {
        echo "<p>No adoption history found.</p>";
    }
    ?>
                  </div>
            </div>
        </div>


    
    <a href="logout.php"><button class="logout-btn">Logout</button></a>
    
</div>

</body>

</html>
