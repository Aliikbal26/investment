<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: /invesment/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Investment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Add New Investment</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="/invesment/services/addInvestService.php">
            <div class="form-group">
                <label for="investment_type">Jenis Investasi</label>
                <select class="form-control" id="investment_type" name="investment_type" required>
                    <option value="stocks">Stocks</option>
                    <option value="bonds">Bonds</option>
                    <option value="mutual funds">Mutual Funds</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Jumlah Investasi</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="investment_date">Tanggal Investasi</label>
                <input type="date" class="form-control" id="investment_date" name="investment_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Investment</button>
            <a type="button" href="/invesment/portofolio.php" class="btn btn-success">Back Home</a>
        </form>
    </div>
</body>

</html>