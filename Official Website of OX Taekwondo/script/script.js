document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('medical-certificate');
    const acceptButton = document.getElementById('accept');
    const form = document.getElementById('termsForm');

    // Listen for file input change
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            acceptButton.disabled = false; // Enable the button if a file is selected
        } else {
            acceptButton.disabled = true;  // Disable the button if no file is selected
        }
    });

    // Handle form submission and redirect
    form.addEventListener('accept', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Simulate form validation and processing
        if (fileInput.files.length > 0) {
            // Redirect to another page (e.g., "success.html")
            window.location.href = "Registration.php";
        } else {
            alert("Please upload a file before proceeding.");
        }
    });
});
document.getElementById('termsForm').addEventListener('accept', function(event) {
        event.preventDefault();
        if (termsCheckbox.checked) {
            alert("Thank you for accepting the terms and conditions.");
            // Here you can add further actions, like sending data to a server
        } else {
            alert("Please accept the terms and conditions.");
        }
    });

function goBack() {
    window.history.back();
}


