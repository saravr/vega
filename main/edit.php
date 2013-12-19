<?php
session_start();
include "../views/_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";

$catname = $_GET['cat'];
$req = "edit";
$obj_id = $_GET['id'];
error_log("CAT: $catname, id: $obj_id");
include "../views/$catname.view.php";

include "../views/_footer.php";
?>
