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

  <div class="user-search-container">
    <form method="GET" action="">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="petName" value="<?= isset($_GET['firstName']) ? htmlspecialchars($_GET['firstName']) : '' ?>">

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" value="<?= isset($_GET['lastName']) ? htmlspecialchars($_GET['lastName']) : '' ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">Any</option>
            <option value="Active" <?= isset($_GET['status']) && $_GET['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= isset($_GET['status']) && $_GET['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            <option value="Blacklisted" <?= isset($_GET['status']) && $_GET['status'] == 'Blacklisted' ? 'selected' : '' ?>>Blacklisted</option>
        </select>

        <button type="submit">Search</button>
    </form>
</div>



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
    </nav>

<div class="member-list-container">
<?php
include("config.php");
$searchConditions = [];

// Check if the search form is submitted and append conditions
if (isset($_GET['firstName']) && !empty($_GET['firstName'])) {
    $searchConditions[] = "FirstName LIKE '%" . $conn->real_escape_string($_GET['firstName']) . "%'";
}
if (isset($_GET['lastName']) && !empty($_GET['lastName'])) {
    $searchConditions[] = "LastName LIKE '%" . $conn->real_escape_string($_GET['lastName']) . "%'";
}
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $searchConditions[] = "Email = '" . $conn->real_escape_string($_GET['email']) . "'";
}
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $searchConditions[] = "Status = '" . $conn->real_escape_string($_GET['status']) . "'";
}

// Construct the SQL query with conditions
$searchQuery = "SELECT * FROM Member";
if (count($searchConditions) > 0) {
    $searchQuery .= " WHERE " . implode(' AND ', $searchConditions);
}

$user_result = $conn->query($searchQuery);

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
        // Assuming you already have the member's data in $row
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
            <p><strong>Status:</strong> <span id='user-status-$memberID'>" . htmlspecialchars($row['Status']) . "</span></p>";

            // Display Blacklist Reason if status is 'Blacklisted'
            if ($row['Status'] === 'Blacklisted') {
                echo "<p><strong>Blacklist Reason:</strong> " . htmlspecialchars($row['BlacklistReason']) . "</p>";
            }

            // Reviews Section
            echo "<h4>Reviews</h4>";

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
            if ($row['Status'] !== 'Blacklisted') {
                echo "<button class='btn-danger' onclick='blacklistUser($memberID)'>Blacklist</button>";
            } else {
                echo "<script>console.log('User is blacklisted');</script>";
            }
echo "
    <!-- Blacklist Reason Modal -->
<div id='blacklist-reason-modal' class='modal'>
    <div class='modal-content'>
        <span class='close' onclick='closeBlacklistReasonModal()'>&times;</span>
        <h3>Blacklist User</h3>
        <p>Please provide a reason for blacklisting:</p>
        <textarea id='blacklist-reason' placeholder='Enter reason here...' rows='4' cols='50'></textarea>
        <button class='btn-danger' onclick='confirmBlacklist()'>Confirm Blacklist</button>
    </div>
</div>
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
    currentMemberID = memberID; // Store the member ID globally
    document.getElementById('blacklist-reason-modal').style.display = "block"; // Show the blacklist reason modal
}

function closeBlacklistReasonModal() {
    document.getElementById('blacklist-reason-modal').style.display = "none"; // Close the blacklist reason modal
}

function confirmBlacklist() {
    const reason = document.getElementById('blacklist-reason').value;

    if (reason.trim() === "") {
        alert("Please provide a reason for blacklisting.");
        return;
    }

    if (confirm('Are you sure you want to blacklist this user?')) {
        // Close the modal after confirming
        closeBlacklistReasonModal();

        // AJAX call to update the status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "blacklist_user.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle response
                alert(xhr.responseText);
                location.reload(); // Refresh the page to reflect changes
            }
        };
        xhr.send("memberID=" + currentMemberID + "&reason=" + encodeURIComponent(reason));
    }
}
</script>

</body>
</html>
 
