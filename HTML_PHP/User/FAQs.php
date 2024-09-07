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
    <title>Pet Haven</title>
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

        <button class = "btn-2" onclick="window.location.href='register.php'">
        <p>Sign Up Now</p>
        <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </button>

        <div class="btn">
            <i class="fas fa-bars menu-btn"></i>
        </div>
    </nav>
      <div class="faq-section">
          <h2 class="title">FAQs</h2>
          
          <div class="faq">
              <div class="question">
                <h3>How can I adopt a pet?</h3>
                  
                 <svg width="20" height="15" viewBox="0 0 42 25">
                   <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecaps="round"/>
                 </svg>
                  
              </div>
              <div class="answer">
                  <p>
                      To adopt a pet, browse our available pets online, choose one that fits your family and lifestyle, and fill out the adoption application.
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
                     Adoption fees vary based on the type and age of the pet.
                     Generally, adoption fees cover vaccinations, spaying/neutering, and other veterinary care. Specific fees are listed on each pet’s profile page.
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
                     We understand that sometimes adoptions don’t work out. If you need to return a pet, please contact us immediately.
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
                      Consider your lifestyle, the time you can dedicate to a pet, your living environment, and your budget. 
                      Pets require time, attention, and financial resources for food, healthcare, and other needs.
                  </p>
              </div>
          </div>
      </div>
      <div class="Contact-container">
          <div>
               <div class="rich-wrapper--hero-vertical flex w-full flex-col justify-center text-center">
                   <h1>Contact us</h1>
                   <p>Looking to contact PetHaven? There's a few ways to do it—check out all your options below.</p>
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
          <a href="index.php#footer">Contact Us</a>
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
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

