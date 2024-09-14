<?php
session_start();
require_once '../Database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $investment_type = $_POST['investment_type'];
    $amount = $_POST['amount'];
    $investment_date = $_POST['investment_date'];

    $user_id = $_SESSION['user']['id'];

    $stmt = $pdo->prepare("INSERT INTO investments (user_id, investment_type, amount, investment_date) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $investment_type, $amount, $investment_date])) {
        header("Location: ../portofolio.php");
        exit;
    } else {
        $error = "Error adding investment.";
    }
}

include '../add_invest.php';
