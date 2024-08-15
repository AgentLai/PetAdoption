<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Pet Haven</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>
  <body> 
   <!-- NAVIGATION BAR/HEADER -->  
    <header> 
        <div class="nav-container">  
            <a href ="" class = "logo">Pet Haven</a>  
            <div class ="navbar">
                <a href="index.php">Home</a>
                <a href="AboutUs.php">About Us</a>
                <a href="Dogs.php">Dogs</a>
                <a href="Cats.php">Cats</a>
                <a href="Login.html">Login(Placeholder)</a>
            </div>
            <div class = "nav-icons">
                <a href="Login.php"><i class='bx bx-user'></i></a>
                <div class="menu-icons">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
        </div>
    </header> 
    <!-- TOP PAGE -->  
      <main>
          <div class="top-section"></div>
          
          <div class="top-title">
               <h1>PET HAVEN</h1>
               <p>The Number One Pet Adoption Website</p>
          </div>
    <!-- Main Part -->
<div class="main-container">  
    <div class="ui-body">
         <div class="ui-card">
              <img class="ui-image"src="Images/index_image(cat).jpg">
              <div class="description">
                  <h3>About Us</h3>
                  <p>Welcome to Pet Haven, a platform born out of a shared passion for the welfare and care of animals.</p>
                  <a href="AboutUs.php">Read More</a>
              </div>
         </div>
    </div>       
    
     <div class="ui-body">
         <div class="ui-card">
             <img class="ui-image"src="Images/index_image(dog).jpg">
              <div class="description">
                  <h3>Donate Here</h3>
                  <p>Want to contribute into helping us rescue more animals? Click here to find out more about it</p>
                  <a href="AboutUs.php">Read More</a>
              </div>
         </div>
    </div>         
    
     <div class="ui-body">
         <div class="ui-card">
             <img class="ui-image" src="Images/rabbit1.jpg">
              <div class="description">
                  <h3>Contact Us</h3>
                  <p>Contact us about anything by clicking here pookie <33</p>
                  <a href="AboutUs.php">Read More</a>
              </div>
         </div>
    </div>         
</div>             
             
   
      </main>      
     
       <?php
          
        ?>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                    <h4>Pet Haven</h4>
                    <ul>
                        <li><a href="AboutUs.php">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
                 <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                 <div class="footer-col">
                    <h4>adopt now</h4>
                    <ul>
                        <li><a href="#">dogs</a></li>
                        <li><a href="#">cats</a></li>
                        <li><a href="#">birds</a></li>  
                    </ul>
                </div>
                 <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>      
    </footer> 
  </body>
</html>
