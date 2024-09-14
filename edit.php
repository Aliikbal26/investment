<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: /invesment/login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM investments WHERE id = ?");
$stmt->execute([$id]);
$investment = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $investment_type = $_POST['investment_type'];
    $amount = $_POST['amount'];
    $investment_date = $_POST['investment_date'];

    // Update data
    $stmt = $pdo->prepare("UPDATE investments SET investment_type = ?, amount = ?, investment_date = ? WHERE id = ?");
    $stmt->execute([$investment_type, $amount, $investment_date, $id]);

    header('Location: /invesment/portofolio.php');
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
    <title>Edit Investment</title>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col mt-3 col-md-6">
            <div class="container">
                <h1 class="text-center my-4">Edit Investment</h1>
                <form action="/invesment/edit.php?id=<?= $investment['id'] ?>" method="post">
                    <div class="row">
                        <div class="col">

                            <div class="form-group">
                                <label for="investment_type">Investment Type</label>
                                <select class="form-control" id="investment_type" name="investment_type" required>
                                    <option value="<?= $investment['investment_type'] ?>"><?= $investment['investment_type'] ?></option>
                                    <option value="stocks">Stocks</option>
                                    <option value="bonds">Bonds</option>
                                    <option value="mutual funds">Mutual Funds</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" value="<?= $investment['amount'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="investment_date">Investment Date</label>
                            <input type="date" name="investment_date" class="form-control" value="<?= $investment['investment_date'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-grid gap-2">
                            <button type="submit" class="btn btn-primary mt-3 my-2">Update Investment</button>
                            <a type="button" href="/invesment/portofolio.php" class="btn btn-success">Back Home</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>