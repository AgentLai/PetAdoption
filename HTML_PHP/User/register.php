<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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