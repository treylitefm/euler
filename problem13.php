#!/usr/bin/php
<?php
/**
 * https://projecteuler.net/problem=13
 */

$problem = `curl -s https://projecteuler.net/problem=13`;
$matches = [];

preg_match_all('/\d{50}/', $problem, $matches);

//print_r($matches);

$list = new LinkedList(0);

foreach($matches[0] as $num) {
	$list->add($num);
}

print substr($list->getNum(), 0, 10) . PHP_EOL;

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

	public function getNum($num = '')
	{
		if ($this->link === null) {
			return $this->value;
		} else {
			return $this->link->getNum() . $this->value;
		}
	}

	public function add($num) 
	{
		if (!is_a($num, 'LinkedList')) {
			$num = new LinkedList($num);
		}
		
		$this->value += $num->value;
		
		if ($this->value >= 1000) {
			if ($this->link === null) {
				$this->link = new LinkedList(1);
			} else {
				$this->link->value++;
			}
			$this->value -= 1000;
		}
		$this->value = str_pad($this->value, 3, '0', STR_PAD_LEFT);

		if (!empty($num->link)) {
			if ($this->link === null) {
				$this->link = $num->link;
			} else {
				$this->link->add($num->link);
			}
		}
	}
}
