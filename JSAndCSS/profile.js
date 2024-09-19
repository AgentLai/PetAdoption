
document.getElementById('uploadBtn').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
        };
        reader.readAsDataURL(file); // Convert the file to a data URL
    }
});

document.getElementById('resetBtn').addEventListener('click', function() {
    // Reset to default image or previous one
    document.getElementById('profileImage').src = 'https://bootdey.com/img/Content/avatar/avatar1.png';
});
