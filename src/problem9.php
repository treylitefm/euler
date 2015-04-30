<?php

include __DIR__ . '/O_Math.php';

/**
 * A Pythagorean triplet is a set of three natural numbers, a < b < c, for which,
 * 
 * a2 + b2 = c2
 * For example, 32 + 42 = 9 + 16 = 25 = 52.
 * 
 * There exists exactly one Pythagorean triplet for which a + b + c = 1000.
 * Find the product abc.
 */


// print all squares from 1 to n
// start at largest square c, and do c - a == square,b ? if yes, pythagorean triple, else keep going until c == a
//
//
//
$sqrs = [];

for ($i = 1; $i < 1005; $i++) {
	$sqrs[] = $i*$i;
}

for ($i = count($sqrs)-1; $i >= 0; $i--) {
	for ($j = 0; $j < $i; $j++) {
		$a2 = $sqrs[$i]-$sqrs[$j];
		$b2 = $sqrs[$j];
		$c2 = $sqrs[$i];

		if (O_Math::is_square($a2)) {// && (sqrt($a2) + sqrt($b2) + sqrt($b3)) == 12) {
			$a = sqrt($a2);
			$b = sqrt($b2);
			$c = sqrt($c2);
			$sum = ($a + $b + $c);

			if ($sum == 1000) {
				$bingo = [$a,$b,$c];
				print_r(
					[
						'c^2: ' . $c2,
						'b^2: ' . $b2, 
						'a^2: ' . $a2,
						'c: ' . $c,
						'b: ' . $b,
						'a: ' . $a,
						'sum: ' . $sum
					]
				);
			}
		}
	}
}

print_r([
	'bingo' => $bingo,
	'product' => $bingo[0]*$bingo[1]*$bingo[2]

]);
//print_r($sqrs);
/*
    [0] => 1
    [1] => 4
    [2] => 9
    [3] => 16
    [4] => 25
    [5] => 36
    [6] => 49
    [7] => 64
    [8] => 81
    [9] => 100
    [10] => 121
    [11] => 144
    [12] => 169
	[13] => 196
 */
