<?php
require_once 'Object.php';

class Vehicle extends Object {
    public function __construct () {

        parent::__construct("Vehicle", "vin");
    }
};

?>
