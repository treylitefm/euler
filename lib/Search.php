<?php

function bSearch($arr, $target)
{
	$size = $high = count($arr);
	$low = 0;

	while ($low + 1 < $high) {
		$test = floor(($low + $high)/2);
		if ($arr[$test] > $target) {
			$high = $test;
		} else {
			$low = $test;
		}
	}

	if ($arr[$low] === $target) {
		return $low;
	} else {
		return false;
	}
}

/*function bSearch($arr, $target)
{
	$mid = floor(count($arr)/2);

	while () {
		if ($arr[$mid] === $target) {

		}
	}
}*/

print_r(bSearch([1,2,3,4], 1)); 
echo PHP_EOL;
print_r(bSearch([1,2,3,4], 2));
echo PHP_EOL;
print_r(bSearch([1,2,3,4], 3));
echo PHP_EOL;
print_r(bSearch([1,2,3,4], 4));
echo PHP_EOL;


print_r(bSearch([1,2,3,4,5], 1)); 
echo PHP_EOL;
print_r(bSearch([1,2,3,4,5], 2));
echo PHP_EOL;
print_r(bSearch([1,2,3,4,5], 3));
echo PHP_EOL;
print_r(bSearch([1,2,3,4,5], 4));
echo PHP_EOL;
print_r(bSearch([1,2,3,4,5], 5));
