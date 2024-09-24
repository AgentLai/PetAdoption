<?php
    session_start();  // Start the session to access session variables
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
    <script src="../JSAndCSS/index_application.js" defer></script>
    <!-- For Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/2.0.0/scrollReveal.js"></script>
    <!-- For Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Link For Gsap -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
      integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Link For Gsap - Scroll Trigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/ScrollTrigger.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
      integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>

    <!-- Link For Lenis - Smooth Scrolling -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <!-- Link For Split Type -->
    <script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>

   
    <title>Pet Haven</title>
  </head>
  <body>
    <nav>
        <a href="index.php" class ="brand">
            <h1>Pet<b class="accent">Haven</b></h1>
        </a>
        <div class="menu">
            <div class="btn">
                <i class = "fas fa-times close-btn"></i>
            </div>
            <a href="index.php">Home</a>
            <a href="AboutUs.php">About Us</a>
            <a href="Pets.php">Pets</a>
            <a href="FAQs.php">FAQ's</a>
            <a href="index.php#stories">Stories</a>
        </div>

       <div class="login-btn">
        <?php if (isset($_SESSION['MemberID'])): ?>
            <!-- Display username when logged in -->
            <button onclick="window.location.href='profile.php'">
              <i class="fa-regular fa-user"></i>
              <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </button>
        <?php else: ?>
            <!-- Display login button when not logged in -->
            <button onclick="window.location.href='Login.php'">
              <p>Login</p>
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        <?php endif; ?>
    </div>
    <div class="btn">
        <i class="fas fa-bars menu-btn"></i>
    </div>
  </nav>
      
    <!--Hero Page Section-->
    <section class="heropage">
      <div class="hero-headlines">
        <h1>Find Your Perfect Furry Friend Today!</h1>
        <p>
          Discover Your Perfect Companion in Our Selection of Pets
          Available for Adoption.
        </p>
        <div class="hero-headlines-buttons">
            <a href="index.php#pets"><button class="btn-3">Our Pets</button></a>
            <a href="FAQs.php#contact"><button class="btn-4 btn-transparent">Contact Us!</button></a>
        </div>
      </div>
      <div class="hero-images">
          <img src="../Pictures/img/hero-img-1.png" alt="img">
        <img src="../Pictures/img/hero-img-2.png" alt="img">
        <img src="../Pictures/img/hero-img-3.png" alt="img">
      </div>
    </section>
    <!--About Section-->
    <section class="requirements" id="requirements">
      <div class="requirements-headlines">
        <h1>Our Process For Adoption</h1>
        <p> Our process is simple and filled with joy every step of the way!</p>

        <div class="r-item-container">
            <!--r item 1-->
            <div class="r-item">
              <div class="r-logo" style="background-color: #b9ff46">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
              </div>
              <h5>Registering an account</h5>
            </div>

            <!--r item 2-->
            <div class="r-item">
              <div class="r-logo" style="background-color: #fff846">
                <i class="fa-regular fa-newspaper"></i>
              </div>
              <h5>Submitting an application</h5>
            </div>

            <!--r item 3-->
            <div class="r-item">
              <div class="r-logo" style="background-color: #ff8846">
                <i class="fa-solid fa-paw"></i>
              </div>
              <h5>Meeting the pet in person</h5>
            </div>

            <!--r item 4-->
            <div class="r-item">
              <div class="r-logo" style="background-color: #46c7ff">
                <i class="fa-regular fa-file-zipper"></i>
              </div>
              <h5>Signing an adoption agreement</h5>
            </div>

            <!--r item 4-->
            <div class="r-item">
              <div class="r-logo" style="background-color: #4fffca">
                <i class="fa-solid fa-handshake"></i>
              </div>
              <h5>Congratulations on finding a match!</h5>
            </div>   
        </div>
      </div>
    <div class="requirements-footer">
    <img src="../Pictures/img/requirements-img.png" alt="img">
      
      
  </div>
    </section>

    <!-- Application Modal -->
