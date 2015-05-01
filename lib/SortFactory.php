<?php

class SortFactory
{
	public static function selectionSort($arr)
	{
		for ($j = count($arr); $j > 0; $j--) {
			$small = count($arr) - $j;
			for ($i = count($arr)-$j; $i < count($arr); $i++) {
				if ($arr[$i] <= $arr[$small]) {
					$small = $i;
				}
			}

			$tmp = $arr[$small];
			$arr[$small] = $arr[count($arr)-$j];
			$arr[count($arr)-$j] = $tmp;
		}

		return $arr;
	}

	public static function insertionSort($arr)
	{
		for ($end = 0; $end < count($arr); $end++) {
			if ($end > 0 && $arr[$end] < $arr[$end-1]) {
				$endTemp = $end;
				while ($arr[$endTemp] < $arr[$endTemp-1] && $endTemp > 0) {
					$tmp = $arr[$endTemp];
					$arr[$endTemp] = $arr[$endTemp-1];
					$arr[$endTemp-1] = $tmp;
					$endTemp--;
				}
			}
		}

		return $arr;
	}

	public static function bubbleSort($arr)
	{
		for ($end = count($arr); $end > 0; $end--) {
			for ($i = 0; $i < $end; $i++) {
				if ($arr[$i] > $arr[$i+1]) {
					$tmp = $arr[$i];
					$arr[$i] = $arr[$i+1];
					$arr[$i+1] = $tmp;
				}
			}
		}

		return $arr;
	}

	public static function quickSort($arr)
	{
		self::partition($arr, 0, count($arr)-1);
		
		return $arr;
	}

	public static function partition(&$arr, $left, $right)
	{
		if ($left >= $right) {
			return;
		}

		$lstart = $left;
		$rstart = $right;

		$pivot = mt_rand($left, $right);

		while ($left !== $right) {
			while ($arr[$left] < $arr[$pivot] && $left <= $pivot) {
				$left++;	
			}
			while ($arr[$right] > $arr[$pivot] && $right >= $pivot) {
				$right--;
			}

			if ($left !== $right) {
				$tmp = $arr[$right];
				$arr[$right] = $arr[$left];
				$arr[$left] = $tmp;

				if ($left == $pivot) { 
					$pivot = $right; //pivot swapped
				} elseif ($right == $pivot) {
					$pivot = $left; //pivot swapped
				}
			}
		}

		self::partition($arr, $lstart, $pivot-1); //partition left
		self::partition($arr, $pivot+1, $rstart); //partition right
	}

	public static function mergeSort($arr)
	{
		$temp = [];

		for ($i = 1; $i < count($arr); $i = $i*2) {
			for ($j = 0; $j < count($arr); $j = $j+($i*2)) {
				$temp = array_merge($temp, self::merge(array_slice($arr, $j, $i*2), $j, $i));
			}
			$arr = $temp;
			$temp = [];
		}

		return $arr;
	}

	private static function merge($arr, $start, $n)
	{
		$start = 0;
		$n2 = count($arr) - $n;
		$i = $start;
		$j = $start + $n;
		$k = $start;
		$merged = [];

		while ($i < $n && $j < ($start + $n + $n2)) {
			if ($arr[$i] < $arr[$j]) {
				$merged[$k] = $arr[$i];
				$i++;
				$k++;
			} else {
				$merged[$k] = $arr[$j];
				$j++;
				$k++;
			}
		}

		while ($i < $n) {
			$merged[$k++] = $arr[$i++];
		}

		while ($j < ($start + $n + $n2)) {
			$merged[$k++] = $arr[$j++];
		}

		return $merged;
	}

	public static function heapSort($arr)
	{
		for ($i = 0; $i < count($arr); $i++) {
			self::heapAdd($arr, $i);
		}
		
		for ($end = count($arr)-1; $end > 0; $end--) {
			$arr[$end] = self::heapRemove($arr, $end);
		}
		
		return $arr;
	}

	private static function heapAdd(&$arr, $i) //heapify upwards
	{
		//parent (n-1)/2
		
		while (floor(($i-1)/2) >= 0 && $arr[$i] > $arr[floor(($i-1)/2)]) {
			$tmp = $arr[$i];
			$arr[$i] = $arr[floor(($i-1)/2)];
			$arr[($i-1)/2] = $tmp;
			$i = ($i-1)/2;
		}
	}

	public static function heapRemove(&$arr, $end)
	{
		//child 2n+1 or 2n+2
		$removed = $arr[0];
		$arr[0] = $arr[$end];
		unset($arr[$end]);
		
		$i = 0;
		while ((2*$i)+1 < $end && $arr[$i] < max($arr[2*$i+1], $arr[2*$i+2])) {
			if ($arr[2*$i+2] >= $arr[2*$i+1]) {
				$tmp = $arr[$i];
				$arr[$i] = $arr[2*$i+2];
				$arr[2*$i+2] = $tmp;
				$i = 2*$i+2;
			} else {
				$tmp = $arr[$i];
				$arr[$i] = $arr[2*$i+1];
				$arr[2*$i+1] = $tmp;
				$i = 2*$i+1;
			}
		}		
		
		return $removed;
	}

	/******V2-second attempts******/

	public static function v2MergeSort(&$arr, $first, $n)
	{
		if ($n > 1) {
			$n1 = floor($n/2);
			$n2 = $n-$n1;
			self::v2MergeSort($arr, $first, $n1);
			self::v2MergeSort($arr, $first+$n1, $n2);
			self::v2Merge($arr, $first, $n1, $n2);
		}

		return $arr;
	}

	private static function v2Merge(&$arr, $first, $n1, $n2)
	{
		$tmp = [];
		$copied = $copied1 = $copied2 = 0;

		while ($copied1 < $n1 && $copied2 < $n2) {
			if ($arr[$first+$copied1] <= $arr[$first+$n1+$copied2]) {
				$tmp[$copied++] = $arr[$first+($copied1++)];
			} else {
				$tmp[$copied++] = $arr[($first+$n1)+($copied2++)];
			}
		}
		while ($copied < $n1+$n2) {
			if ($copied1 < $n1) {
				$tmp[$copied++] = $arr[$first+($copied1++)];
			} elseif ($copied2 < $n2){
				$tmp[$copied++] = $arr[($first+$n1)+($copied2++)];
			}
		}
		for ($i = 0; $i < $n1+$n2; $i++) {
			$arr[$first+$i] = $tmp[$i];
		}
	}
}
