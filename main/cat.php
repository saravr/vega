<?php
include "_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";
include "../views/show.php";

$catname = $_GET['cat'];
$cats = getSubCategories($catname);

if (count($cats) > 0) {
    echo "<ul data-role=listview data-inset=true>\n";
    echo "<li data-role=list-divider>$catname</li>\n";
    foreach ($cats as $cat) {
        echo "<li><a href=cat.php?cat=$cat->name>$cat->name</a></li>\n";
    }
    echo "</ul>\n";
} else {
    showItems($catname);
    //echo "<a href=add.php?cat=$catname>Add ...</a>\n";
    echo "<form action=add.php method=get>\n";
    echo "<input type=hidden name=cat value=\"$catname\"/>\n";
    echo "<input type=submit data-theme=b value=Add>\n";
    echo "</form>\n";
}

include "_footer.php";
?>
