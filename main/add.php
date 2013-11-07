<?php
include "../main/_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";

$catname = $_GET['cat'];

if ($catname == "Vehicles") {
    include "../views/vehicle.php";
}
?>

<?php
include "../main/_footer.php";
?>
