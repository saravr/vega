<?php
$cat = $_GET['cat'];
require_once "../models/$cat.php";

$_GET['pgid'] = "show_item";
include "../views/_header.php";
?>
<div data-role="content">
  <div class="content-primary">
    <ul data-role="listview" data-inset="true">
      <?php
        $db = dbConnect();
        $obj = new $cat($db);
        $idd = $_GET['id'];
        $obj = $obj->find($idd);

        foreach ($obj as $item) {
            foreach ($item as $ky => $val) {
                if ($ky[0] != '_') {
                    echo "<li>$ky<div class='ui-li-aside'>$val</div></li>\n";
                }
            }
        }
      ?>
    </ul>
    <?php
      dbDisconnect($db);
    ?>
  </div>
</div>

<?php
include "../views/_footer.php";
?>
