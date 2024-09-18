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
            <div class="btn">
                <i class="fas fa-times close-btn"></i>
            </div>
            <a href="admin.php">Dashboard</a>
            <a href="manage_users.php">Users</a>
            <a href="manage_pets.php">Pets</a>
            <a href="applications.php">Applications</a>
        </div>    
    </nav>
    <div class="pets-item">
        <h1>Add a New Pet</h1>
        <form action="add_pets.php" method="POST" enctype="multipart/form-data">
        <label for="name">Pet Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url"><br><br>

        <label for="age">Age (in years):</label>
        <input type="number" id="age" name="age"><br><br>

        <label for="species">Species:</label>
        <input type="text" id="species" name="species"><br><br>

        <label for="breed">Breed:</label>
        <input type="text" id="breed" name="breed"><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label for="price">Price (in USD):</label>
        <input type="number" step="0.01" id="price" name="price"><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Available">Available</option>
            <option value="Pending">Pending</option>
            <option value="Adopted">Adopted</option>
            <option value="Deceased">Deceased</option>
        </select><br><br>

        <label for="size">Size:</label>
        <input type="text" id="size" name="size"><br><br>

        <label for="colour">Colour:</label>
        <input type="text" id="colour" name="colour"><br><br>

        <input type="submit" name="submit" value="Add Pet">
        </form>
    </div>
    <?php
    // Include the config.php to get the connection details
    include 'config.php';

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get form data
        $name = $_POST['name'];
        $image_url = $_POST['image_url'];
        $age = $_POST['age'];
        $species = $_POST['species'];
        $breed = $_POST['breed'];
        $gender = $_POST['gender'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $size = $_POST['size'];
        $colour = $_POST['colour'];

        // Prepare SQL query to insert data into the Pets table
        $sql = "INSERT INTO Pets (Name, image_url, Age, PetSpecies, Breed, Gender, Price, Status, Size, Colour)
                VALUES ('$name', '$image_url', '$age', '$species', '$breed', '$gender', '$price', '$status', '$size', '$colour')";

        // Execute the query and check if it was successful
        if ($conn->query($sql) === TRUE) {
            echo "New pet added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>