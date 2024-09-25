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
    <link rel="stylesheet" href="style.css" />
    <!-- link To JS -->
    <script src="IndexJava.js" defer></script>
    <!-- For Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
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
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
      integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Link For Lenis - Smooth Scrolling -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <!-- Link For Split Type -->
    <script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>
    <script src="Faq.js" defer></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <title>Pet Haven | FAQ's </title>
  </head>
  <body>
    <nav>
        <a href="index.html" class ="brand">
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
       <div class="faq-Banner">
         <h1>FAQ's</h1>
      </div>
      <div class="faq-section"> 
            <div class="faq">
              <div class="question">
                <h3>How can I adopt a pet?</h3>
                  
                 <svg width="20" height="15" viewBox="0 0 42 25">
                   <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecaps="round"/>
                 </svg>
                  
              </div>
              <div class="answer">
                  <p>
                     <i class="fa-solid fa-bone"></i> To adopt a pet, browse our available pets online, choose one that fits your family and lifestyle, and fill out the adoption application.
                      After submission, our team will review your application and contact you to discuss the next steps, which may include a meet-and-greet with the pet.
                  </p>
              </div>
          </div>
            <div class="faq">
              <div class="question">
                <h3>What are the adoption fees?</h3>
                  
                 <svg width="20" height="15" viewBox="0 0 42 25">
                   <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecaps="round"/>
                 </svg>
                  
              </div>
              <div class="answer">
                  <p>
                    <i class="fa-solid fa-cat"></i>  At PetHaven fees are not involved when adopting. Instead we have fees that provides vaccinations, spaying/neutering, and other veterinary care for the pet, 
                    which we would discuss after the application of a pet is submitted.
                  </p>
              </div>
          </div>
            <div class="faq">
              <div class="question">
                <h3>Can I return a pet after adoption?</h3>
                  
                 <svg width="20" height="15" viewBox="0 0 42 25">
                   <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecaps="round"/>
                 </svg>
                  
              </div>
              <div class="answer">
                  <p>
                      <i class="fa-solid fa-dog"></i> We understand that sometimes adoptions don’t work out. If you need to return a pet, please contact us immediately.
                     We’ll work with you to find the best solution, whether it’s returning the pet to us or finding a more suitable home.
                  </p>
              </div>
          </div>
          <div class="faq">
              <div class="question">
                <h3>What should I consider before adopting a pet?</h3>
                  
                 <svg width="20" height="15" viewBox="0 0 42 25">
                   <path d="M3 3L21 21L39 3" 
                    stroke="white" 
                    stroke-width="7" 
                    stroke-linecaps="round"
                    />
                 </svg>
                  
              </div>
              <div class="answer">
                  <p>
                      <i class="fa-solid fa-person"></i> Consider your lifestyle, the time you can dedicate to a pet, your living environment, and your budget. 
                      Pets require time, attention, and financial resources for food, healthcare, and other needs.
                  </p>
              </div>
          </div>
      </div>
      
 <!-- Contact Section -->     
 <div class="Contact-container" id="contact">
               <div class="rich-wrapper--hero-vertical flex w-full flex-col justify-center text-center">
                   <h1>Contact us</h1>
                   <p>Looking to contact <i class="fa-solid fa-phone-volume"></i> <b>Pet<span style="color: #87c7af">Haven</span></b> ? There's a few ways to do it—check out all your options below.</p>
               </div>
          
     <div class="faq-contact-info">
         
              <div class="faq-contact-box">
                  <div class="contact-phone">    
              <h4><i class="fa-solid fa-phone"></i>Phone Number</h4>
              <p>
                  +60 17-816 3645(Douglas)
              </p>
                  </div>
              </div>    
         
              <div class="faq-contact-box">
                   <div class="contact-email">
              <h4><i class="fa-regular fa-envelope"></i>Email</h4>
              <p>
                   pethaven@gmail.com
              </p>
                   </div>
              </div>    
          
     </div>     
      
 <!-- Location Map -->    
 <div class="Map-section">
     <div class="Map-box">
         <h1>Our Location</h1>
       
     </div>
     <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d1984.0800623329678!2d116.094487!3d5.9726747!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNcKwNTgnMjAuOSJOIDExNsKwMDUnNDIuNSJF!5e0!3m2!1sen!2smy!4v1725699026013!5m2!1sen!2smy"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
 </div>
      
 
 <!-- Review -->     
 <div class="review-section" id="reviews">
  <h2>Leave a Review</h2>
  <?php if (isset($_SESSION['MemberID'])): ?>
    <form id="reviewForm" method="POST" action="submitReview.php">
      <label for="rating">Rating (1 to 5):</label>
      <select name="rating" id="rating" required>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      </select>  
      <label for="comments">Your Review:</label>
      <textarea id="comments" name="comments" rows="4" required></textarea>
      <button type="submit">Submit Review</button>
    </form>
  <?php else: ?>
    <p>Please <a href="Login.php">log in</a> to leave a review.</p>
  <?php endif; ?>
</div>
     
      
      
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
