<?php
session_start();
$_GET['pgid'] = "pg_cat";
include "../views/_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";
include "../views/show.php";

$catname = $_GET['cat'];
$cats = getSubCategories($catname);

if (count($cats) > 0) {
    echo "<ul data-role=listview data-inset=true data-theme=a>\n";
    echo "<li data-role=list-divider data-theme=a>$catname</li>\n";
    foreach ($cats as $cat) {
        echo "<li><a href=cat.php?cat=$cat->name>$cat->name</a></li>\n";
    }
    echo "</ul>\n";
} else {
    showItems($catname);
    echo "<form action=../main/add.php method=get>\n";
    echo "<input type=hidden name=cat value=\"$catname\"/>\n";
    echo "<input type=submit data-theme=a value=Add>\n";
    echo "</form>\n";
}

include "../views/_footer.php";
?>
