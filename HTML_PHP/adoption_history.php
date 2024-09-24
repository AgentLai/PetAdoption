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
    <script src="../JSAndCSS/   profile.js" defer></script>
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
    <div class="profile-container">
    <h4>Account Settings</h4>

    <div class="row">
        <div class="list-group-container">
            <div class="list-groups">
                <a class="list-group-item list-group-item-action" data-toggle="list" href="profile.php">General</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="profile.php">Change password</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="adoption_history.php">Adoption History</a>
                <a href="logout.php"><button class="logout-btn">Log out</button></a>
            </div>
        </div>
        
        
         <?php
               // Get the MemberID from the session
              $member_id = $_SESSION['MemberID'];

               // Query to get adoption applications for the logged-in member
               $query = "SELECT PetName, Status FROM adoptionapplication WHERE MemberID = '$member_id'";
               $result = mysqli_query($conn, $query);
              ?>
         <div class="content-section">
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
    
    
</div>

</body>

</html>   


