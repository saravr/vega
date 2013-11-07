<?php

function mgOpen () {

    $mongo = new MongoClient();
    $dbname = 'VegaDB';
    \morph\Storage::init($mongo->selectDB($dbname));

    return $mongo;
}

function mgClose ($mongo) {

    $mongo->close();
}

function mgCollections () {

    $mongo = new MongoClient();
    $mdb = $mongo->selectDB('VegaDB');
    $coll_array = $mdb->listCollections();
    $mongo->close();

    return ($coll_array);
}

function mgTest () {

    $carr = mgCollections();

    $col_arr = array();
    foreach ($carr as $coll) {
        echo "C: $coll\n";
        $cursor = $coll->find(array());
        foreach ($cursor as $doc) {
            //var_dump($doc);
            //echo "D: " . $doc['_ns'];
            $typ = $doc['_ns'];
            switch ($typ) {
            case "Vehicle":
                //echo " " . $doc['vin'];
                break;
            }
            //echo "\n";
            $varr = array($doc['_ns'], $doc['vin']);
            array_push($col_arr, $varr);
        }
    }

    print_r($col_arr);
}

?>
