<?php
session_start();
require_once '../Database.php';



// Cek apakah ID investasi ada di URL
if (isset($_GET['id'])) {
    $investment_id = $_GET['id'];

    // Query untuk menghapus data investasi berdasarkan ID
    $stmt = $pdo->prepare("DELETE FROM investments WHERE id = ? AND user_id = ?");
    $stmt->execute([$investment_id, $_SESSION['user']['id']]);

    // Jika penghapusan berhasil
    if ($stmt->rowCount()) {
        $_SESSION['message'] = "Investment deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete the investment.";
    }

    header("Location: /invesment/portofolio.php");
    exit;
} else {
    die("No investment ID specified.");
}
