<?php
session_start();
include "../views/_header.php";
include "../includes/dbconnect.php";
include "../includes/category.php";
?>
  <ul data-role="listview" data-filter="true" data-inset="true" data-theme=a>
    <?php
      echo "<li data-role=list-divider data-theme=a>Recently used</li>\n";
      echo "<li><a href=#>AAA <div class='ui-li-aside'><i>Auto</i></div></a></li>\n";
      echo "<li><a href=#>PG&E <div class='ui-li-aside'><i>Home</i></div></a></li>\n";
      echo "<li><a href=#>Citi Bank <div class='ui-li-aside'><i>Finance</i></div></a></li>\n";
      echo "<li><a href=#>United MileagePlus <div class='ui-li-aside'><i>Travel</i></div></a></li>\n";
    ?>
  </ul>

  <ul data-role="listview" data-inset="true" data-theme=a>
    <?php
      echo "<li data-role=list-divider data-theme=a>Categories</li>\n";
      $tops = getSubCategories('');
      foreach ($tops as $cat) {
          echo "<li><a href=cat.php?cat=$cat->name>$cat->name</a></li>\n";
      }
    ?>
  </ul>

<?php
include "../views/_footer.php";
?>
