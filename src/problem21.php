<?php
/**
 * Let d(n) be defined as the sum of proper divisors of n (numbers less than n which divide evenly into n).
 * If d(a) = b and d(b) = a, where a ≠ b, then a and b are an amicable pair and each of a and b are called amicable numbers.
 * 
 * For example, the proper divisors of 220 are 1, 2, 4, 5, 10, 11, 20, 22, 44, 55 and 110;
 * therefore d(220) = 284. The proper divisors of 284 are 1, 2, 4, 71 and 142; so d(284) = 220.
 * 
 * Evaluate the sum of all the amicable numbers under 10000.
 */

$d = [];

for ($i = 2; $i < 10000; $i++) {
	$d[$i] = sumArray(factor($i));
	//print_r(factor($i));
}

$sum = 0;

for ($i = 2; $i < 10000; $i++) {
	$j = $d[$i];

	if ($d[$i] === $j && $d[$j] === $i && $i !== $j) {
		print_r([$d[$i], $d[$j]]);
		$sum += $i;
	}
}

print_r([$sum]);
//print_r($d);

function sumArray($arr)
{
	$sum = 0;

	foreach ($arr as $element) {
		$sum += $element;
	}

	return $sum;
}

function factor($num, $factors = [1])
{
	$sqrt = sqrt($num);
	$tmp = $factors;

	for ($i = 2; $i <= floor($sqrt); $i++) {
		if ($num % $i == 0) { //if number is divisible by i, then its a factor.
			$factors[] = $i;

			$quot = $num/$i;
			if ($i !== $quot) {
				$factors[] = $quot;
			}
		}
	}

	return $factors;
}
