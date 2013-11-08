<?php

require_once '../includes/dbconnect.php';
require_once '../includes/Object.php';

class VehInfo {

};

class Vehicle extends Object {

    public function __construct () {

        parent::__construct("Vehicle", "vin");
    }

    public function getMakes () {

        $cmd = "select make from VehInfo group by make";
        $st = $this->db->prepare($cmd);
        $st->execute();

        // Returns an array of VehInfo objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "VehInfo");
    }

    public function getModels ($make) {

        $cmd = "select model from VehInfo where make = '$make' group by model";
        $st = $this->db->prepare($cmd);
        $st->execute();

        // Returns an array of VehInfo objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "VehInfo");
    }

    private $col = 'Vehicle';
    private $pkey = 'vin';
    private $args_arr = array(
                              'year' => "Integer",
                              'make' => "String",
                              'model' => "String",
                              'color' => "String",
                              'purchasedOn' => "Date",
                              'vin' => "String",
                          );
    private $db;
}

$db = dbConnect();

$vehInfo = new Vehicle($db);

if ($_GET['req'] == "makes") {
    echo json_encode($vehInfo->getMakes());
} else if ($_GET['req'] == "models") {
    $make = $_GET['make'];
    echo json_encode($vehInfo->getModels($make));
}

dbDisconnect($db);

?>
