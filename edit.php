<?php
// for connecting database
include "config.php";

// Check if 'id' exists in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "<div class='alert alert-danger'>Medicine ID is not provided!</div>";
    exit;
}

//select query
$sql = "SELECT * FROM medicines WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<div class='alert alert-danger'>Medicine not found!</div>";
}
//php for fetching data in form
$medicine = mysqli_fetch_assoc($result);

//php for updating record
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $manufacturer = $_POST['manufacturer'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $wholesale_price = $_POST['wholesale_price'];
    $expiry_date = $_POST['expiry_date'];
    $location = $_POST['location'];

    $sql = "UPDATE medicines SET `name` = '$name', `category` = '$category', `manufacturer` = '$manufacturer', `quantity` = $quantity, `retail_price` = $price, `wholesale_price` = $wholesale_price, `expiry_date` = '$expiry_date', `location` = '$location' WHERE id = $id;";
    $result = mysqli_query($conn, $sql);

    //php for showing alert & redirect to index.php file
    if ($result) {
        echo " <script>
        alert('Medicine record updated successfully!');
        window.location.href = 'index.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Update failed!</strong> Please check the entered information and try again.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
if (mysqli_query($conn,$sql)) {
    
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Medicine | Medical Store Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #212529;
            padding-top: 60px;
            overflow-y: auto;
            border-right: 1px solid #343a40;
            transition: all 0.3s ease;
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
            margin-left: 240px;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content .medicine {
            margin-top: 50px;
        }

        .navbar-dark {
            background-color: #212529;
        }

        footer {
            background-color: #212529;
            color: #adb5bd;
            padding: 15px 0;
            text-align: center;
            margin-top: auto;
            font-size: 0.9rem;
            border-top: 1px solid #343a40;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
            }

            .sidebar a {
                float: left;
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .main-content {
                margin-left: 0;
            }
        }

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
    <!-- sidebar -->
    <div class="sidebar">
        <a href="index.php"><i class="bi bi-box-seam me-2"></i>All Medicines</a>
        <a href="add_medicine.php" class="active fw-bold"><i class="bi bi-plus-square me-2"></i>Add Medicine</a>
        <hr class="text-secondary" />
        <h5 class="text-secondary text-uppercase ps-3 mt-3 mb-2">Categories</h5>
        <h6 class="text-secondary text-uppercase ps-3 mt-4 mb-2">Pharmaceuticals</h6>
        <a href="category_tablet.php"><i class="bi bi-capsule me-2"></i>Tablets</a>
        <a href="category_capsule.php"><i class="bi bi-capsule me-2"></i>Capsules</a>
        <a href="category_syrup.php"><i class="bi bi-droplet-half me-2"></i>Syrups</a>
        <a href="category_injection.php"><i class="bi bi-eyedropper me-2"></i>Injections</a>
        <a href="category_topical.php"><i class="bi bi-water me-2"></i>Topicals</a>
        <a href="category_drops.php"><i class="bi bi-eyedropper me-2"></i>Drops</a>
        <a href="category_inhaler.php"><i class="bi bi-wind me-2"></i>Inhalers</a>
        <a href="category_sachet.php"><i class="bi bi-box me-2"></i>Sachets</a>
        <a href="category_suppository.php"><i class="bi bi-diagram-3 me-2"></i>Suppositories</a>
        <a href="category_medical_device.php"><i class="bi bi-cpu me-2"></i>Medical Devices</a>
        <a href="category_human_other_items.php"><i class="bi bi-bag-plus me-2"></i>Human Other Items</a>
        <h6 class="text-secondary text-uppercase ps-3 mt-4 mb-2">Veterinary</h6>
        <a href="category_vet_inj_10ml.php"><i class="bi bi-eyedropper me-2"></i>Vet Inj 10ml</a>
        <a href="category_vet_inj_50ml.php"><i class="bi bi-eyedropper me-2"></i>Vet Inj 50ml</a>
        <a href="category_vet_inj_100ml.php"><i class="bi bi-eyedropper me-2"></i>Vet Inj 100ml</a>
        <a href="category_vet_powder.php"><i class="bi bi-bag-check me-2"></i>Vet Powder</a>
        <a href="category_vet_tablets.php"><i class="bi bi-capsule me-2"></i>Vet Tablets</a>
        <a href="category_vet_other_items.php"><i class="bi bi-tools me-2"></i>Vet Other Items</a>
        <a href="category_vet_drip.php"><i class="bi bi-eyedroper me-2"></i>Vet Drip</a>
        <a href="category_vet_spray.php"><i class="bi bi-eyedroper me-2"></i>Vet Spray</a>
        <a href="category_vet_tuips.php"><i class="bi bi-basket me-2"></i>Vet Tuips</a>
        <a href="category_vet_drench_100ml.php"><i class="bi bi-bucket me-2"></i>Vet Drench 100ml</a>
        <a href="category_vet_drench_1000ml.php"><i class="bi bi-bucket-fill me-2"></i>Vet Drench 1000ml</a>
        <a href="category_vet_syrup.php"><i class="bi bi-droplet me-2"></i>Vet Syrup</a>
        <h6 class="text-secondary text-uppercase ps-3 mt-4 mb-2">General</h6>
        <a href="category_general_item.php"><i class="bi bi-box-seam me-2"></i>General Items</a>
    </div>

    <main class="main-content">
        <h2 class="mb-4 text-center medicine"><i class="bi bi-pencil-square me-2"></i> Edit Medicine</h2>

        <form id="addMedicineForm" method="POST" action="edit.php?id=<?= $id; ?>" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Medicine Name</label>
                <input type="text" class="form-control" id="name" value="<?= htmlspecialchars($medicine['name']) ?>"
                    name="name" required minlength="2" />
                <div class="invalid-feedback">Please enter the medicine name (at least 2 characters).</div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category"
                    name="category" required>
                    <option value="<?= htmlspecialchars($medicine['category']) ?>" selected><?= htmlspecialchars($medicine['category']) ?></option>
                    <!-- same options as above -->
                    <option value="Tablet">Tablet</option>
                    <option value="Capsul">Capsule</option>
                    <option value="Syrup">Syrup</option>
                    <option value="Injection">Injection</option>
                    <option value="Topical">Topical</option>
                    <option value="Drops">Drops</option>
                    <option value="Inhaler">Inhaler</option>
                    <option value="Suppository">Suppository</option>
                    <option value="Medical Device">Medical Device</option>
                    <option value="Human Other Items">Human Other Items</option>
                    <option value="General Item">General Item</option>
                    <option value="Vet Inj 10ml">Vet Inj 10ml</option>
                    <option value="Vet Inj 50ml">Vet Inj 50ml</option>
                    <option value="Vet Inj 100ml">Vet Inj 100ml</option>
                    <option value="Vet Powder">Vet Powder</option>
                    <option value="Vet Tablets">Vet Tablets</option>
                    <option value="Vet Other Items">Vet Other Items</option>
                    <option value="Vet Tuips">Vet Tuips</option>
                    <option value="Vet Drench 100ml">Vet Drench 100ml</option>
                    <option value="Vet Drench 1000ml">Vet Drench 1000ml</option>
                    <option value="Vet Syrup">Vet Syrup</option>
                </select>
                <div class="invalid-feedback">Please select a category.</div>
            </div>

            <div class="mb-3">
                <label for="manufacturer" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($medicine['manufacturer']) ?>"
                    id="manufacturer" name="manufacturer" required minlength="2" />
                <div class="invalid-feedback">Please enter the manufacturer name (at least 2 characters).</div>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" min="0" class="form-control"
                    value="<?= htmlspecialchars($medicine['quantity']) ?>" id="quantity" name="quantity" required />
                <div class="invalid-feedback">Please enter a valid quantity.</div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Retail Price</label>
                <input type="number" min="0.01" step="0.01" class="form-control"
                    value="<?= htmlspecialchars($medicine['retail_price']) ?>" id="price" name="price" required />
                <div class="invalid-feedback">Please enter a valid price (minimum 0.01 PKR).</div>
            </div>

            <div class="mb-3">
                <label for="wholesale_price" class="form-label">Wholesale Price</label>
                <input type="number" min="0.01" step="0.01" class="form-control"
                    value="<?= htmlspecialchars($medicine['wholesale_price']) ?>" id="wholesale_price"
                    name="wholesale_price" required />
                <div class="invalid-feedback">Please enter a valid wholesale price (minimum 0.01 PKR).</div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($medicine['location']) ?>"
                    id="location" name="location" required minlength="2" />
                <div class="invalid-feedback">Please enter the location (at least 2 characters).</div>
            </div>

            <div class="mb-3">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" class="form-control" value="<?= htmlspecialchars($medicine['expiry_date']) ?>"
                    id="expiry_date" name="expiry_date" required />
                <div class="invalid-feedback" id="expiryFeedback">Please select a valid expiry date (not in the past).
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modeToggle = document.getElementById('modeToggle');
        const htmlEl = document.documentElement;

        function updateToggleText() {
            modeToggle.textContent = htmlEl.getAttribute('data-bs-theme') === 'dark' ? 'Light Mode' : 'Dark Mode';
        }

        updateToggleText();

        modeToggle.addEventListener('click', () => {
            const current = htmlEl.getAttribute('data-bs-theme');
            htmlEl.setAttribute('data-bs-theme', current === 'dark' ? 'light' : 'dark');
            updateToggleText();
        });

        (() => {
            'use strict';
            const form = document.getElementById('addMedicineForm');
            const expiryInput = document.getElementById('expiry_date');
            const expiryFeedback = document.getElementById('expiryFeedback');

            form.addEventListener('submit', (event) => {
                expiryInput.setCustomValidity('');
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const expiryDate = new Date(expiryInput.value);

                if (expiryInput.value === '' || expiryDate < today) {
                    expiryInput.setCustomValidity('Invalid expiry date');
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>
</body>

</html>