<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!-- Use for responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link To CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- link To JS -->
    <script src="index.js" defer></script>
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
            <a href="index.php#requirements">About Us</a>
            <a href="index.php#pets">Pets</a>
            <a href="">Contact Us</a>
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
    <!--Hero Page Section-->
    <section class="heropage">
      <div class="hero-headlines">
        <h1>Find Your Perfect Furry Friend Today!</h1>
        <p>
          Discover Your Perfect Companion in Our Selection of Pets
          Available for Adoption.
        </p>
        <div class="hero-headlines-buttons">
          <button class="btn-3">Our Pets</button>
          <button class="btn-3 btn-transparent">Contact Us!</button>
        </div>
      </div>
      <div class="hero-images">
        <img src="img/hero-img-1.png" alt="img">
        <img src="img/hero-img-2.png" alt="img">
        <img src="img/hero-img-3.png" alt="img">
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
      <img src="img/requirements-img.png" alt="img">
    </section>

    <!--Pets Section-->
    <section class="pets" id="pets">
      <div class="pets-headlines">
        <i class="fa-solid fa-paw"></i>
        <h1>Meet Your Soul Pets</h1>
      </div>

      <div class="pets-collection">
        <div class="pet-item">
          <img src="img/pet-item-1.png" alt="img"/>
          <h3>Woofsalot</h3>
        </div>
        <div class="pet-item">
          <img src="img/pet-item-2.png" alt="img"/>
          <h3>Dexter</h3>
        </div>
        <div class="pet-item">
          <img src="img/pet-item-3.png" alt="img"/>
          <h3>Leo</h3>
        </div>
      </div>
      <button class="btn-3 btn-pets">
        <p>Find More</p>
        <i class="fa-solid fa-arrow-right-long"></i>
      </button>
    </section>
    <!--About Section-->
    <div class="about" id="about">
      <div class="about-headlines">
        <h1>About Us!</h1>
        <p class="reveal-type" data-bg-color="#cccccc" data-fg-color="black">
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
        <button class="btn-3">Get Started!</button>
      </div>
      <img src="img/about-img.png" alt="img">
    </div>
    <!--Testimonials Sections-->
    <div class="testimonials" id="stories">
      <h6>OUR REVIEWS</h6>
      <h1>What Our Customers Say</h1>

      <div class="testimony-container">
        <!--testimony item 1-->
        <div class="testimony-item">
          <div class="testimony-people">
            <div class="testimony-name">
              <img src="img/testimony-image-1.png" alt="img"/>
              <div class="testimony-name-item">
                <h4>Lylia Johnson</h4>
                <p>Garfield's Owner</p>
              </div>
            </div>
            <i class="fa-solid fa-quote-right"></i>
          </div>
          <p class="testimony-text">
            I had an incredible experience adopting my new furry friend from Pet Haven! 
            The staff was kind, knowledgeable, and truly cared about matching me with the perfect pet. 
            The adoption process was smooth and well-organized, and they provided all the support I needed 
            to help my pet settle into their new home. My new companion has brought so much joy into my life, 
            and I couldn't be happier with Pet Haven. Highly recommend!
          </p>
        </div>
        <!--testimony item 2-->
        <div class="testimony-item">
          <div class="testimony-people">
            <div class="testimony-name">
              <img src="img/testimony-image-2.png" alt="img"/>
              <div class="testimony-name-item">
                <h4>Jason Lesley</h4>
                <p>Benedict's Owner</p>
              </div>
            </div>
            <i class="fa-solid fa-quote-right"></i>
          </div>
          <p class="testimony-text">
            I recently adopted my cat, Benedict, through Pet Haven. The staff was incredibly helpful, 
            answering all my questions and ensuring Luna was the perfect match for my home. 
            The adoption process was smooth and well-organized, and I felt supported every step of the way. 
            Benedict has brought so much joy into my life, and I'm so grateful to Pet Haven for helping us find each other. 
          </p>
        </div>
        <!--testimony item 3-->
        <div class="testimony-item">
          <div class="testimony-people">
            <div class="testimony-name">
              <img src="img/testimony-image-3.png" alt="img"/>
              <div class="testimony-name-item">
                <h4>Lutpii Lo</h4>
                <p>Terizla's Owner</p>
              </div>
            </div>
            <i class="fa-solid fa-quote-right"></i>
          </div>
          <p class="testimony-text">
            I adopted my new furry friend through Pet Haven, and the experience was fantastic! 
            The staff was incredibly helpful and made the entire process smooth and stress-free. 
            They truly care about the well-being of the animals and ensured I was well-prepared to bring my new pet home. 
            My dog settled in quickly and has become a beloved member of the family. 
            I highly recommend Pet Haven to anyone looking to adopt a pet!
          </p>
        </div>
      </div>
    </div>
<!-- Testimonials Section End-->

<!-- Footer Section -->
 <footer id="footer">
  <div class="footer-container">
    <div class="footer-links">
      <h2>Quick Links</h2>
      <div class="link-container">
        <div class="links">
          <a href="index.html#about">About</a>
          <a href="index.html#pets">Pets</a>
        </div>
        <div class="links">
          <a href="index.html#requirements">Requirements</a>
          <a href="index.html#stories">Stories</a>
          <a href="index.html#footer">Contact Us</a>
        </div>
      </div>
    </div>
    <div class="footer-brand">
      <h1>Pet<b class="accent">Haven</b></h1>
      <p>Find Your Purrfect Furry friend Today!</p>
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
        <p>+60 17-816 3645(Douglas's phone) Call him xoxo</p>
      </div>
    </div>
  </div>
    <p class="copyright">All Rights Reserved to<b>Pet Haven</b></p>
 </footer>
<!-- Footer Section End -->

  </body>
</html>
