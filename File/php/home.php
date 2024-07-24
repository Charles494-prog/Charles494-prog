<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform your login validation here
    // For simplicity, let's assume a hardcoded check
    if ($username === 'admin' && $password === 'password') {
        // Login successful
        $response = array('status' => 'success');
    } else {
        // Login failed
        $response = array('status' => 'error');
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
