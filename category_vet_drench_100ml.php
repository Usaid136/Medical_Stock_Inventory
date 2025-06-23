<?php
// for connecting database
include "config.php";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Medical Store Inventory Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- font awesome cdn -->
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
            /* below the navbar */
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
            /* top padding for navbar */
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

        /* Glow & Scale CSS  */
        .icon-link {
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .icon-link:hover {
            transform: scale(1.1);
            text-shadow: 0 0 8px currentColor;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light fixed-top bg-light px-3 shadow-lg">
        <a href="index.php" class="navbar-brand mb-0 h1">Medical Store Inventory</a>
        <button id="modeToggle" class="btn btn-outline-dark btn-sm" title="Toggle Dark/Light Mode">Dark Mode</button>
    </nav>

    <div class="sidebar">
        <a href="index.php" ><i class="bi bi-box-seam me-2"></i>All Medicines</a>
        <a href="add_medicine.php"><i class="bi bi-plus-square me-2"></i>Add Medicine</a>
        <hr class="text-secondary" />
        <h5 class="text-secondary text-uppercase ps-3 mt-3 mb-2">Categories</h5>
        <h6 class="text-secondary text-uppercase ps-3 mt-4 mb-2">Pharmaceuticals</h6>
        <a href="category_tablet.php"><i class="bi bi-capsule me-2"></i>Tablets</a>
        <a href="category_capsule.php"><i class="bi bi-capsule me-2"></i>Capsules</a>
        <a href="category_syrup.php"><i class="bi bi-droplet-half me-2"></i>Syrups</a>
        <a href="category_injection.php"><i class="bi bi-eyedropper me-2"></i>Injections</a>
        <a href="category_topical.php"><i class="bi bi-water me-2"></i>Topicals</a>
        <a href="category_drops.php"><i class="bi bi-eyedropper me-2"></i>Drops</a>
        <a href="category_sachet.php"><i class="bi bi-box me-2"></i>Sachets</a>
        <a href="category_inhaler.php"><i class="bi bi-wind me-2"></i>Inhalers</a>
        <a href="category_suppository.php"><i class="bi bi-diagram-3 me-2"></i>Suppositories</a>
        <a href="category_medical_device.php"><i class="bi bi-cpu me-2"></i>Medical Devices</a>
        <a href="category_human_other_items.php"><i class="bi bi-bag-plus me-2"></i>Human Other Items</a>
        <h6 class="text-secondary text-uppercase ps-3 mt-4 mb-2">Veterinary</h6>
        <a href="category_vet_inj_10ml.php"><i class="bi bi-eyedropper me-2"></i>Vet Inj 10ml</a>
        <a href="category_vet_inj_50ml.php"><i class="bi bi-eyedropper me-2"></i>Vet Inj 50ml</a>
        <a href="category_vet_inj_100ml.php"><i class="bi bi-eyedropper me-2"></i>Vet Inj 100ml</a>
        <a href="category_vet_drip.php"><i class="bi bi-eyedropper me-2"></i>Vet Drip</a>
        <a href="category_vet_spray.php"><i class="bi bi-eyedropper me-2"></i>Vet Spray</a>
        <a href="category_vet_powder.php"><i class="bi bi-bag-check me-2"></i>Vet Powder</a>
        <a href="category_vet_tablets.php"><i class="bi bi-capsule me-2"></i>Vet Tablets</a>
        <a href="category_vet_other_items.php"><i class="bi bi-tools me-2"></i>Vet Other Items</a>
        <a href="category_vet_tuips.php"><i class="bi bi-basket me-2"></i>Vet Tuips</a>
        <a href="category_vet_drench_100ml.php" class="active fw-bold"><i class="bi bi-bucket me-2"></i>Vet Drench 100ml</a>
        <a href="category_vet_drench_1000ml.php"><i class="bi bi-bucket-fill me-2"></i>Vet Drench 1000ml</a>
        <a href="category_vet_syrup.php"><i class="bi bi-droplet me-2"></i>Vet Syrup</a>
        <h6 class="text-secondary text-uppercase ps-3 mt-4 mb-2">General</h6>
        <a href="category_general_item.php"><i class="bi bi-box-seam me-2"></i>General Items</a>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <h2 class="mb-4 text-center">Category : Vet Drench 100ml</h2>

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
                    <!-- php start for fetching data -->
                     <?php
                     $sql = "SELECT * FROM `medicines` WHERE `category` = 'Vet Drench 100ml'";
                     $result = mysqli_query($conn, $sql);
                     // variable for id
                     $sno = 0;

                     if (!$result) {
                        die("Query Failed : " . mysqli_error($conn));
                     } 
                     while ($row = mysqli_fetch_assoc($result)) {
                        $sno = $sno + 1;
                        echo "
                        <tr>
                        <td>" . $sno . "</td>
                        <td>". $row['name'] ."</td>
                        <td>". $row['category'] ."</td>
                        <td>". $row['manufacturer'] ."</td>
                        <td>". $row['quantity'] ."</td>
                        <td>". $row['retail_price'] ."</td>
                        <td>". $row['wholesale_price'] ."</td>
                        <td>". $row['added_date'] ."</td>
                        <td>". $row['expiry_date'] ."</td>
                        <td>". $row['location'] ."</td>
                        <td>
                            <a href='edit.php?id=$row[id]' class='btn btn-sm btn-warning me-1'>
                                <i class='fas fa-edit'></i>
                            </a>
                            <a href='delete.php?id=$row[id]' class='btn btn-sm btn-danger'
                                onclick=\"return confirm('Are you sure you want to delete $row[name] ?')\">
                                <i class='fas fa-trash-alt'></i>
                            </a>
                        </td>

                    </tr>
                        ";
                     }
                     ?>
                </tbody>
            </table>
            <a href="add_medicine.php" class="btn btn-sm btn-success mt-3" title="Add New Medicine">
                <i class="bi bi-plus-lg"></i> Add Medicine
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-4 pb-3 mt-auto border-top border-secondary">
        <div class="container text-center">
            <p class="mb-1 text-white">© 2025 <strong>Medical Store Inventory</strong>. All rights reserved.</p>
            <p class="mb-1 text-white">Designed & Developed by <strong class="text-primary">Muhammad Usaid
                    Saddiq</strong></p>
            <p class="mb-2">
                📞
                <a href="tel:+923300262678" class="text-warning fw-semibold text-decoration-none">
                    +92 330 0262678
                </a>
                |
                📧
                <a href="mailto:muhammadusaid136@email.com" class="text-warning fw-semibold text-decoration-none">
                    muhammadusaid136@email.com
                </a>
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