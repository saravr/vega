<?php

require_once '../includes/dbconnect.php';
require_once '../models/Object.php';

class VehInfo {

};

class Vehicle extends Object {

    public function __construct ($db = null) {

        parent::__construct("Vehicle", "vin");
        $this->db = $db;
        $this->_dfld1 = 'make';
        $this->_dfld2 = 'vin';
        $this->_fields = array('vin', 'make', 'model', 'year', 'color', 'purchasedOn');
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
    private $db;
}

$db = dbConnect();

$vehInfo = new Vehicle($db);

if (array_key_exists('req', $_GET)) {
    if ($_GET['req'] == "makes") {
        echo json_encode($vehInfo->getMakes());
    } else if ($_GET['req'] == "models") {
        $make = $_GET['make'];
        echo json_encode($vehInfo->getModels($make));
    } else {
        //echo "..... .I am here .....\n";
    }
} else {
    //echo "..... .I am here .....\n";
}

dbDisconnect($db);

?>
