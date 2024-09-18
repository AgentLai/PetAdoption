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
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
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
            <a href="admin.php">Dashboard</a>
            <a href="manage_user.php">Users</a>
            <a href="manage_pet.php">Pets</a>
            <a href="applications.php">Applications</a>
        </div>
      <div class="login-btn">
      <?php if (isset($_SESSION['AdminID'])): ?>
    <!-- Display username when logged in -->
      <button onclick="window.location.href='profile.php'">
      <i class="fa-regular fa-user"></i>
      <p><?php echo htmlspecialchars($_SESSION['Username']); ?></p>
    </button>
      <?php endif; ?>
    </div>  
    </nav>
    
<div class="member-list-container">
<?php
// Include database connection
$servername = "localhost";
$username = "root"; // Adjust with your DB username
$password = ""; // Adjust with your DB password
$dbname = "PetHaven"; // Adjust with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch members from the database
$user_sql = "SELECT MemberID, FirstName, LastName, Username, Email, DOB, image_url FROM member";
$user_result = $conn->query($user_sql);

echo "<div class='members-title'><h1>Members</h1></div>";

if ($user_result->num_rows > 0) {
    echo "<div class='members-list'>";
    while ($row = $user_result->fetch_assoc()) {
        $memberID = $row['MemberID'];
        echo "
        <div class='members-item' onclick='openModal($memberID)'>
            <img src='" . $row['image_url'] . "' alt='" . "' />
            <div class='members-name'>
                <h3>" . $row['FirstName'] . " " . $row['LastName'] . "</h3>
            </div>
            <p>Member ID: " . $row['MemberID'] . "</p>
            <p>Username: " . $row['Username'] . "</p>
            <p>Email: " . $row['Email'] . "</p>
            <p>DOB: " . $row['DOB'] . "</p>
        </div>

        <!-- Modal for Quick View -->
        <div id='modal-$memberID' class='modal'>
          <div class='modal-content'>
            <span class='close' onclick='closeModal($memberID)'>&times;</span>
            <div class='modal-body'>
              <div class='modal-info'>
                <h3>" . $row['FirstName'] . " " . $row['LastName'] . "</h3>
                <p>Member ID: " . $row['MemberID'] . "</p>
                <p>Username: " . $row['Username'] . "</p>
                <p>Email: " . $row['Email'] . "</p>
                <p>DOB: " . $row['DOB'] . "</p>
              </div>
            </div>
          </div>
        </div>";
    }

    echo "</div>";
} else {
    echo "<p>No members found matching the criteria.</p>";
}
?>
</div>

<div class="pet-list-container">
<?php
// Fetch pets from the database
$pet_sql = "SELECT PetID, PetName, PetSpecies, Breed, Age, Gender, Status, image_url, PetDesc FROM pets";
$result = $conn->query($pet_sql);

echo "<div class='pets-title'><h1>Pets</h1></div>";

if ($result === false) {
  // Handle the query error here
  echo "<p>Error executing query: " . mysqli_error($conn) . "</p>";
} else {
  if ($result->num_rows > 0) {
      echo "<div class='pets-list'>";
      while ($row = $result->fetch_assoc()) {
          $petID = $row['PetID'];
          echo "
          <div class='pets-item' onclick='openModal($petID)'>
              <img src='" . $row['image_url'] . "' alt='" . $row['PetName'] . "' />
              <div class='pets-name'>
                  <h3>" . $row['PetName'] . "</h3>
              </div>
              <p>Species: " . $row['PetSpecies'] . "</p>
              <p>Breed: " . $row['Breed'] . "</p>
              <p>Age: " . $row['Age'] . "</p>
              <p>Gender: " . $row['Gender'] . "</p>
              <p>Description: " . $row['PetDesc'] . "</p>
              <p>Status: " . $row['Status'] . "</p>
          </div>

        <!-- Modal for Quick View -->
        <div id='modal-$petID' class='modal'>
          <div class='modal-content'>
            <span class='close' onclick='closeModal($petID)'>&times;</span>
            <div class='modal-body'>
              <div class='modal-image'>
                <img src='" . $row['image_url'] . "' alt='" . $row['PetName'] . "' />
              </div>
              <div class='modal-info'>
                <h3>" . $row['PetName'] . "</h3>
                <p>Species: " . $row['PetSpecies'] . "</p>
                <p>Breed: " . $row['Breed'] . "</p>
                <p>Age: " . $row['Age'] . "</p>
                <p>Gender: " . $row['Gender'] . "</p>
                <p>Description: " . $row['PetDesc'] . "</p>
                <p>Status: " . $row['Status'] . "</p>
              </div>
            </div>
          </div>
        </div>";
    }

    echo "</div>";
} else {
    echo "<p>No pets found matching the criteria.</p>";
}
}

// Close connection
$conn->close();
?>
</div>

  <div class="admin-logout">
    <a href="logout.php"><button class="admin-logout-btn">Log out</button></a>
  </div>
   
        
    <footer id="footer">
      <div class="footer-container">
        <div class="footer-links">
          <h2>Quick Links</h2>
          <div class="link-container">
            <div class="links">
              <a href="index.php#about">About</a>
              <a href="index.php#pets">Pets</a>
            </div>
            <div class="links">
              <a href="index.php#requirements">Requirements</a>
              <a href="index.php#stories">Stories</a>
              <a href="FAQs.php#contact">Contact Us</a>
            </div>
          </div>
        </div>
        <div class="footer-brand">
          <h1>Pet<b class="accent">Haven</b></h1>
          <p>Find Your Purrfect furry friend Today!</p>
          <div class="socials">
            <a href="/"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="/"><i class="fa-brands fa-tiktok"></i></a>
            <a href="/"><i class="fa-brands fa-twitter"></i></a>
            <a href="/"><i class="fa-brands fa-linkedin-in"></i></a>   
          </div>
        </div>
        <div class="footer-contact-info">
          <div class="contact-info-item">
            <i class="fa-regular fa-envelope"></i>
            <p>pethaven@gmail.com</p>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-phone"></i>
            <p>+60 17-816 3645(Douglas)</p>
          </div>
        </div>
      </div>
        <p class="copyright">All Rights Reserved to <b>Pet Haven</b></p>
     </footer>
    <!-- Footer Section End -->

  </body>
</html>
 
