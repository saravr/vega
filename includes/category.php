<?php

class Category {
};

function getSubCategories ($catname) {
    $db = dbConnect();

    if ($catname == '') {
        $cmd = "select name from Category where parent = ''";
    } else {
        $cmd = "select name from Category where parent = '$catname'";
    }
    $st = $db->prepare($cmd);
    $st->execute();
    $objs = $st->fetchAll(PDO::FETCH_CLASS, "Category");

    //print_r($objs);
    dbDisconnect($db);

    return $objs;
}

?>
