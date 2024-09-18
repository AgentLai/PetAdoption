/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Function to open the modal
function openModal(petID) {
    var modal = document.getElementById('modal-' + petID);
    modal.style.display = "block";
}

// Function to close the modal
function closeModal(petID) {
    var modal = document.getElementById('modal-' + petID);
    modal.style.display = "none";
}

// Close modal if user clicks outside of the modal content
window.onclick = function(event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        if (event.target == modals[i]) {
            modals[i].style.display = "none";
        }
    }
}


