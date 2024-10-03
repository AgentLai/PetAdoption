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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <title>Pet Haven |  About Us</title>
  </head>
  <body>
    <<nav>
    <a href="index.php" class="brand">
      <h1>Pet<b class="accent">Haven</b></h1>
    </a>
    <div class="menu">
        <div class="btn">
            <i class="fas fa-times close-btn"></i>
        </div>
        <a href="index.php">Home</a>
        <a href="AboutUs.php">About Us</a>
        <a href="Pets.php">Pets</a>
        <a href="FAQs.php">FAQ's</a>
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
<div class="box-area">      
      <div class="MoreAbout-Banner">  
         <h1>ABOUT US</h1>
      </div>
      
     <div class="MoreAbout">
        <div class="MoreAbout-wrapper">
            <h2>Learn More About Us!</h2>
          <p  data-bg-color="#cccccc" data-fg-color="black">
        <b>Pet<span style="color: #87c7af">Haven</span></b> is a sanctuary where the hopes of animals seeking their forever homes intertwine with the dreams of compassionate individuals eager to provide them with the love and care they deserve. 
        At <b>Pet<span style="color: #87c7af">Haven</span></b>, we believe that every pet is a cherished life waiting for a chance to flourish in a nurturing environment. 
        <br><br>
        Our platform serves as a bridge that connects these loving souls to those who are ready to open not just their homes but their hearts. 
        We feel that every pet deserves a safe and warm refuge, where they can thrive and truly belong.</p>
        <br><br>
          <h2> Why Pet<span style="color: #87c7af">Haven</span>? </h2>
        <p data-bg-color="#cccccc" data-fg-color="black">   
       Every year, approximately 7.6 million pets become strays, with about 3.4 million of them being cats in Malaysia alone. 
       Globally, the World Health Organization (WHO) estimates that there are over 200 million stray dogs.
       These staggering numbers highlight the urgent need for a solution.
        </p>
         <br><br>
          <h2> Our Mission </h2>
        <p class="reveal-type data-bg-color="#cccccc" data-fg-color="black">   
         At <b>Pet<span style="color: #87c7af">Haven</span></b>, we are dedicated to creating a significant impact on the lives of stray animals and the communities they inhabit.
         Our passion drives us to develop a seamless, user-friendly web application that addresses the critical issue of stray animals, ensuring that every animal in need finds a loving home.
         By leveraging cutting-edge technology and compassionate outreach, we aim to drastically reduce the number of abandoned and suffering stray animals.
         Our mission extends beyond mere adoption; we strive to educate the public on responsible pet ownership, advocate for humane treatment, and build a supportive network that fosters a kinder, more empathetic society. 
        </p>
      </div>
    </div>
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
