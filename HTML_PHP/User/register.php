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
    <link rel="stylesheet" href="style.css" />
    <!-- link To JS -->
    <script src="IndexJava.js" defer></script>
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
    <div class="container">
        <div class="box form-box">

        <?php
            include("php/config.php");
            if(isset($_POST['submit'])){

                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $dob = $_POST['dob'];
                $email = $_POST['email'];
                $password = $_POST['password'];
            $verify_query = mysqli_query($con, "SELECT Email FROM member WHERE Email = '$email'");
            if(mysqli_num_rows($verify_query)!=0){
                echo"<div class = 'message'>
                     <p> This email is in use, please try again </p>
                    </div> <br>";
                echo "<a href='javascript:self:histoy:back()'><button class = 'btn'> Go Back </button>";
            }
            else{
                mysqli_query($con, "INSERT INTO member(firstName, lastName, Email, DOB, Password) VALUES('$firstName','$lastName','$dob','$email','$password')") or die("Error Occured");
                echo"<div class = 'message'>
                        <p> Registration Success! </p>
                    </div> <br>";
                echo "<a href='index.php'><button class = 'btn'> Go Back </button>";
            }
        }else{
        ?>
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName"  required>
                </div>
                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" required>
                </div>
                <div class="field input">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" name="dob" id="dob" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field input">
                    <label for="password">Confirm Password</label>
                    <input type="cpassword" name="password" id="cpassword" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Sign Up" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Login Now!</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    
</body>
</html>
</html>