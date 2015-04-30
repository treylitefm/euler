<?php

include __DIR__ . '/problem13.php';

$list = new LinkedList(2);
$i = 1;

while ($i < 1000) {
	$list->add($list->getNum());
	$i++;
}

print "2 to the $i:\n";
$list->printNum();
echo PHP_EOL;
$num = $list->getNum();
$sum = new LinkedList(0);

for ($j = 0; $j < strlen($num); $j++) {
	$sum->add($num[$j]);
}

print_r([$sum->getNum()]);
echo PHP_EOL;
