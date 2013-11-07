<?php

class Object {
    public function __construct ($collName, $prikey, $id = null) {

        $this->mongo = new MongoClient();
        $this->coll = $this->mongo->selectCollection($this->db_name, $collName);
        $this->coll->ensureIndex(array($prikey => 1),
                                 array("unique" => 1, "dropDups" => 1));
        $this->pri_key = $prikey;
    }

    public function save () {

        try {
            $this->coll->insert($this->data);
        } catch (Exception $e) {
            //echo "Exception: $e\n";
            return 0;
        }
    }

    public function find($key) {

        $key = array($this->pri_key => $key);
        return $this->coll->find($key);
    }

    private $db_name = 'XYZ';
    private $pri_key;
    private $pri_value;
    private $mongo;
    private $coll;
    private $data = Array();

    public function __set($name, $value) {
        echo "Setting '$name' to '$value'\n";
        $this->data[$name] = $value;
    }

    public function __get($name) {
        echo "Getting '$name'\n";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    public function __isset($name) {
        echo "Is '$name' set?\n";
        if (array_key_exists($name, $this->data)) {
            return isset($this->data[$name]);
        }

        return 0;
    }

    /*public function obj__unset($name) {
        echo "Unsetting '$name'\n";
        unset($this->data[$name]);
    }*/
};

?>
