#!/usr/bin/php
<?php
include __DIR__ . '/SortFactory.php';
/**
 * 2520 is the smallest number that can be divided by each of the numbers from 1 to 10 without any remainder.
 * What is the smallest positive number that is evenly divisible by all of the numbers from 1 to 20?
 */

/*for ($i = 2; $i <= 20; $i++) {
	print_r([factor($i)]);
}*/

$product = 1;
$factors = [];

for ($i = 2; $i <= 100; $i++) {
	if (is_prime($i)) {
		$product *= $i; 
		$factors[] = $i;
	} else {
		$tmp = compare($factors, factor($i));
		if (!empty($tmp)) {
			$factors[] = $tmp;
			unset($tmp);
			$product *= end($factors);
			$factors = SortFactory::insertionSort($factors);
		}
	}
}

print_r([$product, $factors, factor(232792560)]);

function compare($factorsMain, $factorsB)
{
	$size = count($factorsMain);
	foreach ($factorsB as $key => $fac) {
		for ($i = 0; $i < $size; $i++) {
			if ($fac == $factorsMain[$i]) {
				unset($factorsMain[$i]);
				unset($factorsB[$key]);
				break;
			}
		}
	}

	return end($factorsB);
}

function is_prime($num)
{
	return count(factor($num)) == 1 ? true : false;
}

function factor($num, &$factors = [])
{
	$sqrt = sqrt($num);
	$tmp = $factors;

	for ($i = 2; $i <= floor($sqrt); $i++) {
		if ($num % $i == 0) { //if number is divisible by i, then its a factor. note: always prime!
			$factors[] = $i;

			// each factor has a complement, if i is square root, 
			//then add same number to factors
			if ($i == $sqrt) { 
				$factors[] = $i;
			} else { // else, factor complement 
				factor($num/$i, $factors);
			}
			break;
		}
	}

	if ($tmp == $factors) { // if factors remains unchanged, its prime 
		$factors[] = $num;
	}

	return $factors;
}
