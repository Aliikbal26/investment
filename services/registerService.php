<?php
session_start();
require_once '../Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $typeAccount = isset($_POST['typeAccount']) ? implode(',', $_POST['typeAccount']) : '';

    $birthday = $_POST['birthday'];
    $nationality = $_POST['nationality'];
    $residance = $_POST['residance'];
    $addressOne = $_POST['addressOne'];
    $addressTwo = $_POST['addressTwo'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $country = $_POST['country'];
    $employmentStatus = $_POST['employmentStatus'];
    $jobTitle = $_POST['jobTitle'];
    $phoneWork = $_POST['phoneWork'];
    $phoneMobile = $_POST['phoneMobile'];
    $phoneHome = $_POST['phoneHome'];
    $alternativeEmail = $_POST['alternativeEmail'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Simpan ke database 
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, first_name, last_name, type_account, date_of_birth, nationality, country_residence, address_one, address_two, city, state, zip_code, country, employement_status, job_title, phone_work, phone_mobile, phone_home, alternative_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $values = [$username, $email, $hashedPassword, $firstName, $lastName, $typeAccount, $birthday, $nationality, $residance, $addressOne, $addressTwo, $city, $state, $zipCode, $country, $employmentStatus, $jobTitle, $phoneWork, $phoneMobile, $phoneHome, $alternativeEmail];

    // Check the query for errors
    if ($stmt->execute($values)) {
        $message = "Registrasi berhasil!";
    } else {
        $message = "Terjadi kesalahan saat registrasi.";
    }
}

include '../register.php';
