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

    <div class="pet-list-container">
        <div class='pets-title'>
            <h1>Pets</h1>
        </div>
        <div class="pet-search-container">
    <form method="GET" action="">
        <label for="petName">Pet Name:</label>
        <input type="text" name="petName" id="petName" value="<?= isset($_GET['petName']) ? htmlspecialchars($_GET['petName']) : '' ?>">

         <label for="species">Species:</label>
        <select name="species" id="species"> <!-- Corrected name -->
            <option value="">Any</option>
            <option value="Dog" <?= isset($_GET['species']) && $_GET['species'] == 'Dog' ? 'selected' : '' ?>>Dog</option>
            <option value="Cat" <?= isset($_GET['species']) && $_GET['species'] == 'Cat' ? 'selected' : '' ?>>Cat</option>
        </select>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">Any</option>
            <option value="Male" <?= isset($_GET['gender']) && $_GET['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= isset($_GET['gender']) && $_GET['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        </select>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">Any</option>
            <option value="Available" <?= isset($_GET['status']) && $_GET['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Pending" <?= isset($_GET['status']) && $_GET['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Unavailable" <?= isset($_GET['status']) && $_GET['status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
        </select>

        <button type="submit">Search</button>
    </form>
</div>
  

        <?php
        // Include the database connection file
        include 'config.php';
        
        $searchConditions = [];

// Check if the search form is submitted and append conditions
if (isset($_GET['petName']) && !empty($_GET['petName'])) {
    $searchConditions[] = "PetName LIKE '%" . $conn->real_escape_string($_GET['petName']) . "%'";
}
if (isset($_GET['species']) && !empty($_GET['species'])) {
    $searchConditions[] = "PetSpecies = '" . $conn->real_escape_string($_GET['species']) . "'";
}
if (isset($_GET['gender']) && !empty($_GET['gender'])) {
    $searchConditions[] = "Gender = '" . $conn->real_escape_string($_GET['gender']) . "'";
}
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $searchConditions[] = "Status = '" . $conn->real_escape_string($_GET['status']) . "'";
}

// Construct the SQL query with conditions
$searchQuery = "SELECT * FROM Pets";
if (count($searchConditions) > 0) {
    $searchQuery .= " WHERE " . implode(' AND ', $searchConditions);
}

$pet_result = $conn->query($searchQuery);
    $pet_sql = "SELECT * FROM Pets";
$pet_result = $conn->query($pet_sql);

if ($pet_result->num_rows > 0) {
    echo "<div class='add-pet'>
            <button class='add-pet-btn' onclick='openAddModal()'>Add Pet</button>
          </div>";
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
                <th>Disabilities</th>
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
            <td>" . htmlspecialchars($row['Dog_breed'] ?? $row['Cat_breed']) . "</td>
            <td>" . htmlspecialchars($row['Gender']) . "</td>
            <td>" . htmlspecialchars($row['PetDesc']) . "</td>
            <td>" . htmlspecialchars($row['Disabilities']) . "</td>
            <td>" . htmlspecialchars($row['Status']) . "</td>
            <td>
                <button class='btn-primary' onclick='openViewModal($petID)'>View</button>
            </td>
        </tr>";

        // View Modal for each pet
        echo "
    <div id='view-modal-$petID' class='modal'>
        <div class='modal-content'>
            <span class='close' onclick='closeViewModal($petID)'>&times;</span>
            <h4>View Pet</h4>
            <div class='modal-body'>
                <div class='modal-image'>
                    <img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['PetName']) . "' style='width:200px;height:200px;'/>
                </div>
                <div class='modal-info'>
                    <p><strong>Name:</strong> " . htmlspecialchars($row['PetName']) . "</p>
                    <p><strong>Age:</strong> " . htmlspecialchars($row['Age']) . "</p>
                    <p><strong>Species:</strong> " . htmlspecialchars($row['PetSpecies']) . "</p>
                    <p><strong>Breed:</strong> " . htmlspecialchars($row['Dog_breed'] ?? $row['Cat_breed']) . "</p>
                    <p><strong>Gender:</strong> " . htmlspecialchars($row['Gender']) . "</p>
                    <p><strong>Description:</strong> " . htmlspecialchars($row['PetDesc']) . "</p>
                    <p><strong>Disabilities:</strong> " . htmlspecialchars($row['Disabilities'] ?? 'None') . "</p>
                    <p><strong>Status:</strong> " . htmlspecialchars($row['Status']) . "</p>
                </div>
            </div>
            <button class='btn-primary' onclick='openEditModal($petID)'>Edit</button>
        </div>
    </div>";

        // Edit Modal for each pet
        echo "
<div id='edit-modal-$petID' class='modal'>
    <div class='modal-content'>
        <span class='close' onclick='closeEditModal($petID)'>&times;</span>
        <h3>Edit Pet</h3>
        <form action='update_pet.php' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='petID' value='$petID'>
            
            <label>Name:</label>
            <input type='text' name='petName' value='" . htmlspecialchars($row['PetName']) . "' required>
            
            <label>Image:</label>
            <input type='file' name='image' accept='image/*'>
            <p>Current Image: <img src='" . htmlspecialchars($row['image_url']) . "' alt='Current Image' style='max-width: 200px;'></p>
            
            <label>Age:</label>
            <input type='number' name='age' value='" . htmlspecialchars($row['Age']) . "' min='0'>
            
            <label>Species:</label>
            <input type='text' name='petSpecies' value='" . htmlspecialchars($row['PetSpecies']) . "' required readonly>
            
            <label>Breed:</label>
            <select name='breed' required>
                <option value=''>" . ($row['Dog_breed'] ? htmlspecialchars($row['Dog_breed']) : htmlspecialchars($row['Cat_breed'])) . "</option>";

            // Check species and adjust breed options
            if ($row['PetSpecies'] == 'Dog') {
                echo "
                <option value='Labrador'" . ($row['Dog_breed'] == 'Labrador' ? ' selected' : '') . ">Labrador</option>
                <option value='Beagle'" . ($row['Dog_breed'] == 'Beagle' ? ' selected' : '') . ">Beagle</option>
                <option value='Bulldog'" . ($row['Dog_breed'] == 'Bulldog' ? ' selected' : '') . ">Bulldog</option>
                <option value='Poodle'" . ($row['Dog_breed'] == 'Poodle' ? ' selected' : '') . ">Poodle</option>
                <option value='German Shepherd'" . ($row['Dog_breed'] == 'German Shepherd' ? ' selected' : '') . ">German Shepherd</option>
                <option value='Golden Retriever'" . ($row['Dog_breed'] == 'Golden Retriever' ? ' selected' : '') . ">Golden Retriever</option>
                <option value='Border Collie'" . ($row['Dog_breed'] == 'Border Collie' ? ' selected' : '') . ">Border Collie</option>
                <option value='Corgi'" . ($row['Dog_breed'] == 'Corgi' ? ' selected' : '') . ">Corgi</option>
                <option value='Others'" . ($row['Dog_breed'] == 'Others' ? ' selected' : '') . ">Others</option>";
            } elseif ($row['PetSpecies'] == 'Cat') {
                echo "
                <option value='Persian'" . ($row['Cat_breed'] == 'Persian' ? ' selected' : '') . ">Persian</option>
                <option value='Siamese'" . ($row['Cat_breed'] == 'Siamese' ? ' selected' : '') . ">Siamese</option>
                <option value='Maine Coon'" . ($row['Cat_breed'] == 'Maine Coon' ? ' selected' : '') . ">Maine Coon</option>
                <option value='Bengal'" . ($row['Cat_breed'] == 'Bengal' ? ' selected' : '') . ">Bengal</option>
                <option value='Sphynx'" . ($row['Cat_breed'] == 'Sphynx' ? ' selected' : '') . ">Sphynx</option>
                <option value='Domestic Shorthair'" . ($row['Cat_breed'] == 'Domestic Shorthair' ? ' selected' : '') . ">Domestic Shorthair</option>";
            }
            echo "
            </select>
            
            <label>Description:</label>
            <input type='text' name='petDesc' value='" . htmlspecialchars($row['PetDesc']) . "' required>
            
            <label>Gender:</label>
            <select name='gender' required>
                <option value='Male'" . ($row['Gender'] == 'Male' ? ' selected' : '') . ">Male</option>
                <option value='Female'" . ($row['Gender'] == 'Female' ? ' selected' : '') . ">Female</option>
            </select>
            
            <label>Disabilities:</label>
            <select name='disabilities'>
                <option value=''>" . htmlspecialchars($row['Disabilities']) . "</option>
                <option value='Blind'>Blind</option>
                <option value='Deaf'>Deaf</option>
                <option value='Limp'>Limp</option>
                <option value='Missing Leg'>Missing Leg</option>
                <option value='Other'>Other</option>
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
    echo "</tbody></table>";
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
        <form action='add_pet.php' method='POST' enctype="multipart/form-data">
            <label>Name:</label>
            <input type='text' name='name' required>

            <label>Image:</label>
            <input type='file' name='image' accept="image/*">

            <label>Age:</label>
            <input type='number' name='age' min='0' required>

            <label>Species:</label>
            <select name='petSpecies' id='petSpecies' required onchange="toggleBreedFields()">
                <option value='Dog'>Dog</option>
                <option value='Cat'>Cat</option>
            </select>

            <div id="dogBreed">
                <label>Breed (Dog):</label>
                <select name='Dog_breed'>
                    <option value=''>Select a breed</option>
                    <option value='Labrador'>Labrador</option>
                    <option value='Beagle'>Beagle</option>
                    <option value='Bulldog'>Bulldog</option>
                    <option value='Poodle'>Poodle</option>
                    <option value='German Shepherd'>German Shepherd</option>
                    <option value='Golden Retriever'>Golden Retriever</option>
                    <option value='Border Collie'>Border Collie</option>
                    <option value='Corgi'>Corgi</option>
                    <option value='Others'>Others</option>
                </select>
            </div>

            <div id="catBreed" style="display: none;">
                <label>Breed (Cat):</label>
                <select name='Cat_breed'>
                    <option value=''>Select a breed</option>
                    <option value='Persian'>Persian</option>
                    <option value='Siamese'>Siamese</option>
                    <option value='Maine Coon'>Maine Coon</option>
                    <option value='Bengal'>Bengal</option>
                    <option value='Sphynx'>Sphynx</option>
                    <option value='Domestic Shorthair'>Domestic Shorthair</option>
                    <option value='Others'>Others</option>
                </select>
            </div>

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
            <input type='text' name='petDesc' required>

            <label>Disabilities:</label>
            <select name='disabilities'>
                <option value=''>None</option>
                <option value='Blind'>Blind</option>
                <option value='Deaf'>Deaf</option>
                <option value='Limp'>Limp</option>
                <option value='Missing Leg'>Missing Leg</option>
                <option value='Other'>Other</option>
            </select>

            <button type='submit'>Add Pet</button>
        </form>
    </div>
</div>

<script>
function toggleBreedFields() {
    var species = document.getElementById('petSpecies').value;
    var dogBreedDiv = document.getElementById('dogBreed');
    var catBreedDiv = document.getElementById('catBreed');

    if (species === 'Dog') {
        dogBreedDiv.style.display = 'block';
        catBreedDiv.style.display = 'none';
    } else {
        dogBreedDiv.style.display = 'none';
        catBreedDiv.style.display = 'block';
    }
}
</script>

    <script>
    function openViewModal(petID) {
    document.getElementById('view-modal-' + petID).style.display = "block";
    }

    function closeViewModal(petID) {
    document.getElementById('view-modal-' + petID).style.display = "none";
    }

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