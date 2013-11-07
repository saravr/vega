<?php

include 'Vehicle.php';

$vin = '5HKRL12345566';

$veh = new Vehicle();
$veh->vin = $vin;
$veh->make = 'Honda';
$veh->model = 'Odyssey';
$veh->year = 2012;
$veh->color = 'Brown';
$veh->save();

echo "Now, let us find $vin\n";
$rec = $veh->find($vin);
foreach ($rec as $item) {
    $make = $item['make'];
    $model = $item['model'];
    echo "Make/Model: $make/$model\n";
}
?>
