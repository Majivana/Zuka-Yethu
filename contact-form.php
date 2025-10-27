<?php
// contact-form.php

// Set content type for JSON response
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

// Sanitize and validate input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
    exit;
}

// Email configuration
$to = 'info@zukayethu.co.za';
$subject = 'New Contact Form Submission - Zuka Yethu';
$headers = [
    'From: ' . $email,
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Email body
$body = "You have received a new message from your website contact form.\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Message:\n$message\n";

// Send email
if (mail($to, $subject, $body, implode("\r\n", $headers))) {
    echo json_encode(['status' => 'success', 'message' => 'Thank you! Your message has been sent.']);
} else {
    error_log('Contact form email failed to send');
    echo json_encode(['status' => 'error', 'message' => 'Failed to send message. Please try again later.']);
}