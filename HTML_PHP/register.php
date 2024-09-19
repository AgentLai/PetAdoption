<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <!-- Use for responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link To CSS -->
    <link rel="stylesheet" href="../JSAndCSS/style.css" />
    <!-- link To JS -->
    <script src="../JSAndCSS/style.js" defer></script>
    <!-- For Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/2.0.0/scrollReveal.js">
    <!-- For Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Link For Gsap -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
      integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Link For Gsap - Scroll Trigger -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
      integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Link For Lenis - Smooth Scrolling -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <!-- Link For Split Type -->
    <script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>
    <title>Register</title>
</head>
<body>
<nav>
        <a href="index.html" class ="brand">
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
    <div class=" login-container">
        <div class="box form-box">

        <?php
            include("config.php");
            if (isset($_POST['submit'])) {
            
                $firstName = $_POST['FirstName'];
                $lastName = $_POST['LastName'];
                $username = $_POST['Username'];
                $dob = $_POST['DOB'];
                $email = $_POST['Email'];
                $password = $_POST['Password'];
                $confirm_password = $_POST['password']; // confirm password field
            
                // Sanitize and validate inputs
                $email = mysqli_real_escape_string($conn, $email);
            
                // Check if password and confirm password match
                if ($password != $confirm_password) {
                    echo "<div class='message'>
                            <p>Passwords do not match. Please try again.</p>
                          </div> <br>";
                    echo "<a href='javascript:history.back()'><button class='btn'>Go Back</button></a>";
                    exit();
                }

                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Check if the email is already in use
                $verify_query = mysqli_query($conn, "SELECT Email FROM Member WHERE Email = '$email'");
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                            <p>This email is in use, please try again.</p>
                          </div> <br>";
                    echo "<a href='javascript:history.back()'><button class='btn'>Go Back</button></a>";
                } else {
                    // Insert the user data into the database
                    $insert_query = mysqli_query($conn, "INSERT INTO Member (FirstName, LastName, Username, Email, DOB, Password) VALUES ('$firstName', '$lastName', '$username', '$email', '$dob', '$hashed_password')");
                
                    if ($insert_query) {
                        echo "<div class='message'>
                                <p>Registration Success!</p>
                              </div> <br>";
                        echo "<a href='index.php'><button class='btn-3'>Go to Home</button></a>";
                    } else {
                        echo "<div class='message'>
                                <p>Error occurred during registration: " . mysqli_error($conn) . "</p>
                              </div> <br>";
                        echo "<a href='javascript:history.back()'><button class='btn'>Go Back</button></a>";
            }
                }
            } else {
        ?>
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="FirstName">First Name</label>
                    <input type="text" name="FirstName" id="FirstName" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="LastName">Last Name</label>
                    <input type="text" name="LastName" id="LastName" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Username">Username</label>
                    <input type="text" name="Username" id="Userame" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="DOB">Date Of Birth</label>
                    <input type="date" name="DOB" id="DOB" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="email" name="Email" id="Email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="password" name="Password" id="Password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="cpassword" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn-login" name="submit" value="Sign Up" required>
                </div>
                <div class="login-links">
                    Already a member? <a href="login.php">Login Now!</a>
                </div>
            </form>
        </div>
        <?php 
        } 
        ?>
    </div>
    
</body>
</html>
