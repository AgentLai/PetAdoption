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
    <link rel="stylesheet" href="style.css" />
    <!-- link To JS -->
    <script src="index.js" defer></script>
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
    <div class="login-container">
        <div class="box">
            <?php
                include("php/config.php");
                if(isset($_POST['submit'])){
                    $email = mysqli_real_escape_string($con,$_POST['email']);
                    $password = mysqli_real_escape_string($con,$_POST['password']);

                    $result = mysqli_query($con,"SELECT * FROM member WHERE Email='$email' AND Password = '$password'") or die("Selection Error");
                    $row = mysqli_fetch_assoc($result);

                    if(is_array($row) && !empty($row)){
                        $_SESSION['valid'] = $row['Email'];
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['dob'] = $row['DoB'];
                        $_SESSION['memberID'] = $row['memberID'];
                    } else{
                        echo "<div class = 'message'>
                            <p> Wrong Username or Password </p>
                            </div> <br>";
                        echo"< a href = 'index.php'><button class = 'btn'> Go Back </button>";
                    }
                    if(isset($_SESSION['valid'])){
                        header("Location: login.php")
                    }
                }else{
                
            ?>
            <div class="box-login" >
                <div class="top-header">
                    <h3>Hello Again!</h3>
                    <small>We are happy to have you back!</small>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <input type="text" class="input-box" id="Email" required>
                        <label for="Email">Email Address</label>
                    </div>
                    <div class="input-field">
                        <input type="password" class="input-box" id="Password" required>
                        <label for="Password">Password</label>
                        <div class="eye-area">
                            <div class="eye-box" onclick="myLogin">
                                <i class="fa-regular fa-eye"></i>
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                        </div>
                    </div>
                    <div class="remember">
                        <input type="checkbox" id="formCheck" class="check">
                        <label for="formCheck"> Remember Me</label>
                    </div>
                    <div class="input-field">
                        <input type="submit" class="input-submit" value="Sign In">
                    </div>
                    <div class="forgot">
                        <a href="register.php">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
</body>
</html>