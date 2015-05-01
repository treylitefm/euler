<?php

include __DIR__ . '/O_Math.php';

/**
 * By listing the first six prime numbers: 2, 3, 5, 7, 11, and 13,
 * we can see that the 6th prime is 13.
 * What is the 10 001st prime number?
 */

$i = 1;
$count = 0;
while ($count < 10001) {
	if (O_Math::is_prime(++$i)) {
		$count++;
	}

}

print_r([$i,$count]);