<div id="applicationModal" class="application-modal">
    <div class="application-modal-content">
        <span class="close-application">&times;</span>
        <!-- Your form goes here -->
        <form id="applicationForm">
            <!-- Form fields -->
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" required><br>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" required><br>

            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea><br>

            <label for="reason">Why do you want to adopt this pet?</label>
            <textarea name="reason" id="reason" required></textarea><br>

            <button type="submit">Submit Application</button>
        </form>
    </div>
</div>
    
    <!--Pets Section-->
    <section class="pets" id="pets">
      <div class="pets-headlines">
        <i class="fa-solid fa-paw"></i>
        <h1>Meet Your Soul Pets</h1>
      </div>

      <div class="pets-collection">
        <div class="pet-item">
            <img src="../Pictures/Dogs/floofa(dog).jpg" alt="img" width="430px" height="430px"/>
          <h3>Henry</h3>
        </div>
        <div class="pet-item">
            <img src="../Pictures/Cats/Mimi(cat).jpg" alt="img" width="430px" height="430px"/>
          <h3>Mimi</h3>
        </div>
        <div class="pet-item">
            <img src="../Pictures/Dogs/muffin(dog).jpg" alt="img" width="430px" height="430px"/>
          <h3>Dan</h3>
        </div>
      </div>
       <a href="Pets.php"><button class="btn-3 btn-pets">
          Find More
        <i class="fa-solid fa-arrow-right-long"></i>
           </button></a>
    </section>
    <!--About Section-->
    <div class="about" id="about">
      <div class="about-headlines">
        <h1>About Us!</h1>
        <p data-bg-color="#cccccc" data-fg-color="black">
          PetHaven is not just a 
          <b>pet adoption website</b>; it's a haven for both pets in search of
          their forever homes and compassionate individuals ready to welcome 
          them with open arms.
        </p>

        <div class="about-info">
          <div class="about-info-item">
            <h5>100%</h5>
            <h6>Adoption Rate</h6>
          </div>
          <hr class="about-info-divider"/>
          <div class="about-info-item">
            <h5>100+</h5>
            <h6>Saved Pets</h6>
          </div>
          <hr class="about-info-divider"/>
          <div class="about-info-item">
            <h5>5 
              <i class="fa-regular fa-star"></i>
            </h5>
            <h6>Community Loved</h6>
          </div>
        </div>
        <a href="AboutUs.php"><button class="btn-3">Learn More</button></a>
      </div>
      <img src="../Pictures/img/about-img.png" alt="img">
    </div>
    
   <?php
// Connect to the database
include('config.php'); // Assuming you have a file that handles DB connection

// Query to get the latest 3 reviews
$sql = "SELECT R.Rating, R.Comments, R.ReviewDate, M.username 
        FROM Reviews R 
        JOIN Member M ON R.MemberID = M.MemberID 
        ORDER BY R.ReviewDate DESC 
        LIMIT 3";

$result = $conn->query($sql);
?>

<!-- Display Reviews Section -->
<div class="customer-reviews">
    <h2>Our Reviews</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <div class="reviews-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="review">
                    <div class="review-header">
                        <span class="review-rating">Rating: <?php echo htmlspecialchars($row['Rating']); ?>/5</span>
                        <span class="review-user"><?php echo htmlspecialchars($row['username']); ?></span>
                        <span class="review-date"><?php echo date('F j, Y', strtotime($row['ReviewDate'])); ?></span>
                    </div>
                    <p class="review-comment"><?php echo htmlspecialchars($row['Comments']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
            <div class="customer-review-btn-container">
    <a href="FAQs.php#reviews"><button class="review-btn">Submit a Review</button></a>
             </div>
    <?php else: ?>
        <div class="no-reviews">
            <p>No reviews available at the moment. Be the first to leave one!</p>
        </div>
         <div class="review-btn-container">
    <a href="FAQs.php#reviews"><button class="review-btn">Submit a Review</button></a>
         </div>
    <?php endif; ?>
</div>

<?php
// Close the connection
$conn->close();
?>

<!-- Testimonials Section End-->

<!-- Footer Section -->
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
