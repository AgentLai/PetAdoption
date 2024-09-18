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
            <a href="application.php">Applications</a>
        </div>    
    </nav>

<div class="member-list-container">
<?php
include("config.php");
$user_sql = "SELECT * FROM Member";
$user_result = $conn->query($user_sql);

echo "<div class='members-title'><h1>Members</h1></div>";

if ($user_result->num_rows > 0) {
    echo "<div class='members-list'>";
    
    while ($row = $user_result->fetch_assoc()) {
        $memberID = $row['MemberID'];
        // User info display
        echo "
        <div class='members-item'>
            <div class='members-info'>
                <img src='" . $row['image_url'] . "' alt='" . "' />
            <div class='members-name'>
                <h3>" . $row['FirstName'] . " " . $row['LastName'] . "</h3>
            </div>
            <p>Member ID: " . $row['MemberID'] . "</p>
            <p>Username: " . $row['Username'] . "</p>
            <p>Email: " . $row['Email'] . "</p>
            <p>DOB: " . $row['DOB'] . "</p>
            </div>

            <div class='members-actions'>
              <button class='btn-3' onclick='openEditModal($memberID)'>Edit</button>
              <button class='btn-3' onclick='deleteUser($memberID)'>Delete</button>
            </div>
        </div>
        ";

        // Edit Modal for each user
        echo "
        <div id='edit-modal-$memberID' class='modal'>
            <div class='modal-content'>
                <span class='close' onclick='closeEditModal($memberID)'>&times;</span>
                <h3>Edit User</h3>
                <form action='update_user.php' method='POST'>
                    <input type='hidden' name='memberID' value='$memberID'>
                    <label>First Name:</label>
                    <input type='text' name='firstName' value='" . $row['FirstName'] . "' required>
                    <label>Last Name:</label>
                    <input type='text' name='lastName' value='" . $row['LastName'] . "' required>
                    <label>Username:</label>
                    <input type='text' name='username' value='" . $row['Username'] . "' required>
                    <label>Email:</label>
                    <input type='email' name='email' value='" . $row['Email'] . "' required>
                    <label>DOB:</label>
                    <input type='date' name='dob' value='" . $row['DOB'] . "' required>
                    <button type='submit'>Update</button>
                </form>
            </div>
        </div>
        ";
    }
    echo "</div>";
} else {
    echo "<p>No users found.</p>";
}
?>
</div>
<script>
function openEditModal(memberID) {
    document.getElementById('edit-modal-' + memberID).style.display = "block";
}

function closeEditModal(memberID) {
    document.getElementById('edit-modal-' + memberID).style.display = "none";
}

function deleteUser(memberID) {
    if (confirm('Are you sure you want to delete this user?')) {
        window.location.href = 'delete_user.php?id=' + memberID; // Redirect to delete script
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
 