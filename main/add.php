<?php
session_start();
$_GET['pgid'] = "pg_add";
include "../views/_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";

$catname = $_GET['cat'];
error_log("CAT: $catname");
include "../views/$catname.view.php";

include "../views/_footer.php";
?>
