<?php
session_start();
include("config.php");

// Fetch all submitted adoption applications
$query = "SELECT * FROM adoptionapplication WHERE Status = 'Pending'";
$result = mysqli_query($conn, $query);

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
            <a href="admin.php">Dashboard</a>
            <a href="manage_user.php">Users</a>
            <a href="manage_pet.php">Pets</a>
            <a href="applications.php">Applications</a>
        </div>    
    </nav>
    
    <div class="application-container">
        <h2>Adoption Applications</h2>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="application-table">';
            echo '<thead><tr><th>Pet Name</th><th>Full Name</th><th>Phone</th><th>Address</th><th>Actions</th></tr></thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                $applicationID = $row['ApplicationID'];
                $petName = htmlspecialchars($row['PetName']);
                $fullName = htmlspecialchars($row['FullName']);
                $phone = htmlspecialchars($row['PhoneNumber']);
                $address = htmlspecialchars($row['Address']);
                $reason = htmlspecialchars($row['ReasonForAdopting']);
                
                echo "<tr>
                        <td>$petName</td>
                        <td>$fullName</td>
                        <td>$phone</td>
                        <td>$address</td>
                        <td>
                            <button class='btn-primary' onclick='openModal(\"modal$applicationID\")'>View</button>
                        </td>
                      </tr>";

                // Modal for quick view
                echo "<div class='apply-modal' id='modal$applicationID'>
                        <div class='apply-modal-content'>
                           <span class='modal-close' onclick='closeModal(\"modal$applicationID\")'>&times;</span>
                            <div class='apply-modal-header'>
                                <h5 class='apply-modal-title'>Adoption Application for $petName</h5>
                            </div>
                            <div class='apply-modal-body'>
                                <p><strong>Full Name:</strong> $fullName</p>
                                <p><strong>Phone:</strong> $phone</p>
                                <p><strong>Address:</strong> $address</p>
                                <p><strong>Reason for Adopting:</strong> $reason</p>
                            </div>
                            <div class='apply-modal-footer'>
                                <form method='POST' action='process_application.php'>
                                    <input type='hidden' name='application_id' value='$applicationID'>
                                    <button type='submit' name='approve' class='btn-success'>Approve</button>
                                    <button type='submit' name='deny' class='btn-danger'>Deny</button>
                                </form>
                            </div>
                        </div>
                      </div>";
            }

            echo '</tbody></table>';
        } else {
            echo "<p>No pending adoption applications found.</p>";
        }
        ?>

    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
    </script>

</body>
</html>
