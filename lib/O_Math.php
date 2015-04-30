<?php

class O_Math
{
	public static function is_prime($num)
	{
		return count(self::factor($num)) == 1 ? true : false;
	}

	public static function factor($num, &$factors = [])
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
					self::factor($num/$i, $factors);
				}
				break;
			}
		}

		if ($tmp == $factors) { // if factors remains unchanged, its prime 
			$factors[] = $num;
		}

		return $factors;

	}

	public static function divisors($num)
	{
		$sqrt = sqrt($num);
		$divisors = [];

		for ($i = 1; $i <= floor($sqrt); $i++) {
			if ($num % $i == 0) {
				$divisors[] = $i;
				$divisors[] = $num/$i;
			}
		}
		
		return $divisors;
	}

	public static function is_square($num)
	{
		if ($num == 1 || $num == 0) {
			return true;
		}

		$factors = O_Math::factor($num);
		
		if (count($factors) % 2 !== 0 || $num < 0) {
			return false;
		}

		$i = 0;

		while (!empty($factors)) {
			if ($factors[$i] === $factors[$i+1]) {
				unset($factors[$i]);
				unset($factors[$i+1]);
				$i += 2;
			} else {
  				return false;
			}
		}

		return true;
	}

}
