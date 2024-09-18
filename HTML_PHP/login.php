<?php
    session_start();
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
    <!-- For Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
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
    <title>Login</title>
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
    <div class="login-container">
        <div class="box form-box">
            <?php
               include("config.php");

               if(isset($_POST['submit'])){
                   $email = mysqli_real_escape_string($conn, $_POST['email']);
                   $password = mysqli_real_escape_string($conn, $_POST['password']);

                   // Admin login condition
                   if($email === "PetAdmin@gmail.com" && $password === "@dmin2024_PetHaven"){
                       $_SESSION['valid'] = $email;
                       $_SESSION['username'] = "Admin";
                       header("Location: admin.php");
                       exit();
                   }

                   // Normal user login
                   $result = mysqli_query($conn, "SELECT * FROM member WHERE Email='$email' AND Password='$password'") or die("Selection Error");
                   $row = mysqli_fetch_assoc($result);

                   if(is_array($row) && !empty($row)){
                       $_SESSION['valid'] = $row['Email'];
                       $_SESSION['username'] = $row['Username'];
                       $_SESSION['dob'] = $row['DoB'];
                       $_SESSION['MemberID'] = $row['MemberID'];

                       header("Location: index.php");
                       exit();
                   } else {
                       echo "<div class='message'>
                               <p>Wrong Username or Password</p>
                             </div><br>";
                       echo "<button class='btn' onclick=\"window.location.href='index.php';\">Go Back</button>";
                    }
               } else {
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Sign In">
                </div>
                <div class="login-link">
                    Don't have an account? <a href="register.php">Sign Up Now!</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>    
</body>
</html>
