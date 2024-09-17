// Wait until the DOM is fully loaded before accessing elements
document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    var modal = document.getElementById("applicationModal");

    // Get the button that opens the modal using its ID
    var btn = document.getElementById("submitApplicationButton");

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
