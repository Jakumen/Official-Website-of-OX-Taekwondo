document.addEventListener('DOMContentLoaded', function () {
    const imageGrid = document.getElementById('image-grid');
    const addImageButton = document.getElementById('add-image');
    const imageInput = document.getElementById('image-input');
    const confirmButton = document.getElementById('confirm-changes');

    // Load initial images from the database
    fetch('../PHP/fetch_images.php')
        .then(response => response.json())
        .then(data => {
            data.images.forEach(image => {
                addImageToGrid(image.url, image.id);
            });
        })
        .catch(error => console.error('Error fetching images:', error));

    // Function to add an image to the grid
    function addImageToGrid(url, id) {
        const wrapper = document.createElement('div');
        wrapper.classList.add('thumbnail-wrapper');
        wrapper.dataset.id = id;
        wrapper.innerHTML = `
            <img src="${url}" alt="Gallery Image">
            <button class="remove-btn">&times;</button>
        `;
        imageGrid.appendChild(wrapper);
    }

    // Event listener for adding a new image
    addImageButton.addEventListener('click', () => {
        imageInput.click();
    });

    imageInput.addEventListener('change', () => {
        const file = imageInput.files[0];
        if (!file) {
            alert('No file selected.');
            return;
        }

        const formData = new FormData();
        formData.append('image', file);

        fetch('../PHP/upload_image.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('Upload Response:', data); // Keep this for debugging
                if (data.success) {
                    addImageToGrid(data.url, data.id);
                    imageInput.value = ''; // Clear the input after successful upload
                } else {
                    // More detailed error message
                    const errorMsg = data.message || 'Unknown error occurred';
                    console.error('Upload failed:', errorMsg);
                    alert(`Upload failed: ${errorMsg}\nPlease try uploading with a different filename or contact support.`);
                }
            })
            .catch(error => {
                console.error('Error uploading image:', error);
                alert('An error occurred while uploading the image. Please try again.');
            });
    });

    // Event listener for removing an image
    imageGrid.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-btn')) {
            const wrapper = event.target.parentElement;
            const id = parseInt(wrapper.dataset.id, 10);

            fetch(`../PHP/delete_image.php?id=${id}`, { method: 'DELETE' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        wrapper.remove();
                    } else {
                        alert('Failed to delete the image.');
                    }
                })
                .catch(error => console.error('Error deleting image:', error));
        }
    });

    // Event listener for confirming changes
    confirmButton.addEventListener('click', () => {
        alert('Changes confirmed!');
    });
});
