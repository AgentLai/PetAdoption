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
        <a href="index.php" class="brand">
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
        <a href="logout.php"><button class="admin-logout-btn">Log out</button></a>
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
$user_sql = "SELECT MemberID, FirstName, LastName, Username, Email, DOB, Status FROM member";
$user_result = $conn->query($user_sql);

$member_count = $user_result->num_rows; // Get the count of members

echo "<div class='members-title'><h1>Members: ($member_count)</h1></div>";

if ($user_result->num_rows > 0) {
  echo "
  <table class='members-table'>
      <thead>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Member ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>DOB</th>
              <th>Status</th>
          </tr>
      </thead>
      <tbody>";

  while ($row = $user_result->fetch_assoc()) {
      $memberID = $row['MemberID'];
      echo "
      <tr onclick='openModal($memberID)'>
          <td>" . htmlspecialchars($row['FirstName']) . "</td>
          <td>" . htmlspecialchars($row['LastName']) . "</td>
          <td>" . htmlspecialchars($row['MemberID']) . "</td>
          <td>" . htmlspecialchars($row['Username']) . "</td>
          <td>" . htmlspecialchars($row['Email']) . "</td>
          <td>" . htmlspecialchars($row['DOB']) . "</td>
          <td>" . htmlspecialchars($row['Status']) . "</td>
      </tr>

      <!-- Modal for Quick View -->
      <div id='modal-$memberID' class='modal'>
        <div class='modal-content'>
          <span class='close' onclick='closeModal($memberID)'>&times;</span>
          <div class='modal-body'>
            <div class='modal-info'>
              <h3>" . htmlspecialchars($row['FirstName']) . " " . htmlspecialchars($row['LastName']) . "</h3>
              <p>Member ID: " . htmlspecialchars($row['MemberID']) . "</p>
              <p>Username: " . htmlspecialchars($row['Username']) . "</p>
              <p>Email: " . htmlspecialchars($row['Email']) . "</p>
              <p>DOB: " . htmlspecialchars($row['DOB']) . "</p>
            </div>
          </div>
        </div>
      </div>";
  }

  echo "
      </tbody>
  </table>";
} else {
  echo "<p>No members found matching the criteria.</p>";
}
?>
</div>

<div class="pet-list-container">
<?php
// Fetch pets from the database
// Fetch pets from the database
$pet_sql = "SELECT PetID, PetName, PetSpecies, 
            CASE 
                WHEN Dog_breed IS NOT NULL THEN Dog_breed 
                ELSE Cat_breed 
            END AS Breed, 
            Age, Gender, Status, image_url, PetDesc, Disabilities 
            FROM Pets";

$result = $conn->query($pet_sql);

$pet_count = $result->num_rows; // Get the count of pets

echo "<div class='pets-title'><h1>Pets: ($pet_count)</h1></div>";


if ($result === false) {
    // Handle the query error here
    echo "<p>Error executing query: " . mysqli_error($conn) . "</p>";
} else {
    if ($result->num_rows > 0) {
        echo "
        <table class='pets-table'>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Description</th>
                    <th>Disabilities</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";
        
        while ($row = $result->fetch_assoc()) {
            $petID = $row['PetID'];
            echo "
            <tr>
                <td><img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['PetName']) . "' width='100' /></td>
                <td>" . htmlspecialchars($row['PetName']) . "</td>
                <td>" . htmlspecialchars($row['PetSpecies']) . "</td>
                <td>" . htmlspecialchars($row['Breed']) . "</td>
                <td>" . htmlspecialchars($row['Age']) . "</td>
                <td>" . htmlspecialchars($row['Gender']) . "</td>
                <td>" . htmlspecialchars($row['PetDesc']) . "</td>
                <td>" . htmlspecialchars($row['Disabilities'] ?? 'None') . "</td>
                <td>" . htmlspecialchars($row['Status']) . "</td>
            </tr>

            <!-- Modal for Quick View -->
            <div id='modal-$petID' class='modal'>
                <div class='modal-content'>
                    <span class='close' onclick='closeModal($petID)'>&times;</span>
                    <div class='modal-body'>
                        <div class='modal-image'>
                            <img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['PetName']) . "' />
                        </div>
                        <div class='modal-info'>
                            <h3>" . htmlspecialchars($row['PetName']) . "</h3>
                            <p><strong>Species:</strong> " . htmlspecialchars($row['PetSpecies']) . "</p>
                            <p><strong>Breed:</strong> " . htmlspecialchars($row['Breed']) . "</p>
                            <p><strong>Age:</strong> " . htmlspecialchars($row['Age']) . "</p>
                            <p><strong>Gender:</strong> " . htmlspecialchars($row['Gender']) . "</p>
                            <p><strong>Description:</strong> " . htmlspecialchars($row['PetDesc']) . "</p>
                            <p><strong>Disabilities:</strong> " . htmlspecialchars($row['Disabilities'] ?? 'None') . "</p>
                            <p><strong>Status:</strong> " . htmlspecialchars($row['Status']) . "</p>
                        </div>
                    </div>
                </div>
            </div>";
        }

        echo "
            </tbody>
        </table>";
    } else {
        echo "<p>No pets found matching the criteria.</p>";
    }
}




// Close connection
$conn->close();
?>
</div>
        

  </body>
</html>
 
