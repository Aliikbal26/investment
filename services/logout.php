<?php
session_start();

// Menghapus semua variabel sesi
$_SESSION = [];
session_destroy();

header("Location: /invesment/login.php");
exit;
