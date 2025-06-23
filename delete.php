<?php

//connecting database
include "config.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];

//query for deleting record
$sql = "DELETE FROM `medicines` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>
        alert('Medicine record deleted successfully!');
        window.location.href = 'index.php';
        </script>";
} else {
    echo "Deletion Failed : " . mysqli_error($conn);
}
}

?>