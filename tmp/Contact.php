<?php
require_once 'Object.php';

class Contact extends Object {
    public function __construct () {

        parent::__construct("Contact", "name");
    }

    public function xxfind($key) {

        $result = parent::find(array('name' => $key));
        foreach ($result as $item) {
            echo "Phone: ";
            echo $item['phone'];
            echo "\n";
        }
    }

    private $name;
    private $phone;

    public function __set($name, $value) {

        parent::obj__set($name, $value);
    }

    public function __get($name) {

        return parent::obj__get($name);
    }

    public function __isset($name) {

        return parent::obj__isset($name);
    }

    public function __unset($name) {

        //parent::obj__unset($name);
    }
};

?>
