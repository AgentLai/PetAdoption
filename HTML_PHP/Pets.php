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
    <script src="Pets.js" defer></script>
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

        <div class="login-btn">
        <?php if (isset($_SESSION['MemberID'])): ?>
            <!-- Display username when logged in -->
            <button onclick="window.location.href='profile.php'">
              <i class="fa-regular fa-user"></i>
              <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </button>
        <?php else: ?>
            <!-- Display login button when not logged in -->
            <button onclick="window.location.href='Login.php'">
              <p>Login</p>
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        <?php endif; ?>
    </div>
    <div class="btn">
        <i class="fas fa-bars menu-btn"></i>
    </div>
  </nav>
      
 <div class="filter-container">
  <aside class="filters">   
  <form method="GET" action="Pets.php">
      <!-- Filter by Species -->
      <h3>Species</h3>
      <label>
        <input type="checkbox" name="species[]" value="Dog" 
          <?php if(in_array('Dog', $_GET['species'] ?? [])) echo 'checked'; ?>> Dogs
      </label><br>
      <label>
        <input type="checkbox" name="species[]" value="Cat" 
          <?php if(in_array('Cat', $_GET['species'] ?? [])) echo 'checked'; ?>> Cats
      </label><br>

      <!-- Filter by Gender -->
      <h3>Gender</h3>
      <label>
        <input type="checkbox" name="gender[]" value="Male"
          <?php if(in_array('Male', $_GET['gender'] ?? [])) echo 'checked'; ?>> Male
      </label><br>
      <label>
        <input type="checkbox" name="gender[]" value="Female"
          <?php if(in_array('Female', $_GET['gender'] ?? [])) echo 'checked'; ?>> Female
      </label><br>

      <!-- Filter by Status -->
      <h3>Status</h3>
      <label>
        <input type="checkbox" name="status[]" value="Available"
          <?php if(in_array('Available', $_GET['status'] ?? [])) echo 'checked'; ?>> Available
      </label><br>
      <label>
        <input type="checkbox" name="status[]" value="Pending"
          <?php if(in_array('Pending', $_GET['status'] ?? [])) echo 'checked'; ?>> Pending
      </label><br>
      <label>
        <input type="checkbox" name="status[]" value="Adopted"
          <?php if(in_array('Adopted', $_GET['status'] ?? [])) echo 'checked'; ?>> Adopted
      </label><br>

      <!-- Submit button -->
      <button type="submit" class="filter-btn">Apply Filters</button>
    </form>
  </aside>

  <!-- Your pet list code remains the same -->
  <div class="pet-list-container">
    <!-- PHP code to display filtered pets -->
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

// Fetch filter values from the URL and handle multiple selections
$species = isset($_GET['species']) ? $_GET['species'] : [];
$gender = isset($_GET['gender']) ? $_GET['gender'] : [];
$status = isset($_GET['status']) ? $_GET['status'] : [];

// Build SQL query with filters
$sql = "SELECT * FROM Pets";
$conditions = [];

// Check species filter
if (!empty($species)) {
    $species_list = implode("','", array_map([$conn, 'real_escape_string'], $species));
    $conditions[] = "PetSpecies IN ('$species_list')";
}

// Check gender filter
if (!empty($gender)) {
    $gender_list = implode("','", array_map([$conn, 'real_escape_string'], $gender));
    $conditions[] = "Gender IN ('$gender_list')";
}

// Check status filter
if (!empty($status)) {
    $status_list = implode("','", array_map([$conn, 'real_escape_string'], $status));
    $conditions[] = "Status IN ('$status_list')";
}

// Append conditions to SQL query
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$result = $conn->query($sql);

// Check if there are results and display them
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
                <p>Description: " . $row['description'] . "</p>
                <p>Status: " . $row['Status'] . "</p>
                    
                 <!-- Inquire Us Button -->
                  <div class='inquire-container'>
                     <a href='index.php#requirements'><div class='inquire-btn'>Inquire Us</div></a>
                 </div>   
              </div>
            </div>
          </div>
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

