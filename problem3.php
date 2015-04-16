#!/usr/bin/php
<?php
/**
 * The prime factors of 13195 are 5, 7, 13 and 29.
 * What is the largest prime factor of the number 600851475143 ?
 */
//$num = 13195;
//$num = 100;
var_dump(largestPrime(100));
var_dump(largestPrime(10));
var_dump(largestPrime(12));
var_dump(largestPrime(16));
var_dump(largestPrime(13195));
var_dump(largestPrime(600851475143));


function largestPrime($num)
{
	$largestPrimeFactor = $num;
	
	for ($i = 2; $i <= (int) sqrt($num); $i++) {
		if ($num%$i == 0) { 
			$largestPrimeFactor = largestPrime($num/$i);
			break;
			// ^ passing largest factor to recursive function
		}
	}
	return $largestPrimeFactor;
}

