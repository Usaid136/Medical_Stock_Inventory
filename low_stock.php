<?php
// low_stock.php
include "config.php";

$sql = "SELECT * FROM medicines WHERE quantity <= 5";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Low Stock Medicines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Low Stock Medicines (Quantity ≤ 5)</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
        <thead class="table-warning">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Manufacturer</th>
                <th>Quantity</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><?= $row['manufacturer'] ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= $row['expiry_date'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>