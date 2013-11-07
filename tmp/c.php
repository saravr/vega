<?php

include 'Contact.php';

$nm = 'Greg';
$ph = 1111;

$ct = new Contact();
$ct->name = $nm;
$ct->phone = $ph;
$ct->save();

$nm = 'Brian';
echo "Now, let us find $nm\n";
$rec = $ct->find($nm);
foreach ($rec as $item) {
    echo "Phone: ";
    echo $item['phone'];
    echo "\n";
}
?>
