<?php
// for connecting database
include "config.php";

// Low stock and expiring soon logic
$lowStockCount = 0;
$expiringSoonCount = 0;
$today = date('Y-m-d');
$thresholdDate = date('Y-m-d', strtotime('+30 days'));

$alertQuery = "SELECT quantity, expiry_date FROM medicines";
$alertResult = mysqli_query($conn, $alertQuery);
while ($alertRow = mysqli_fetch_assoc($alertResult)) {
    if ($alertRow['quantity'] <= 5) {
        $lowStockCount++;
    }
    if ($alertRow['expiry_date'] <= $thresholdDate) {
        $expiringSoonCount++;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Medical Store Inventory Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .navbar {
            height: 56px;
            z-index: 1040;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 250px;
            height: calc(100vh - 56px);
            background-color: #212529;
            overflow-y: auto;
            padding-top: 1rem;
            border-right: 1px solid #343a40;
        }

        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 1rem;
            color: #adb5bd;
            display: block;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #343a40;
            color: #fff;
            border-left-color: #0d6efd;
        }

        .main-content {
            margin-left: 250px;
            padding: 80px 20px 20px 20px;
            min-height: 100vh;
        }

        footer {
            background-color: #212529;
            color: #adb5bd;
            padding: 15px 0;
            text-align: center;
            font-size: 0.9rem;
            border-top: 1px solid #343a40;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                top: 100px;
            }

            .main-content {
                margin-left: 0;
                padding-top: 80px;
            }
        }

        .icon-link {
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .icon-link:hover {
            transform: scale(1.1);
            text-shadow: 0 0 8px currentColor;
        }

        .low-stock {
            background-color: #fff3cd !important;
        }

        .expiring-soon {
            background-color: #d1ecf1 !important;
        }

        .both-alert {
            background-color: #f8d7da !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light fixed-top bg-light px-3 shadow-lg">
        <a href="index.php" class="navbar-brand mb-0 h1">Medical Store Inventory</a>
        <button id="modeToggle" class="btn btn-outline-dark btn-sm" title="Toggle Dark/Light Mode">Dark Mode</button>
    </nav>
    <div class="sidebar">
        <a href="index.php" class="active fw-bold"><i class="bi bi-box-seam me-2"></i>All Medicines</a>
        <a href="add_medicine.php"><i class="bi bi-plus-square me-2"></i>Add Medicine</a>
        <a href="low_stock.php" class="text-warning ps-4">Low Stock (<?= $lowStockCount ?>)</a>
        <a href="expiring_soon.php" class="text-info ps-4">Expiring Soon (<?= $expiringSoonCount ?>)</a>
        <hr class="text-secondary" />
    </div>
    <main class="main-content">
        <h2 class="mb-4 text-center">All Medicines Inventory</h2>

        <?php if ($lowStockCount > 0 || $expiringSoonCount > 0): ?>
            <div class="alert-container mb-4">
                <?php if ($lowStockCount > 0): ?>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Alert:</strong> <?= $lowStockCount ?> medicine(s) have low stock!
                    </div>
                <?php endif; ?>
                <?php if ($expiringSoonCount > 0): ?>
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-hourglass-split me-2"></i>
                        <strong>Notice:</strong> <?= $expiringSoonCount ?> medicine(s) are expiring within 30 days!
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table id="medicinesTable" class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Manufacturer</th>
                        <th>Quantity</th>
                        <th>Retail Price</th>
                        <th>Wholesale Price</th>
                        <th>Added Date</th>
                        <th>Expiry Date</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `medicines`";
                    $result = mysqli_query($conn, $sql);
                    $sno = 0;
                    if (!$result) {
                        die("Query Failed : " . mysqli_error($conn));
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        $sno++;
                        $rowClass = '';
                        $expiryDate = $row['expiry_date'];
                        $quantity = $row['quantity'];
                        $isLowStock = $quantity <= 10;
                        $isExpiring = $expiryDate <= $thresholdDate;
                        if ($isLowStock && $isExpiring) {
                            $rowClass = 'both-alert';
                        } elseif ($isLowStock) {
                            $rowClass = 'low-stock';
                        } elseif ($isExpiring) {
                            $rowClass = 'expiring-soon';
                        }
                        echo "<tr class='$rowClass'>
                        <td>$sno</td>
                        <td>{$row['name']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['manufacturer']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['retail_price']}</td>
                        <td>{$row['wholesale_price']}</td>
                        <td>{$row['added_date']}</td>
                        <td>{$row['expiry_date']}</td>
                        <td>{$row['location']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning me-1'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete {$row['name']} ?')\"><i class='fas fa-trash-alt'></i></a>
                        </td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="add_medicine.php" class="btn btn-sm btn-success mt-3" title="Add New Medicine">
                <i class="bi bi-plus-lg"></i> Add Medicine
            </a>
        </div>
    </main>
    <!-- [Footer and Scripts remain unchanged] -->

    <!-- Footer -->
    <footer class="bg-dark text-light pt-4 pb-3 mt-auto border-top border-secondary">
        <div class="container text-center">
            <p class="mb-1 text-white">© 2025 <strong>Medical Store Inventory</strong>. All rights reserved.</p>
            <p class="mb-1 text-white">Designed & Developed by <strong class="text-primary">Muhammad Usaid
                    Saddiq</strong></p>
            <p class="mb-2">
                📞 <a href="tel:+923300262678" class="text-warning fw-semibold text-decoration-none">+92 330 0262678</a>
                |
                📧 <a href="mailto:muhammadusaid136@email.com"
                    class="text-warning fw-semibold text-decoration-none">muhammadusaid136@email.com</a>
            </p>
            <p class="mb-0">
                <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="icon-link me-3"
                    style="color: #0A66C2;">
                    <i class="bi bi-linkedin fs-5"></i> LinkedIn
                </a>
                <a href="https://github.com/yourusername" target="_blank" class="icon-link me-3"
                    style="color: #f4f4f4;">
                    <i class="bi bi-github fs-5"></i> GitHub
                </a>
                <a href="https://yourportfolio.com" target="_blank" class="icon-link" style="color: #0dcaf0;">
                    <i class="bi bi-globe fs-5"></i> Portfolio
                </a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#medicinesTable').DataTable({
                pageLength: 10,
                order: [[0, 'asc']],
                language: {
                    search: "Search Medicines:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ medicines",
                    infoEmpty: "No medicines available",
                    zeroRecords: "No matching medicines found"
                }
            });

            $('#modeToggle').on('click', function () {
                const htmlEl = document.documentElement;
                const isDark = htmlEl.getAttribute('data-bs-theme') === 'dark';
                htmlEl.setAttribute('data-bs-theme', isDark ? 'light' : 'dark');
                $(this).text(isDark ? 'Dark Mode' : 'Light Mode');
            });
        });
    </script>

</body>

</html>