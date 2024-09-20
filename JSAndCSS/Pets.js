// Function to open the modal by pet ID
function openModal(petID) {
    var modal = document.getElementById('modal-' + petID);
    modal.style.display = 'block';
}

// Function to close the modal by pet ID
function closeModal(petID) {
    var modal = document.getElementById('modal-' + petID);
    modal.style.display = 'none';
}

function openApplicationModal(petID, petName) {
     // Get the application modal
    const modal = document.getElementById('applicationModal');
    
    // Set the pet ID and pet name in the form's hidden fields
    document.getElementById('pet_id').value = petID;
    document.getElementById('pet_name').value = petName;

    // Display the modal
    modal.style.display = 'block';
}

function closeApplicationModal(petID) {
  // Hide the application modal
    document.getElementById('applicationModal').style.display = 'none';
}

// Attach event listener to close button
document.querySelector('.close-application').addEventListener('click', closeApplicationModal);

// Close the modal if the user clicks outside the modal content
window.onclick = function(event) {
    const modal = document.getElementById('applicationModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
