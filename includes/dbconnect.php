<?php

require_once 'config.php';

function dbConnect () {
    global $db_host, $db_name, $db_user, $db_pass;

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name",
                      $db_user, $db_pass);

        $db->query("SET NAMES 'utf8'");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        die("A database error was encountered");
    }

    return ($db);
}

function dbDisconnect ($db) {

    $db = null;
}

?>
