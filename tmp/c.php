<?php

include 'Contact.php';

$nm = 'Robert';
$ph = 4455;

$ct = new Contact();
$ct->name = $nm;
$ct->phone = $ph;
$ct->save();

echo "Now, let us find $nm\n";
$rec = $ct->find($nm);
foreach ($rec as $item) {
    $ph = $item['phone'];
    echo "Phone: $ph\n";
}
?>
