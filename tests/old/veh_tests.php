<?php
require '../includes/Morph.phar';
require '../models/Vehicle.php';

function saveVehicle ($make, $model, $color, $year, $pon, $vin)
{
    $aVehicle = new Vehicle();
    $aVehicle->make = $make;
    $aVehicle->model = $model;
    $aVehicle->color = $color;
    $aVehicle->year = $year;
    $aVehicle->purchasedOn = strtotime($pon);
    $aVehicle->vin = $vin;
    $aVehicle->save();
   
    echo("New veh: '" . $aVehicle->make . "' saved with id: " . $aVehicle->id() . "\n");
}

function findVehicle ($make)
{
    // instantiate your vehicle        
    $vehicle = new Vehicle();
 
    // create a query
    $query = new \morph\Query();
    $query->property('make')->equals($make);
 
    // find records matching query
    $result = $vehicle->findByQuery($query);
 
    foreach($result as $item) {
        echo "Vehicle: $item->make\n";
    }
}

$mongo = new Mongo();
\morph\Storage::init($mongo->selectDB('ItemDB'));

saveVehicle("Honda", "Odyseey", "Brown", 2012, strtotime('2013-02-01'), "5HKL");
findVehicle("Honda");
 
?>
