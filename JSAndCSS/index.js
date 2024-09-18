
//Navbar
const navbar = document.querySelector("nav");
window.addEventListener("scroll", ()=>
    navbar.classList.toggle("sticky", window.scrollY>0)  
);

const menu = document.querySelector(".menu");
const toggleMenu = () => menu.classList.toggle("active");

document.querySelector(".menu-btn").addEventListener("click",toggleMenu);
document.querySelector(".menu-btn").addEventListener("click",toggleMenu);

document
    .querySelectorAll(".menu a")
    .forEach((link) => link.addEventListener("click", toggleMenu));

//LENIS FOR SMOOTH SCROLLING
const lenis = new Lenis();
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);
lenis.on("scroll", ScrollTrigger.update);
gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

//SCROLL REVEAL
const sr = ScrollReveal({
    origin: "bottom",
    distance: "40px",
    duration: 800,
    delay: 200,
    easing: "ease-in-out"
    });

    gsap.to("nav", {
        opacity: 1,
        duration: 2
    });
    sr.reveal(".hero-headlines h1");
    sr.reveal(".hero-headlines p",{delay: "500"});
    sr.reveal(".hero-headlines-buttons",{delay: "1000"});
    gsap.from(".hero-images img", {
        opacity: 0,
        duration: 1,
        stagger: 0.5
    });
    sr.reveal(".requirements-headlines h1");
    sr.reveal(".requirements-headlines p", {delay:"500"});
    sr.reveal(".requirements img", {delay:"500"});
    sr.reveal(".r-item-container", {delay:"1000"});
    sr.reveal(".application-button",{delay: "700"});
    sr.reveal(".btn-3",{delay: "500"});
    sr.reveal(".pets-headlines");
    sr.reveal(".pet-item h3");
    sr.reveal(".about-headlines");
    sr.reveal(".about img");
    sr.reveal(".testimonials h1", {delay:"500"});
    sr.reveal(".testimonials h6");
    sr.reveal(".testimony-item", {delay:"1000"});
    sr.reveal(".footer-brand");
    sr.reveal(".footer-links", {delay:"500", origin:"left"});
    sr.reveal(".footer-contact-info", {delay:"500", origin:"right"});
    sr.reveal(".copyright", {delay:"600"});

//GSAP SCROLL TRIGGER
gsap.registerPlugin(ScrollTrigger);
ScrollTrigger.create({
    trigger: ".heropage",
    start:"top center",
    end: "center center",
    scrub: 1,
    onToggle: (self) => {
        if(self.isActive){
            gsap.to(".hero-images img", { scale : 1, gap: "64px", duration: 0.5});
        } else {
            gsap.to(".hero-images img", {
                scale: "1.2",
                gap: "35px",
                duration: 0.5
            });
        }
    }
});

// ABOUT SPLIT TYPES
const splitTypes = document.querySelectorAll(".reveal-type");
splitTypes.forEach((char, i) => {
    const bg = char.dataset.bgColor;
    const fg = char.dataset.fgColor;

    const text = new SplitType(char, {types: "char"});

    gsap.fromTo(
        text.chars,
        {
            color: bg
        },
        {
            color: fg,
            duration: 0.3,
            stagger: 0.02,
            scrollTrigger: {
                trigger: char,
                start: "top 80%",
                end: "top 20%",
                scrub: true,
                markers: false,
                toggleActions: "play play reverse reverse"
            }
        }
    );
});


// Wait until the DOM is fully loaded before accessing elements
document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    var modal = document.getElementById("applicationModal");

    // Get the button that opens the modal
    var btn = document.querySelector(".application-button button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close-application")[0];

    // Function to open the modal
    function openApplicationModal() {
        if (modal) {
            modal.style.display = "block";
        } else {
            console.error("Modal not found!");
        }
    }

    // Check if the button exists and add click event
    if (btn) {
        btn.addEventListener("click", openApplicationModal);
    }

    // When the user clicks on <span> (x), close the modal
    if (span) {
        span.onclick = function() {
            modal.style.display = "none";
        };
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});


// Submit form   

document.getElementById('applicationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    const formData = new FormData(this);

    fetch('submit_application.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Handle the response from the server
    .then(data => {
        alert('Application submitted successfully!'); // Replace this with any success message
        console.log(data); // For debugging
        document.getElementById('applicationModal').style.display = 'none'; // Close the modal
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
