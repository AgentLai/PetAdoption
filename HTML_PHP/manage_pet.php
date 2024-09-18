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
    </nav>

<div class="pet-list-container">
<?php
// Include the database connection file
include 'config.php';

// Fetch all pets from the database
$pet_sql = "SELECT * FROM Pets";
$pet_result = $conn->query($pet_sql);


echo "<div class='members-title'><h1>Pets</h1></div>";

if ($pet_result->num_rows > 0) {
    echo "<div class='pets-list'>";
    
    while ($row = $pet_result->fetch_assoc()) {
        $petID = $row['PetID'];
        // Pet info display
        echo "
        <div class='pets-item'>
            <div class='pets-info'>
                <h4>" . htmlspecialchars($row['PetName']) . "</h4>
                <p>Species: " . htmlspecialchars($row['PetSpecies']) . "</p>
                <p>Breed: " . htmlspecialchars($row['Breed']) . "</p>
                <p>Age: " . htmlspecialchars($row['Age']) . "</p>
                <p>Gender: " . htmlspecialchars($row['Gender']) . "</p>
                <p>Status: " . htmlspecialchars($row['Status']) . "</p>
                <img src='" . htmlspecialchars($row['image_url']) . "' alt='Pet Image' style='max-width: 150px;'>
            </div>

            <div class='pets-actions'>
                <button class='btn-3' onclick='openEditModal($petID)'>Edit</button>
                <button class='btn-3' onclick='deletePet($petID)'>Delete</button>
            </div>
        </div>
        ";

        // Edit Modal for each pet
        echo "
        <div id='edit-modal-$petID' class='modal'>
            <div class='modal-content'>
                <span class='close' onclick='closeEditModal($petID)'>&times;</span>
                <h3>Edit Pet</h3>
                <form action='update_pet.php' method='POST'>
                    <input type='hidden' name='petID' value='$petID'>
                    <label>Name:</label>
                    <input type='text' name='name' value='" . htmlspecialchars($row['PetName']) . "' required>
                    <label>Image URL:</label>
                    <input type='text' name='image_url' value='" . htmlspecialchars($row['image_url']) . "'>
                    <label>Age:</label>
                    <input type='number' name='age' value='" . htmlspecialchars($row['Age']) . "'>
                    <label>Species:</label>
                    <input type='text' name='petSpecies' value='" . htmlspecialchars($row['PetSpecies']) . "'>
                    <label>Breed:</label>
                    <input type='text' name='breed' value='" . htmlspecialchars($row['Breed']) . "'>
                    <label>Gender:</label>
                    <select name='gender' required>
                        <option value='Male'" . ($row['Gender'] == 'Male' ? ' selected' : '') . ">Male</option>
                        <option value='Female'" . ($row['Gender'] == 'Female' ? ' selected' : '') . ">Female</option>
                    </select>
                    <select name='status' required>
                        <option value='Available'" . ($row['Status'] == 'Available' ? ' selected' : '') . ">Available</option>
                        <option value='Pending'" . ($row['Status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                        <option value='Adopted'" . ($row['Status'] == 'Adopted' ? ' selected' : '') . ">Adopted</option>
                        <option value='Deceased'" . ($row['Status'] == 'Deceased' ? ' selected' : '') . ">Deceased</option>
                    </select>
                    <button type='submit'>Update</button>
                </form>
            </div>
        </div>
        ";
    }
    echo "</div>";
} else {
    echo "<p>No pets found.</p>";
}
?>
</div>

<script>
function openEditModal(petID) {
    document.getElementById('edit-modal-' + petID).style.display = "block";
}

function closeEditModal(petID) {
    document.getElementById('edit-modal-' + petID).style.display = "none";
}

function deletePet(petID) {
    if (confirm('Are you sure you want to delete this pet?')) {
        window.location.href = 'delete_pet.php?id=' + petID; // Redirect to delete script
    }
}
</script>

</body>
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