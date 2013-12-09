<?php

include "../models/all.php";

function showItems ($catname) {

    echo "<div data-role=content>\n";
    echo "<div class=content-primary>\n";
    echo "<ul data-role=listview data-inset=true data-theme=a>\n";

    $obj = new $catname;
    $rec = $obj->findAll();
    foreach ($rec as $item) {
        $dfld1 = $item['_dfld1'];
        $val1 = $item[$dfld1];
        $dfld2 = $item['_dfld2'];
        $val2 = $item[$dfld2];
        echo "<li><a href=../views/$catname.view.php?req=show&id=$val2>$val1 <div class='ui-li-aside'>$val2</div></a></li>\n";
    }
    echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";
}

?>
