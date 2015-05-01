<?php
/**
 * A palindromic number reads the same both ways.
 * The largest palindrome made from the product of two 2-digit numbers is 9009 = 91 × 99.
 * Find the largest palindrome made from the product of two 3-digit numbers.
 */

for ($i = 10; $i < 100; $i++) {
	for ($j = 10; $j < 100; $j++) {
		if (is_palindrome($i*$j)) { $largest2DigitPalindrome = $i*$j; }
	}
}

for ($i = 100; $i < 1000; $i++) {
	for ($j = 100; $j < 1000; $j++) {
		$product = $i*$j;
		if (is_palindrome($product)) { 
			if($product > $largest3DigitPalindrome) { $largest3DigitPalindrome = $product; }
		}
	}
}

var_dump($largest2DigitPalindrome);
var_dump($largest3DigitPalindrome);

function is_palindrome($num) {
	$num = (string) $num;
	$len = strlen($num);
	
	for ($i = 0; $i < floor(strlen($num)/2); $i++) {
		if ($num[$i] !== $num[$len-($i+1)]) { return false; }
	}

	return true;
}
