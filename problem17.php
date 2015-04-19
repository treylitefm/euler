#!/usr/bin/php
<?php

/**
 * If the numbers 1 to 5 are written out in words: one, two, three, four, five, 
 * then there are 3 + 3 + 5 + 4 + 4 = 19 letters used in total.
 *
 * If all the numbers from 1 to 1000 (one thousand) inclusive were written out
 * in words, how many letters would be used?
 *
 * NOTE: Do not count spaces or hyphens. For example, 342 (three hundred and forty-two)
 *  contains 23 letters and 115 (one hundred and fifteen) contains 20 letters. The use of
 *  "and" when writing out numbers is in compliance with British usage.
 */

include __DIR__ . '/problem13.php';

$output = '';
$n = 1000;

for ($i = 1; $i <= $n; $i++) {
	  $next = (new Number($i))->printWords();
	  $output .= $next;
	  print $i . ': ' .$next . PHP_EOL;
}

$count = 0;

for ($i = 0; $i < strlen($output); $i++) {
	if (ctype_alpha($output[$i])) {
		$count++;
	}
}

print "In total, $count letters were used in printing the numbers from 1 to $n in words.\n";

class Number
{
	public $num;

	public function __construct($num)
	{
		$this->num = new LinkedList($num);
	}

	public function printWords()
	{
		$num = $this->num->getNum();

		if ($num > 1000) {
			return 'Sorry dawg, I cant :(' . PHP_EOL;
		}

		$words = '';

		if ($num == 1000) {
			$words .= 'one thousand';
			return $words;
		}

		$words .= $this->onesTens($num);


		return $words;
	}

	/**
	 * Expects at most a 3 digit number
	 */
	private function onesTens($n)
	{
		$n = (string) $n;
		$n = str_pad($n, 3, '0', STR_PAD_LEFT);

		$words .= $this->getOnes($n[0]);

		if ($n[0] != 0) {
			$words .= 'hundred ';

			if ($n[1] != 0 || $n[2] != 0) {
				$words .= 'and ';
			}
		}

		$n = substr($n, 1, 2); //shave off the hundreds

		if ($n >= 10 && $n < 20) {
			switch ($n) {
			case 10:
				$words .= 'ten ';
				break;
			case 11:
				$words .= 'eleven ';
				break;
			case 12:
				$words .= 'twelve ';
				break;
			case 13:
				$words .= 'thirteen ';
				break;
			case 14:
				$words .= 'fourteen ';
				break;
			case 15:
				$words .= 'fifteen ';
				break;
			case 16:
				$words .= 'sixteen ';
				break;
			case 17:
				$words .= 'seventeen ';
				break;
			case 18:
				$words .= 'eighteen ';
				break;
			case 19:
				$words .= 'nineteen ';
				break;
			}
		} else {
			$words .= $this->getTens($n[0]);
			$words .= $this->getOnes($n[1]);
		}
			
		return $words;
	}

	private function getOnes($n)
	{
		if ($n == 0) {
			return '';
		} elseif ($n == 1) {
			return 'one ';
		} elseif ($n == 2) {
			return 'two ';
		} elseif ($n == 3) {
			return 'three ';
		} elseif ($n == 4) {
			return 'four ';
		} elseif ($n == 5) {
			return 'five ';
		} elseif ($n == 6) {
			return 'six ';
		} elseif ($n == 7) {
			return 'seven ';
		} elseif ($n == 8) {
			return 'eight ';
		} elseif ($n == 9) {
			return 'nine ';
		}
	}

	private function getTens($n)
	{
		if ($n == 0) {
			return '';
		} elseif ($n == 2) {
			return 'twenty ';
		} elseif ($n == 3) {
			return 'thirty ';
		} elseif ($n == 4) {
			return 'forty ';
		} elseif ($n == 5) {
			return 'fifty ';
		} elseif ($n == 6) {
			return 'sixty ';
		} elseif ($n == 7) {
			return 'seventy ';
		} elseif ($n == 8) {
			return 'eighty ';
		} elseif ($n == 9) {
			return 'ninety ';
		}
	}
}
