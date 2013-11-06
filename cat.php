<?php
include "_header.php";
include "includes/dbconnect.php";
include "includes/category.php";

$catname = $_GET['cat'];

?>

    <ul data-role="listview" data-inset="true">
      <?php
        echo "<li data-role=list-divider>$catname</li>\n";
        $cats = getSubCategories($catname);
        foreach ($cats as $cat) {
            echo "<li><a href=cat.php?cat=$cat->name>$cat->name</a></li>\n";
        }
      ?>
    </ul>

<?php
include "_footer.php";
?>
