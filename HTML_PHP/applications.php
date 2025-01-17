<?php
session_start();
include("config.php");

// Initialize the search variable
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Construct the base query
$query = "SELECT * FROM adoptionapplication WHERE Status = 'Pending'";

// Check if the search term is provided
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $query .= " AND (PetName LIKE '%$search%' OR FullName LIKE '%$search%')";
}

$result = mysqli_query($conn, $query);
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Applications</title>
    <link rel="stylesheet" href="../JSAndCSS/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="index.php" class="brand">
            <h1>Pet<b class="accent">Haven</b></h1>
        </a>
        <div class="menu">
            <a href="admin.php">Dashboard</a>
            <a href="manage_user.php">Users</a>
            <a href="manage_pet.php">Pets</a>
            <a href="applications.php">Applications</a>
        </div>    
    </nav>
    
   <div class="application-search-container">
    <form method="GET" action="">
        <label for="search">Search Applications:</label>
        <input type="text" name="search" id="search" placeholder="Enter Pet Name or Full Name" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" required>
        <button type="submit" class="btn-primary">Search</button>
    </form>
</div>

    
    <div class="application-container">
        <h2>Pending Adoption Applications</h2>

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
