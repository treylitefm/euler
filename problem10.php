#!/usr/bin/php
<?php

include __DIR__ . '/O_Math.php';

/**
 * The sum of the primes below 10 is 2 + 3 + 5 + 7 = 17.
 * 
 * Find the sum of all the primes below two million.
 */


$sum = 0;
$bound = 2000000;

for ($i = 2; $i < $bound; $i++) {
	if (O_Math::is_prime($i)) {
		$sum += $i;
	}	
}

print_r([$sum]);
