<?php
require_once '../models/all.php';

if (isset($_POST['submit'])) {
    $cmd = $_POST['submit'];
    if ($cmd == "Save") {
        $obj = new Vehicle();
        foreach ($obj->fields as $fld) {
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

<script type=text/javascript>
    function listMakes (defmk) {
        var smk = document.getElementById("sel_make");

        $("#sel_make").empty();
        var newOption = document.createElement("option");
        newOption.text = (defmk == "") ? "Make" : defmk;
        smk.options.add(newOption);
        $url = "../models/Vehicle.php?req=makes";
        $.getJSON($url, function (json) {
            $.each(json, function(key, val) {
                var newOption = document.createElement("option");
                newOption.value = val.make;
                newOption.innerHTML = val.make;
                if (val.make == defmk) {
                    newOption.selected = true;
                }
                smk.options.add(newOption);
            });
        });
    }

    function listModels (defmod) {
        $mk = $("#sel_make").val();

        $("#sel_model").empty();
        var smdl = document.getElementById("sel_model");
        var newOption = document.createElement("option");
        newOption.text = (defmod == "") ? "Model" : defmod;
        smdl.options.add(newOption);
        $url = "../models/Vehicle.php?req=models&make=" + $mk;
        $.getJSON($url, function (json) {
            $.each(json, function (key, val) {
                var newOption = document.createElement("option");
                newOption.value = val.model;
                newOption.innerHTML = val.model;
                if (val.model == defmod) {
                    newOption.selected = true;
                }
                smdl.options.add(newOption);
            });
        });
    }

    $(function() {
        $('#sel_make').bind('change',function() {
            $mk = $("#sel_make").val();

            $("#sel_model").empty();
            var smdl = document.getElementById("sel_model");
            $url = "../models/Vehicle.php?req=models&make=" + $mk;
            $.getJSON($url, function (json) {
                $.each(json, function (key, val) {
                    var newOption = document.createElement("option");
                    newOption.value = val.model;
                    newOption.innerHTML = val.model;
                    smdl.options.add(newOption);
                });
            });
        });
    });

    function listColors (defcol) {
        var scol = document.getElementById("sel_color");

        $("#sel_color").empty();
        var newOption = document.createElement("option");
        newOption.text = (defcol == "") ? "Color" : defcol;
        scol.options.add(newOption);
        $url = "../models/Colors.php?req=colors";
        $.getJSON($url, function (json) {
            $.each(json, function(key, val) {
                var newOption = document.createElement("option");
                newOption.value = val.color;
                newOption.innerHTML = val.color;
                if (val.color == defcol) {
                    newOption.selected = true;
                }
                scol.options.add(newOption);
            });
        });
    }
</script>

<div data-role="content" data-theme="a">
  <?php
      $obj_json = $_SESSION['obj'];
      $obj = json_decode($obj_json);
      error_log("CHK: " . $obj->make);
      $_SESSION['year'] = $obj->year;
      $_SESSION['make'] = $obj->make;
      $_SESSION['model'] = $obj->model;
      $_SESSION['color'] = $obj->color;
      $_SESSION['purchasedOn'] = $obj->purchasedOn;
      $_SESSION['vin'] = $obj->vin;
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
