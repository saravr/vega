<?php
include "../main/_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";

$catname = $_GET['cat'];

include "../views/$catname.view.php";

include "../main/_footer.php";
?>
