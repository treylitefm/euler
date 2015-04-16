#!/usr/bin/php
<?php

set_error_handler("warning_handler", E_WARNING);

$list = new LinkedList(123142148210948);
$list->printNum();
echo PHP_EOL;
$list->add(52);
echo PHP_EOL;
echo PHP_EOL;
//$list->add(999);
$list->printNum();
echo PHP_EOL;
 
class LinkedList
{
	public $link;
	public $value;

	public function __construct($value)//,$link = null)
	{
		/*if (!is_num($value)) {
			throw new Exception('Value given to linked list is not a number!');
	}*/

		$length = strlen($value);

		//trim zeroes off the beginning?
		if ($length <= 3) {
			$this->value = $value;
			$this->link = $link;
		} else {
			$this->value = substr($value, -3, 3);
			$this->link = new LinkedList(substr($value, 0, $length-3));
		}	
	}

	public function printList()
	{
		print $this->value . PHP_EOL;
		if (!empty($this->link)) {
			$this->link->printList();
		}
	}

	public function printNum($num = '')
	{
		if ($this->link === null) {
			return $this->value;
		} else {
			print $this->link->printNum() . ',' . $this->value;
		}
	}

	public function add($num) 
	{
		if (get_class($num) !== 'LinkedList') {
			$num = new LinkedList($num);
		}

		var_dump($this->value, $num);
		$this->value += $num->value;
		var_dump($this->value, $num);
		if ($this->value >= 1000) {
			$this->link->value++;
			$this->value -= 1000;
		}
		$this->value = str_pad($this->value, 3, '0', STR_PAD_LEFT);

		if (!empty($num->link)) {
			$this->add($num->link);
		}
		/*
		$this->value += $num;
		$carry = 0;
print_r([$this->value, $num]);
		while ($this->value > 1000) { //needs fix: currently subtracting 1000 at a time. not sustainable
			$this->value -= 1000;
			$carry++;
		}
		if (!empty($this->link)) {
			$this->link->add(floor($num/1000)+$carry);
		} elseif ($num > 1000) {
			die('yo');
			$this->link = new LinkedList(floor($num/1000)+$carry);
		}*/
	}
}
