<?php
require_once '../models/Object.php';

class Vehicle extends Object {
    public function __construct () {

        parent::__construct("Vehicle", "vin");
    }
};

?>
