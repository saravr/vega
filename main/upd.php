<?php
session_start();

require_once "../models/Vehicle.php";

if ($_GET['src'] == "vehicle") {
    $veh = new Vehicle();
    $veh->vin = $_POST['selvin'];
    $veh->make = $_POST['selmake'];
    $veh->model = $_POST['selmodel'];
    $veh->year = $_POST['selyear'];
    $veh->color = $_POST['selcolor'];
    $veh->purchasedOn = $_POST['selpdate'];
    $veh->save();
    error_log("Created record '" . $veh->vin . "' id: " . $veh->id() . "\n");
}

?>
