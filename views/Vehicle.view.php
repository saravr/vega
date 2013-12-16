<?php
require_once '../models/all.php';

if (isset($_POST['submit'])) {
    $cmd = $_POST['submit'];
    if ($cmd == "Save") {
        $obj = new Vehicle();
        foreach ($obj->_fields as $fld) {
            $key = 'sel_' . $fld;
            $obj->$fld = $_POST[$key];
        }
        $obj->save();
        error_log("Created record '" . $obj->vin . "'");
    }
    header("Location: ../main/cat.php?cat=Vehicle");

} else if (isset($_GET['req']) && $_GET['req'] == "show") {
    $cat = "Vehicle";
    $_GET['cat'] = $cat;
    include "../views/show_item.php";

} else {
    $cat = "Vehicle";
    //echo "<script type=text/javascript src=../views/$cat.js>\n";
?>

<script type=text/javascript src=../views/Vehicle.js>
</script>

<div data-role="content" data-theme="a">
  <?php
      $obj_json = $_SESSION['obj'];
      $obj = json_decode($obj_json);
      //$obj = new Vehicle();
      if (isset($obj->_fields)) {
          foreach ($obj->_fields as $fld) {
              if (isset($obj->$fld)) {
                  $_SESSION[$fld] = $obj->$fld;
              }
          }
      }
  ?>
  <form method="POST" class="ui-body ui-body-a ui-corner-all" data-ajax="false">
    <fieldset>
      <div data-role="fieldcontain">
        <select name="sel_year" id="sel_year">
            <?php echo "<option>Year</option>"; ?>
            <?php
                for ($yr = 2014; $yr > 1900; $yr--) {
                    $sel = ($yr == $_SESSION['year']) ? "selected='selected'" : "";
                    echo "<option value='$yr' $sel>$yr</option>\n";
                }
            ?>
        </select>
      </div>

      <div data-role="fieldcontain">
        <select name="sel_make" id="sel_make">
        <script>
            var def_make = "<?php echo $_SESSION['make'] ?>";
            listMakes(def_make);
        </script>
        </select>
      </div>

      <div data-role="fieldcontain">
        <select name="sel_model" id="sel_model">
        <script>
            var def_model = "<?php echo $_SESSION['model'] ?>";
            listModels(def_model);
        </script>
        </select>
      </div>

      <div data-role="fieldcontain">
        <select name="sel_color" id="sel_color">
        <script>
            var def_color = "<?php echo $_SESSION['color'] ?>";
            listColors(def_color);
        </script>
        </select>
      </div>

      <div data-role="fieldcontain">
        <input name="sel_purchasedOn" type="date" data-role="datebox" id="defcal" data-options='{"mode": "calbox"}' placeholder='Purchase Date'/>
      </div>

      <div data-role="fieldcontain">
        <?php
            echo "<input type='text' value='";
            echo $_SESSION['vin'];
            echo "' name='sel_vin' id='vin' placeholder='VIN number'/>";
        ?>
      </div>

      <div class="ui-grid-a">
        <div class="ui-block-a">
          <input type="submit" data-theme="a" name="submit" id="submit" value="Save">
        </div>
        <div class="ui-block-b">
          <input type="submit" data-theme="a" name="submit" id="submit" value="Cancel">
        </div>
      </div>
    </fieldset>
  </form>
</div>

<?php } ?>
