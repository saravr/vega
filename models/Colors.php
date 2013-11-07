<?php 

require_once '../includes/dbconnect.php';

class Colors {

    public function __construct($id = null) {

        $this->db = $id;
    }

    public function getColors () {

        $cmd = "select color from Colors group by color";
        $st = $this->db->prepare($cmd);
        $st->execute();

        // Returns an array of Colors objects:
        return $st->fetchAll(PDO::FETCH_CLASS, "Colors");
    }

    private $db;
}

$db = dbConnect();

$colors = new Colors($db);

if ($_GET['req'] == "colors") {
    echo json_encode($colors->getColors());
}

dbDisconnect($db);

?>
