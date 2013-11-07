<?php
session_start();

require_once "../includes/mongodb.php";
require_once "../models/Vehicle.php";

$mgc = mgOpen();

if ($_GET['src'] == "vehicle") {
    $veh = new Vehicle();
    $veh->objInit($mgc, $dbname);

    $var_arr = array(
                     'year' => $_POST['selyear'],
                     'make' => $_POST['selmake'],
                     'model' => $_POST['selmodel'],
                     'color' => $_POST['selcolor'],
                     'purchasedOn' => $_POST['selpdate'],
                     'vin' => $_POST['selvin']);
$vstr = print_r($var_arr, 1);
error_log("TT: $vstr :VV");
    $veh->saveRecord($var_arr);
    error_log("Created record '" . $veh->vin . "' id: " . $veh->id() . "\n");
}

mgClose($mgc);

CategoryController::showMyCategories();

?>
