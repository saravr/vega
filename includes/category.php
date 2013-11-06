<?php

function getTopLevelCategories () {
    $db = dbConnect();

    class Category {
    };

    $cmd = "select name from Category where parent = ''";
    $st = $db->prepare($cmd);
    $st->execute();
    $objs = $st->fetchAll(PDO::FETCH_CLASS, "Category");

    //print_r($objs);
    dbDisconnect($db);

    return $objs;
}

?>
