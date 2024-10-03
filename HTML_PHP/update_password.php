<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['MemberID'])) {
    header('Location: login.php');
    exit();
}

$memberID = $_SESSION['MemberID'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../JSAndCSS/style.css" />
    <title>Update Password</title>
</head>
<body>
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
        </div>
    </nav>
    <div class="login-container">
        <div class="box form-box">
            <?php
               // Check if the form was submitted
               if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
                   $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
                   $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
                   $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                   // Get the current hashed password from the database
                   $query = "SELECT Password FROM member WHERE MemberID = ?";
                   $stmt = $conn->prepare($query);
                   $stmt->bind_param("i", $memberID);
                   $stmt->execute();
                   $result = $stmt->get_result();
                   $user = $result->fetch_assoc();

                   if (!$user) {
                       echo "<div class='message'>
                               <p>User not found.</p>
                             </div><br>";
                       echo "<a href='profile.php'><button class='again-btn'>Go Back</button></a>";
                       exit();
                   }

                   // Verify the current password
                   if (password_verify($current_password, $user['Password'])) {
                       // Check if new password and confirm password match
                       if ($new_password === $confirm_password) {
                           // Hash the new password
                           $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                           // Update the new password in the database
                           $update_query = "UPDATE member SET Password = ? WHERE MemberID = ?";
                           $update_stmt = $conn->prepare($update_query);
                           $update_stmt->bind_param("si", $hashed_new_password, $memberID);

                           if ($update_stmt->execute()) {
                               // Redirect back to profile.php after a successful update
                               header('Location: profile.php?password_update=success');
                               exit();
                           } else {
                               echo "<div class='message'>
                                       <p>Error updating password: " . htmlspecialchars($update_stmt->error) . "</p>
                                     </div><br>";
                               echo "<a href='profile.php'><button class='again-btn'>Try Again</button></a>";
                           }
                       } else {
                           echo "<div class='message'>
                                   <p>New password and confirmation do not match.</p>
                                 </div><br>";
                           echo "<a href='profile.php'><button class='again-btn'>Try Again</button></a>";
                       }
                   } else {
                       echo "<div class='message'>
                               <p>Current password is incorrect.</p>
                             </div><br>";
                       echo "<a href='profile.php'><button class='again-btn'>Try Again</button></a>";
                   }
               } else {
            ?>
            <header>Update Password</header>
            <form action="update_password.php" method="post">
                <div class="field input">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required>
                </div>
                <div class="field input">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>
                <div class="field input">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <div class="field">
                    <button type="submit" class="btn-login" name="change_password">Update Password</button>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>
