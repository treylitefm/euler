<?php
/**
 * Problem 1
 * If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9.
 * The sum of these multiples is 23.
 *
 * Find the sum of all the multiples of 3 or 5 below 1000.
 *
 */
print 'First number?' . PHP_EOL;
$a = read_stdin();
print 'Second number?' . PHP_EOL;
$b = read_stdin();
print 'Upper bound?' . PHP_EOL;
$upperBound = read_stdin();

if (!is_numeric($a) || !is_numeric($b) || !is_numeric($upperBound)) { die('Not a number dawg :(' . PHP_EOL); }

$sum = multiplesBelow($a,$b, $upperBound);

print "Sum of all multiples of $a or $b below $upperBound: $sum " . PHP_EOL;


function multiplesBelow($a, $b, $upperBound) {
	$sum = 0;

	for ($i = 0; $i < $upperBound; $i++) {
		if ($i%$a == 0 || $i%$b == 0) {
			$sum += $i;
		}
	}

	return $sum;
}

function read_stdin()
{
    $fr = fopen('php://stdin', 'r');
    $input = fgets($fr, 128);
    $input = rtrim($input);
    fclose($fr);
    return $input;
}
