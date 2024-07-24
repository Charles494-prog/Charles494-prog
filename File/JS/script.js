// script.js

// Function to display toast notifications
function showToast(msg) {
    let toastBox = document.getElementById('toastBox');
    const successMsg = '<i class="fas fa-check-circle"></i> Login Success!';
    const errorMsg = '<i class="fas fa-times-circle"></i> ';

    let toast = document.createElement('div');
    toast.className = 'toast';

    if (msg === 'success') {
        toast.classList.add('success');
        toast.innerHTML = successMsg;
    } else {
        toast.classList.add('error');
        toast.innerHTML = errorMsg + msg;
    }

    toastBox.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 6000);
}

// Example AJAX request to handle login form submission
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    let formData = new FormData(this);
    
    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showToast('success');
            setTimeout(() => {
                window.location.href = '../html/home.html';
            }, 3000); // Redirect after 3 seconds
        } else {
            showToast(data.message);
        }
    })
    .catch(error => {
        showToast('Error: ' + error.message);
    });
});
