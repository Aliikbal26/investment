<?php
session_start();
require_once '../Database.php';

function login($email, $password, $pdo)
{
    // Prepare SQL query with placeholders to prevent SQL injection
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify password if user exists
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Simple validation to check if email and password are not empty
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        $user = login($email, $password, $pdo);

        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
            header("Location: /invesment/services/portofolioService.php");
            exit;
        } else {
            $error = "Invalid email or password.";
            header("Location: /invesment/login.php");
        }
    } else {
        // Handle invalid input
        $error = "Please enter a valid email and password.";
        header("Location: /invesment/login.php");
    }
}

include '../login.php';
