<?php
session_start();
$cat = $_GET['cat'];
require_once "../models/$cat.php";

$_GET['pgid'] = "show_item";
$idd = $_GET['id'];
include "../views/_header.php";
?>
<div data-role="content">
  <div class="content-primary">
    <ul data-role="listview" data-inset="true" data-theme=a>
      <?php
        $db = dbConnect();
        $obj = new $cat($db);
        $obj = $obj->find($idd);
        $obj_json = json_encode($obj);
        $_SESSION['obj'] = $obj_json;

        foreach ($obj as $item) {
            foreach ($item as $ky => $val) {
                if ($ky[0] != '_') {
                    echo "<li data-icon=false><a href=#>$ky</a><div class='ui-li-aside'>$val</div></li>\n";
                }
            }
        }
      ?>
    </ul>
    <?php
      dbDisconnect($db);
    ?>

    <form action=../main/edit.php method=get>
      <input type=hidden name=cat value=<?php echo "$cat"; ?> />
      <input type=hidden name=id value=<?php echo "$idd"; ?> />
      <div class="ui-grid-a">
        <div class="ui-block-a">
          <input type=submit data-theme=a value=Edit>
        </div>
        <div class="ui-block-b">
          <input type=submit data-theme=a value=Delete>
        </div>
    </form>

  </div>
</div>

<?php
include "../views/_footer.php";
?>
