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
            <a href="applications.php">Applications</a>
        </div>    
    </nav>

<div class="member-list-container">
<?php
include("config.php");
$user_sql = "SELECT * FROM Member";
$user_result = $conn->query($user_sql);

echo "<div class='members-title'><h1>Members</h1></div>";

if ($user_result->num_rows > 0) {
    echo "
    <table class='members-table'>
        <thead>
            <tr>
                <th>Member ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>";
    
    while ($row = $user_result->fetch_assoc()) {
        $memberID = $row['MemberID'];

        // User info display in table rows
        echo "
        <tr>
            <td>" . htmlspecialchars($row['MemberID']) . "</td>
            <td>" . htmlspecialchars($row['FirstName']) . "</td>
            <td>" . htmlspecialchars($row['LastName']) . "</td>
            <td>" . htmlspecialchars($row['Username']) . "</td>
            <td>" . htmlspecialchars($row['Email']) . "</td>
            <td>" . htmlspecialchars($row['DOB']) . "</td>
            <td>" . htmlspecialchars($row['Status']) . "</td>
            <td>
                <button class='btn-primary' onclick='openViewModal($memberID)'>View</button>
            </td>
        </tr>";
        
        // Edit Modal for each user (kept outside the table)
        echo "
<div id='view-modal-$memberID' class='modal'>
    <div class='modal-content'>
        <span class='close' onclick='closeViewModal($memberID)'>&times;</span>
        <h3>View User</h3>
        <div class='view-user-details'>
            <p><strong>First Name:</strong> " . htmlspecialchars($row['FirstName']) . "</p>
            <p><strong>Last Name:</strong> " . htmlspecialchars($row['LastName']) . "</p>
            <p><strong>Username:</strong> " . htmlspecialchars($row['Username']) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($row['Email']) . "</p>
            <p><strong>Date of Birth:</strong> " . htmlspecialchars($row['DOB']) . "</p>
            <p><strong>Status:</strong> <span id='user-status-$memberID'>" . htmlspecialchars($row['Status']) . "</span></p>

            <!-- Reviews Section -->
            <h4>Reviews</h4>";

            $review_query = "SELECT * FROM Reviews WHERE MemberID = $memberID";
            $review_result = $conn->query($review_query);
            
            if ($review_result->num_rows > 0) {
                echo "<ul>";
                while ($review_row = $review_result->fetch_assoc()) {
                    echo "<li>Rating: " . htmlspecialchars($review_row['Rating']) . "/5, " . htmlspecialchars($review_row['Comments']) . " (" . htmlspecialchars($review_row['ReviewDate']) . ")</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No reviews found.</p>";
            }
            
            // Adoption History Section
            echo "<h4>Adoption History</h4>";
            
            $history_query = "SELECT p.PetName, ah.ApplicationDate, ah.Status FROM AdoptionHistory ah JOIN Pets p ON ah.PetID = p.PetID WHERE ah.MemberID = $memberID";
            $history_result = $conn->query($history_query);
            
            if ($history_result->num_rows > 0) {
                echo "<ul>";
                while ($history_row = $history_result->fetch_assoc()) {
                    echo "<li>Adopted Pet: " . htmlspecialchars($history_row['PetName']) . " on " . htmlspecialchars($history_row['ApplicationDate']) . " - Status: " . htmlspecialchars($history_row['Status']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No adoption history found.</p>";
            }

            // Adoption Applications Section
            echo "<h4>Adoption Applications</h4>";
            
            $app_query = "SELECT * FROM adoptionapplication WHERE MemberID = $memberID"; // Ensure the table name is correct
            $app_result = $conn->query($app_query);
            
            if ($app_result->num_rows > 0) {
                echo "<ul>";
                while ($app_row = $app_result->fetch_assoc()) {
                    echo "<li>Pet Name: " . htmlspecialchars($app_row['PetName']) . ", Status: " . htmlspecialchars($app_row['Status']) . " (Applied on: " . htmlspecialchars($app_row['ApplicationDate']) . ")</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No applications found.</p>";
            }
            
            // Blacklist Button Logic
            if ($row['Status'] !== 'blacklisted') {
                echo "<button class='btn-danger' onclick='blacklistUser($memberID)'>Blacklist</button>";
            } else {
                echo "<button class='btn-success' onclick='removeBlacklist($memberID)'>Remove Blacklist</button>";
                echo "<script>console.log('User is blacklisted');</script>";
            }

echo "
        </div>
    </div>
</div>";

    }
    echo "</tbody></table>";
} else {
    echo "<p>No users found.</p>";
}
?>
</div>
<script>
function openViewModal(memberID) {
    document.getElementById('view-modal-' + memberID).style.display = "block";
}

function closeViewModal(memberID) {
    document.getElementById('view-modal-' + memberID).style.display = "none";
}

function blacklistUser(memberID) {
    if (confirm('Are you sure you want to blacklist this user?')) {
        // AJAX call to update the status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "blacklist_user.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle response
                alert(xhr.responseText);
                // Optionally refresh the page or update the UI
                location.reload(); // Refresh the page to reflect changes
            }
        };
        xhr.send("memberID=" + memberID);
    }
}
function removeBlacklist(memberID) {
    console.log("Attempting to remove blacklist for member ID:", memberID);
    if (confirm("Are you sure you want to remove the blacklist status?")) {
        // Make an AJAX request to remove the blacklist status
        fetch('remove_blacklist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'memberID=' + memberID
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert("Blacklist status has been removed.");
                // Update the status in the modal
                document.querySelector(`#user-status-${memberID}`).innerHTML = 'active'; // Change to 'active' or whatever the new status should be
                // Replace the "Remove Blacklist" button with the "Blacklist" button
                document.querySelector(`#view-modal-${memberID} .btn-success`).outerHTML = `<button class='btn-danger' onclick='blacklistUser(${memberID})'>Blacklist</button>`;
            } else {
                alert("Error removing blacklist status. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    }
}

</script>

</body>
</html>
 