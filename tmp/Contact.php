<?php
require_once 'Object.php';

class Contact extends Object {
    public function __construct () {

        parent::__construct("Contact", "name");
    }
};

?>
