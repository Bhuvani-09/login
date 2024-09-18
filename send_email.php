<?php
session_start();
require_once "controllerUserData.php"; // Ensure your database connection is here

// Check if user is logged in
if(isset($_SESSION['email'])) {
    $receiver = $_SESSION['email']; // Email of the logged-in user
    $subject = "Welcome to our Website";
    $body = "Hi " . htmlspecialchars($_SESSION['name']) . ",\n\nThank you for signing up! We are excited to have you on board.";
    $sender = "From: sender@example.com"; // Replace with your sender email address

    // Validate email address
    if (filter_var($receiver, FILTER_VALIDATE_EMAIL)) {
        if(mail($receiver, $subject, $body, $sender)){
            echo "Email sent successfully to $receiver";
        } else {
            echo "Sorry, failed while sending mail!";
        }
    } else {
        echo "Invalid email address!";
    }
} else {
    echo "No user is logged in!";
}
?>
