<?php
require_once '../models/Vehicle.php';

if (isset($_POST['submit'])) {
    $veh = new Vehicle();
    $veh->vin = $_POST['selvin'];
    $veh->make = $_POST['selmake'];
    $veh->model = $_POST['selmodel'];
    $veh->year = $_POST['selyear'];
    $veh->color = $_POST['selcolor'];
    $veh->purchasedOn = $_POST['selpdate'];
    $veh->save();
    error_log("Created record '" . $veh->vin);

    header("Location: ../main/cat.php?cat=Vehicle");
} else if ($req == "show") {
?>
<div data-role="content">
    <div class="content-primary">
      <ul data-role="listview" data-filter="true">
        <?php
            $year = $obj['year']; echo "<li>$year</li>\n";
            $make = $obj['make']; echo "<li>$make</li>\n";
            $model = $obj['model']; echo "<li>$model</li>\n";
            $color = $obj['color']; echo "<li>$color</li>\n";
            $purchasedOn = $obj['purchasedOn']; echo "<li>$purchasedOn</li>\n";
            $vin = $obj['vin']; echo "<li>$vin</li>\n";
        ?>
      </ul>
      </div>
</div>

<?php } else { ?>

<script type="text/javascript">

    function listMakes (defmk) {
        var smk = document.getElementById("selmake");

        $("#selmake").empty();
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
        $mk = $("#selmake").val();

        $("#selmodel").empty();
        var smdl = document.getElementById("selmodel");
        var newOption = document.createElement("option");
        newOption.text = defmod;
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
        $('#selmake').bind('change',function() {
            $mk = $("#selmake").val();

            $("#selmodel").empty();
            var smdl = document.getElementById("selmodel");
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
        var scol = document.getElementById("selcolor");

        $("#selcolor").empty();
        var newOption = document.createElement("option");
        newOption.text = def_color;
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

<div data-role="content" data-theme="b">
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
  <form method="POST" id="upd-vehicle" class="ui-body ui-body-a ui-corner-all" data-ajax="false">
    <fieldset>
      <div data-role="fieldcontain" data-theme="b">
        <select name="selyear" id="selyear">
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
        <select name="selmake" id="selmake">
        <script>
            var def_make = "<?php echo $_SESSION['make'] ?>";
            listMakes(def_make);
        </script>
        </select>
      </div>

      <div data-role="fieldcontain">
        <select name="selmodel" id="selmodel">
        <script>
            var def_model = "<?php echo $_SESSION['model'] ?>";
            listModels(def_model);
        </script>
        </select>
      </div>

      <div data-role="fieldcontain">
        <select name="selcolor" id="selcolor">
        <script>
            var def_color = "<?php echo $_SESSION['color'] ?>";
            listColors(def_color);
        </script>
        </select>
      </div>

      <div data-role="fieldcontain">
        <input name="selpdate" type="date" data-role="datebox" id="defcal" data-options='{"mode": "calbox"}'/>
      </div>

      <div data-role="fieldcontain">
        <?php
            echo "<input type='text' value='";
            echo $_SESSION['vin'];
            echo "' name='selvin' id='vin' placeholder='VIN number'/>";
        ?>
      </div>
      <input type="submit" data-theme="b" name="submit" id="submit" value="Save">
    </fieldset>
  </form>
</div>

<?php } ?>
