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
        <div class='pets-title'>
            <h1>Pets</h1>
        </div>

        <?php
        // Include the database connection file
        include 'config.php';

        // Fetch all pets from the database
        $pet_sql = "SELECT * FROM Pets";
        $pet_result = $conn->query($pet_sql);

        if ($pet_result->num_rows > 0) {
            echo "
            <table class='pets-table'>
                <thead>
                    <tr>
                        <th>Pet ID</th>
                        <th>Pet Name</th>
                        <th>Image</th>
                        <th>Age</th>
                        <th>Species</th>
                        <th>Breed</th>
                        <th>Gender</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";
            
            while ($row = $pet_result->fetch_assoc()) {
                $petID = $row['PetID'];
        
                // Pet info display in table rows
                echo "
                <tr>
                    <td>" . htmlspecialchars($row['PetID']) . "</td>
                    <td>" . htmlspecialchars($row['PetName']) . "</td>
                    <td><img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['PetName']) . "' style='width:50px;height:50px;'/></td>
                    <td>" . htmlspecialchars($row['Age']) . "</td>
                    <td>" . htmlspecialchars($row['PetSpecies']) . "</td>
                    <td>" . htmlspecialchars($row['Breed']) . "</td>
                    <td>" . htmlspecialchars($row['Gender']) . "</td>
                    <td>" . htmlspecialchars($row['PetDesc']) . "</td>
                    <td>" . htmlspecialchars($row['Status']) . "</td>
                    <td>
                        <button class='btn-primary' onclick='openEditModal($petID)'>View</button>
                    </td>
                </tr>";

                // Edit Modal for each pet
                echo "
            <div id='edit-modal-$petID' class='modal'>
                    <div class='modal-content'>
                    <span class='close' onclick='closeEditModal($petID)'>&times;</span>
                    <h3>Edit Pet</h3>
                    <form action='update_pet.php' method='POST'>
                        <input type='hidden' name='petID' value='$petID'>
                        
                        <label>Name:</label>
                        <input type='text' name='petName' value='" . htmlspecialchars($row['PetName']) . "' required>
                        
                        <label>Image URL:</label>
                        <input type='text' name='image_url' value='" . htmlspecialchars($row['image_url']) . "'>
                        
                        <label>Age:</label>
                        <input type='number' name='age' value='" . htmlspecialchars($row['Age']) . "' min='0'>
                        
                        <label>Species:</label>
                        <input type='text' name='petSpecies' value='" . htmlspecialchars($row['PetSpecies']) . "' required>
                        
                        <label>Breed:</label>
                        <input type='text' name='breed' value='" . htmlspecialchars($row['Breed']) . "' required>
                        
                        <label>Description:</label>
                        <input type='text' name='petDesc' value='" . htmlspecialchars($row['PetDesc']) . "' required>
                        
                        <label>Gender:</label>
                        <select name='gender' required>
                            <option value='Male'" . ($row['Gender'] == 'Male' ? ' selected' : '') . ">Male</option>
                            <option value='Female'" . ($row['Gender'] == 'Female' ? ' selected' : '') . ">Female</option>
                        </select>
                        
                        <label>Status:</label>
                        <select name='status' required>
                            <option value='Available'" . ($row['Status'] == 'Available' ? ' selected' : '') . ">Available</option>
                            <option value='Pending'" . ($row['Status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                            <option value='Unavailable'" . ($row['Status'] == 'Unavailable' ? ' selected' : '') . ">Unavailable</option>
                        </select>
                        
                        <button type='submit'>Update</button>
                    </form>
                </div>
            </div>";

            }
            echo "</div>";
        } else {
            echo "<p>No pets found.</p>";
        }
        ?>
    </div>

    <!-- Add Pet Modal -->
    <div id='add-modal' class='modal'>
        <div class='modal-content'>
            <span class='close' onclick='closeAddModal()'>&times;</span>
            <h3>Add Pet</h3>
            <form action='add_pet.php' method='POST'>
                <label>Name:</label>
                <input type='text' name='name' required>
                <label>Image URL:</label>
                <input type='text' name='image_url'>
                <label>Age:</label>
                <input type='number' name='age'>
                <label>Species:</label>
                <input type='text' name='petSpecies'>
                <label>Breed:</label>
                <input type='text' name='breed'>
                <label>Gender:</label>
                <select name='gender' required>
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                </select>
                <label>Status:</label>
                <select name='status' required>
                    <option value='Available'>Available</option>
                    <option value='Pending'>Pending</option>
                    <option value='Adopted'>Adopted</option>
                    <option value='Deceased'>Deceased</option>
                </select>
                <label>Description:</label>
                <input type='text' name='petDesc'> <!-- Added field -->
                <button type='submit'>Add Pet</button>
            </form>
        </div>
    </div>

    </div>
    <div class="add-pet">
        <button class='add-pet-btn' onclick='openAddModal()'>Add Pet</button>
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
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        // Configure it: POST-request for the URL /delete_pet.php
        xhr.open('POST', 'delete_pet.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        // Set up a function to handle the response
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Update the UI or provide feedback
                alert(xhr.responseText);
                if (xhr.responseText.includes('successfully')) {
                    document.getElementById('pet-' + petID).remove(); // Remove the pet from the list
                }
            } else {
                alert('Error: ' + xhr.statusText);
            }
        };
        
        // Send the request with the PetID
        xhr.send('PetID=' + encodeURIComponent(petID));
        }
    }



    function openAddModal() {
        document.getElementById('add-modal').style.display = "block";
    }

    function closeAddModal() {
        document.getElementById('add-modal').style.display = "none";
    }
</script>

</body>
</html>