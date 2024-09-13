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

    <title>Pet Haven | Pets </title>
  </head>
  <body>
    <nav>
        <a href="index.html" class ="brand">
            <h1>Pet<b class="accent">Haven</b></h1>
        </a>
        <div class="menu">
            <div class="btn">
                <i class = "fas fa-times close-btn"></i>
            </div>
            <a href="index.php">Home</a>
            <a href="AboutUs.php">About Us</a>
            <a href="Pets.php">Pets</a>
            <a href="FAQs.php">FAQ's</a>
            <a href="index.php#stories">Stories</a>
        </div>

        <button class = "btn-2" onclick="window.location.href='register.php'">
        <p>Sign Up Now</p>
        <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </button>

        <div class="btn">
            <i class="fas fa-bars menu-btn"></i>
        </div>
    </nav>
      
 <div class="filter-container">
  <aside class="filters">
    <h3>Filter by Species</h3>
    <a class="filter-btn" href="Pets.php?species=Dog">Dogs</a>
    <a class="filter-btn" href="Pets.php?species=Cat">Cats</a>
    <a class="filter-btn" href="Pets.php">All</a> <!-- Reset filter -->

    <h3>Filter by Gender</h3>
    <a class="filter-btn" href="Pets.php?gender=Male">Male</a>
    <a class="filter-btn" href="Pets.php?gender=Female">Female</a>
  </aside>

     <div class="pet-list-container">     
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

// Fetch filter values from the URL
    $species = isset($_GET['species']) ? $conn->real_escape_string($_GET['species']) : '';
    $gender = isset($_GET['gender']) ? $conn->real_escape_string($_GET['gender']) : '';
    
 // Build SQL query with filters
    $sql = "SELECT * FROM Pets";
    $conditions = [];

    if (!empty($species)) {
        $conditions[] = "PetSpecies = '$species'";
    }
    if (!empty($gender)) {
        $conditions[] = "Gender = '$gender'";
    }

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

$result = $conn->query($sql);

// Check if there are results and display them
if ($result->num_rows > 0) {
    echo "<div class='pets-list'>";
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='pets-item'>
            <img src='" . $row['image_url'] . "' alt='" . $row['Name'] . "' />
            <h3>" . $row['Name'] . "</h3>
            <p>Species: " . $row['PetSpecies'] . "</p>
            <p>Breed: " . $row['Breed'] . "</p>
            <p>Age: " . $row['Age'] . "</p>
            <p>Gender: " . $row['Gender'] . "</p>
            <p>Price: $" . $row['Price'] . "</p>
            <p>Status: " . $row['Status'] . "</p>
        </div>
        ";
    }
    echo "</div>";
} else {
    echo "<p>No pets found matching the criteria.</p>";
}

// Close connection
$conn->close();
?>      
     </div>
 </div>     
 
       
           
      
   <!-- Footer Section -->
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

