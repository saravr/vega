<?php
$cat = $_GET['cat'];
require_once "../models/$cat.php";

$_GET['pgid'] = "show_item";
include "../views/_header.php";
?>
<div data-role="content">
  <div class="content-primary">
    <ul data-role="listview" data-inset="true" data-theme=a>
      <?php
        $db = dbConnect();
        $obj = new $cat($db);
        $idd = $_GET['id'];
        $obj = $obj->find($idd);

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
      <input type=hidden name=cat value=$cat/>
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
