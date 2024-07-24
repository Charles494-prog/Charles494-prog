<?php

//I wanna add the super global $_Session here.

session_start();

//Database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $conn = new mysqli('localhost', 'root', '', 'lspdb');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        //I want this to redirect to home.html and simultaneosly execute the success notification.
        header('Location: ../html/home.html');
        exit;
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Incorrect username or password'));
        //I want this to redirect back to main.html and simultaneosly execute the failed notification.
        header('Location: ../html/main.html');
        exit;
    }
    
    $stmt->close();
    $conn->close();
}
?>
