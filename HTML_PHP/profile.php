<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['MemberID'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

$memberID = $_SESSION['MemberID'];
$query = "SELECT Username, FirstName, LastName, DOB, Email, Status FROM Member WHERE MemberID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_changes'])) {
    // Sanitize and validate form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $dob = htmlspecialchars($_POST['dob']);
    $email = htmlspecialchars($_POST['email']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $update_error_message = "Invalid email format.";
    } else {
        // Update user details in the database
        $update_query = "UPDATE Member SET FirstName = ?, LastName = ?, DOB = ?, Email = ? WHERE MemberID = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssssi", $first_name, $last_name, $dob, $email, $memberID);

        if ($update_stmt->execute()) {
            $update_success_message = "Profile updated successfully.";
            // Refresh the user data after update
            $query = "SELECT Username, FirstName, LastName, DOB, Email FROM Member WHERE MemberID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $memberID);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        } else {
            $update_error_message = "Error updating profile: " . $update_stmt->error;
        }
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Debug: Check what the current password is
    var_dump($user['Password']); // This should output the hashed password from the database

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
                header('Location: profile.php?password_update=success'); // Redirect after success
                exit();
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
    <link rel="stylesheet" href="../JSAndCSS/style.css" />
    <!-- link To JS -->
    <script src="../JSAndCSS/index.js" defer></script>
    <script src="../JSAndCSS/profile.js" defer></script>
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
        <a href="index.php" class="brand">
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
                <a class="list-group-item list-group-item-action" data-toggle="list" href="profile.php">General</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="profile.php">Change password</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="adoption_history.php">Adoption History</a>
            </div>
        </div>

        <div class="content-section">
            <!-- General Settings -->
            <div class="profile-account">
                <div class="profile-card-body">
                <form method="POST" action="update_profile.php">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['FirstName']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['LastName']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="<?php echo htmlspecialchars($user['DOB']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status">Status</labe>
                        <input type="text" id="status" name="status" class="form-control" value="<?php 
                        if ($user['Status'] == 'blacklisted') {
                            echo 'Blacklisted';
                        } else {
                            echo 'Active';
                        } ?>" readonly>
                    </div>
                    <button type="submit" class="save-btn">Save Changes</button>
                </form>

                    <?php
                    if (isset($update_success_message)) {
                        echo "<p>$update_success_message</p>";
                    }

                    if (isset($update_error_message)) {
                        echo "<p>$update_error_message</p>";
                    }
                    ?>
                </div>
            </div>
                    
            <!-- Change Password -->
            <div class="password-change" id="account-change-password">
                <h5>Change Password</h5>
                <div class="password-card-body">
                    <form method="POST" action="update_password.php">
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
           
            </div>
        </div>
    <a href="logout.php"><button class="logout-btn">Log out</button></a>
    
</div>

</body>

</html>
