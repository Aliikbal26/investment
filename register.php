<?php
session_start();
require_once 'Database.php';

if (isset($_SESSION['user']['id'])) {
    header("Location: /invesment/portofolio.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div class="row mt-5">
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">FORM REGISTRASI</h1>
                    </div>
                </div>

                <?php if (isset($message) && $message): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>message !</strong>
                        <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form method="POST" action="/invesment/services/registerService.php">
                    <div class="row">
                        <div class="col">
                            <p class="my-1">Type of Account</p>
                            <div class="form-check">
                                <input name="typeAccount[]" class="form-check-input" type="checkbox" value="Individual Account" id="individual">
                                <label class="form-check-label" for="individual">
                                    Individual Account
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="typeAccount[]" class="form-check-input" type="checkbox" value="Joint Account" id="jointAccount">
                                <label class="form-check-label" for="jointAccount">
                                    Joint Account
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="typeAccount[]" class="form-check-input" type="checkbox" value="Company" id="company">
                                <label class="form-check-label" for="company">
                                    Company
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="typeAccount[]" class="form-check-input" type="checkbox" value="Trust" id="trust">
                                <label class="form-check-label" for="trust">
                                    Trust
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="firstName" class="form-label">First Name *</label>
                            <input type="text" name="firstName" id="lastName" class="form-control" aria-label="First name" required>
                        </div>
                        <div class="col">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" class="form-control" aria-label="Middle name">
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Last Name *</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" aria-label="Last name" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 col-sm-6 col-lg-6">
                            <label for="birthday">Date of Birth</label>
                            <input type="date" name="birthday" id="birthday" class="form-control" aria-label="Birthday">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="nationality" class="form-label">Nationality *</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" aria-label="Nationality">
                        </div>
                        <div class="col">
                            <label for="residance" class="form-label">Country of Residance *</label>
                            <input type="text" name="residance" id="residance" class="form-control" aria-label="Residance" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="addressOne">Address Line 1 *</label>
                            <input type="text" name="addressOne" id="addressOne" class="form-control" aria-label="Address Line 1" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="addressTwo">Address Line 2 </label>
                            <input type="text" name="addressTwo" id="addressTwo" class="form-control" aria-label="Address Line 2">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="city" class="form-label">City </label>
                            <input type="text" name="city" id="city" class="form-control" aria-label="City">
                        </div>
                        <div class="col">
                            <label for="state" class="form-label">State</label>
                            <input type="text" name="state" id="state" class="form-control" aria-label="State">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="zipCode" class="form-label">Zip Code *</label>
                            <input type="text" name="zipCode" id="zipCode" class="form-control" aria-label="Zip Code" required>
                        </div>
                        <div class="col">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" name="country" class="form-select">
                                <option value="Afganistan" selected>Afganistan</option>
                                <option value="Indonesia">Indonesia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="employmentStatus" class="form-label">Employment Status</label>
                            <input type="text" name="employmentStatus" id="employmentStatus" class="form-control" aria-label="Employment Status">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="jobTitle" class="form-label">Job Title</label>
                            <input type="text" name="jobTitle" id="jobTitle" class="form-control" aria-label="Job Title">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="phoneWork" class="form-label">Phone Work</label>
                            <input type="text" name="phoneWork" id="phoneWork" class="form-control" aria-label="Phone Work">
                        </div>
                        <div class="col">
                            <label for="phoneMobile" class="form-label">Phone Mobile</label>
                            <input type="text" name="phoneMobile" id="phoneMobile" class="form-control" aria-label="Phone Mobile">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="phoneHome" class="form-label">Phone Home</label>
                            <input type="text" name="phoneHome" id="phoneHome" class="form-control" aria-label="Phone Home">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="alternativeEmail" class="form-label">Alternative Email</label>
                            <input type="text" name="alternativeEmail" id="alternativeEmail" class="form-control" aria-label="Alternative Email">
                        </div>
                    </div>
                    <p class="my-2 fw-bold ">Please provide a secure password below that you will use to log in to your online research portal. The email address you have supplied on this form will be your username</p>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="username" class="form-label">Username *</label>
                            <input type="text" name="username" id="username" class="form-control" aria-label="Username" required>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" name="email" id="email" class="form-control" aria-label="Email Address" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" name="password" id="password" class="form-control" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col d-flex justify-content-center position-relative">
                            <button type="submit" class="btn my-3 text-white" style="background-color: rgb(48, 48, 128);">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>