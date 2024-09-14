<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: /invesment/login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];


// Query untuk mendapatkan data portofolio investasi pengguna yang login
$stmt = $pdo->prepare("SELECT investments.id, users.email, users.username , investments.investment_type, investments.amount, investments.investment_date
                       FROM investments 
                       INNER JOIN users ON investments.user_id = users.id
                       WHERE users.id = ?");
$stmt->execute([$user_id]);
$investments = $stmt->fetchAll();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Investasi</title>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <body>
            <div class="row">
                <div class="col">
                    <div class="container">
                        <?php if (isset($_SESSION['message'])) : ?>

                            <div class="alert alert-success alert-dismissible fade show">
                                <?= $_SESSION['message']; ?>
                            </div>
                            <?php unset($_SESSION['message']);
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <h1>Portofolio Investasi</h1>
            <a href="add_invest.php" class="btn btn-primary my-3">Add New Invest</a>
            <a href="/invesment/services/logout.php" class="btn btn-secondary logout-btn my-3">Logout</a>
            <table id="investmentTable" class="display mt-3">
                <thead>
                    <tr>
                        <th>ID Portofolio</th>
                        <th>Nama Pengguna</th>
                        <th>Jenis Investasi</th>
                        <th>Jumlah Investasi</th>
                        <th>Tanggal Investasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($investments)) : ?>
                        <?php foreach ($investments as $investment) : ?>
                            <tr>
                                <td><?= $investment['id'] ?></td>
                                <td><?= $investment['username'] ?></td>
                                <td><?= $investment['investment_type'] ?></td>
                                <td><?= $investment['amount'] ?></td>
                                <td><?= $investment['investment_date'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $investment['id'] ?>" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger delete-btn" data-id="<?= $investment['id'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">No investments found for this user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $(document).ready(function() {
                    $('#investmentTable').DataTable();

                    // Handle delete button
                    $('.delete-btn').click(function() {
                        const investId = $(this).data('id');
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = `/invesment/services/deleteService.php?id=${investId}`;
                            }
                        });
                    });
                });


                $('.logout-btn').on('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure you want to logout?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, logout!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/invesment/services/logout.php";
                        }
                    });
                });
            </script>
        </body>

</html>