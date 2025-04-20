<?php
session_start();
require_once '../db_conn.php'; // Your database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = 'All fields are required!';
        header('Location: ../index.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address!';
        header('Location: ../index.php');
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO reclamations (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        
        $_SESSION['success'] = 'Thank you for your message! We will get back to you soon.';
        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'An error occurred. Please try again later.';
        header('Location: ../index.php../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}