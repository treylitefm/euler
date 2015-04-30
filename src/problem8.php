<?php

/**
 * https://projecteuler.net/problem=8
 */


$problem = `curl -s "https://projecteuler.net/problem=8"`;

$rows = [];
preg_match_all('(\d{50})', $problem, $rows);

$rows = $rows[0];

$seriesLength = 13;

$groups = [];
foreach ($rows as $key => $row) {
	$num .= $row;
}
for ($i = 0; $i < strlen($num)-($seriesLength-1); $i++) {
	$groups[$i]['product'] = 1;	
	for ($j = $i; $j < $i+$seriesLength; $j++) {
		$groups[$i]['product'] *= $num[$j];
		$groups[$i][] = $num[$j];
	}
}

$largest = 0;

foreach ($groups as $key => $group) {
	if ($group['product'] >= $largest['product']) {
		$largest = $group;
	}
}

print_r([count($groups), count($groups[0]),$largest]);
