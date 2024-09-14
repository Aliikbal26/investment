<?php
session_start();
require_once '../Database.php';

if (isset($_SESSION['user']['id'])) {
    header("Location: /invesment/portofolio.php");
    exit;
}

$user_id = $_SESSION['user']['id'];


// Query untuk mendapatkan data portofolio investasi pengguna yang login
$stmt = $pdo->prepare("SELECT investments.id, users.email, investments.investment_type, investments.amount, investments.investment_date
                       FROM investments 
                       INNER JOIN users ON investments.user_id = users.id
                       WHERE users.id = ?");
$stmt->execute([$user_id]);
$investments = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Load HTML template
include '../portofolio.php';
