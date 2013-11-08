<?php

require_once '../includes/Morph/include.php';

class DBObject extends \morph\Object {
 
    private function addMembers () {

        foreach (array_keys($this->args) as $ky) {
            $dtype = $this->args[$ky];

            switch ($dtype) {
            case "String":
                $this->addProperty(new \morph\property\String($ky));
                $this->$ky = "";
                break;
            case "Integer":
                $this->addProperty(new \morph\property\Integer($ky));
                $this->$ky = 0;
                break;
            case "Date":
                $this->addProperty(new \morph\property\Date($ky));
                $this->$ky = 0;
                break;
            default:
                echo "ERROR: Unknown type: $dtype";
            }
        }
    }

    private function setMembers ($val_arr) {

        foreach (array_keys($val_arr) as $ky) {
            $dtype = $this->args[$ky];

            switch ($dtype) {
            case "String":
                $this->$ky = $val_arr[$ky];
                break;
            case "Integer":
                $this->$ky = $val_arr[$ky];
                break;
            case "Date":
                $this->$ky = $val_arr[$ky];
                break;
            default:
                echo "ERROR: Unknown type: $dtype";
            }
        }
    }

    public function objInit ($mongo_db, $db_name, $coll_name, $c_args, $pkey) {

$ans = print_r($c_args, true);
error_log("Y1 $ans");
        $this->pri_key = $pkey;
        $this->args = $c_args;
        $this->addMembers();
        $m_coll = $mongo_db->selectCollection($db_name, $coll_name);

        $flds = array($this->pri_key => 1);
        $res = $m_coll->ensureIndex($flds, array("unique" => true));
        if (! $res){
            echo "ERR: ensureIndex failed\n";
        }
        $ar = $m_coll->getIndexInfo();
    }

    public function id() {
        return (parent::id());
    }

    public function __construct($id = null) {

        parent::__construct($id);
        $this->args = array();
    }

    public function findByField ($fld, $val) {

        error_log("Find by field: $fld / $val\n");
        // create a query
        $query = new \morph\Query();
        $query->property($fld)->equals($val);
 
        // find records matching query
        $result = $this->findByQuery($query);
 
        $cnt = $result->totalCount();
$msg = print_r($result, 1);
        error_log("Found items: $cnt / $msg");;

        return ($result);
    }

    public function saveRecord ($var_arr) {

        $pri_val = "";
        foreach (array_keys($var_arr) as $ky) {
            if ($ky == $this->pri_key) {
                $pri_val = $var_arr[$ky];
                break;
            }
        }
        if ($pri_val == "") {
            error_log("ERROR: no value for primary key $this->pri_key");
            return;
        }

error_log('Here...');
        if ($this->findByField($this->pri_key, $pri_val)->totalCount() == 0) {
            $this->setMembers($var_arr);
            $this->save();
            error_log("Record saved !!!");
        } else {
            error_log("Record present already !!! - " . $this->vin);
            $this->setMembers($var_arr);
            $this->update();
        }
    }

    function deleteByField ($fld, $val) {
        // create a query
        $query = new \morph\Query();
        $query->property($fld)->equals($val);
 
        // delete records matching query
        $result = $this->deleteByQuery($query);
        foreach($result as $item) {
            echo "Delete result: $item\n";
        }
    }

    private $args;
    private $pri_key;
}
 
?>
