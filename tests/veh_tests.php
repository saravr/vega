<?php

include '../models/Vehicle.php';

$vin = '5HKRL12345566';

$db = dbConnect();
$veh = new Vehicle($db);

/*$veh->_dfld1 = 'make';
$veh->_dfld2 = 'vin';*/
/*
$veh->vin = $vin;
$veh->make = 'Honda';
$veh->model = 'Odyssey';
$veh->year = 2012;
$veh->color = 'Brown';
$veh->save();
*/

//echo "Now, let us find $vin\n";
$rec = $veh->find($vin);
//$rec = $veh->findAll();
foreach ($rec as $item) {
    foreach ($item as $ky => $val) {
        if ($ky[0] != '_') {
            echo "\t$ky: $val\n";
        }
    }
    echo "\n";
}

dbDisconnect($db);
?>
