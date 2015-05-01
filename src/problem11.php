<?php

include __DIR__ . '/SortFactory.php';

/**
 * In the 20×20 grid below, four numbers along a diagonal line have been marked in red
 *
 * https://projecteuler.net/problem=11
 *
 * The product of these numbers is 26 × 63 × 78 × 14 = 1788696.
 *
 * What is the greatest product of four adjacent numbers in the same direction (up, down,
 * left, right, or diagonally) in the 20×20 grid?
 */

$problem = `curl -s https://projecteuler.net/problem=11`;
$matches = [];

preg_match_all('/(\d{2} ?)+<\/?[bs]/', $problem, $matches);

$grid = [];
$list = [];

foreach($matches[0] as $row) {
	$row = explode(' ', $row);
	$j = 0;
	foreach($row as $element) {
		$element = sanitize($element);
		if ($element) {
			$list[] = $element;
		}
	}
}

$i = $j = 0;
foreach ($list as $item) {
	if ($j == 20) {
		$j = 0;
		$i++;
	}
	$grid[$i][$j] = $item;
	$j++;
}


$grid = new Grid($grid);
$grid->setProducts();
print_r([$grid->getMax()]);

function sanitize($element)
{
	if (!is_numeric($element)) {
		$index = strpos($element, '<');
		if ($index !== 0) {
			$element = substr($element, 0, 2);
		} else {
			return false;
		}
	}
	return $element;
}

class Cell
{
	public $products;
	public $max;
	public $value;
	public $x,$y;

	public function __construct($value, $x, $y)
	{
		$this->value = $value;
		$this->x = $x;
		$this->y = $y;
		$products = [];
	}

	public function getMax()
	{
		if (empty($this->max)) {
			$nums = [];
			foreach ($this->products as $prod) {
				$nums[] = $prod;
			}

			$sorted = SortFactory::heapSort($nums);
			$this->max = $sorted[count($sorted)-1];
		}
		
		return $this->max;
	}

}

class Grid
{
	public $grid;
	public $max;

	public function __construct($grid)
	{
		$this->grid = $grid;

		for ($i = 0; $i < 20; $i++) {
			for ($j = 0; $j < 20; $j++) {
				$this->grid[$i][$j] = new Cell($grid[$i][$j],$j,$i);
			}
		}
	}

	public function getMax()
	{
		if (empty($this->max)) {
			$nums = [];

			for ($i = 0; $i < 20; $i++) {
				for ($j = 0; $j < 20; $j++) {
					$nums[] = $this->grid[$j][$i]->getMax();
				}
			}

			$sorted = SortFactory::heapSort($nums);
			$this->max = $sorted[count($sorted)-1];
		}

		return $this->max;
	}

	public function setProducts()
	{
		for ($i = 0; $i < 20; $i++) {
			for ($j = 0; $j < 20; $j++) {
				$this->setNorthProduct($this->grid[$j][$i]);
				$this->setSouthProduct($this->grid[$j][$i]);
				$this->setEastProduct($this->grid[$j][$i]);
				$this->setWestProduct($this->grid[$j][$i]);

				$this->setNorthEastProduct($this->grid[$j][$i]);
				$this->setNorthWestProduct($this->grid[$j][$i]);
				$this->setSouthEastProduct($this->grid[$j][$i]);
				$this->setSouthWestProduct($this->grid[$j][$i]);
			}
		}
	}

	public function setNorthProduct(&$cell)
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x][$y-3])) {
			return false;
		}
		for ($j = $y; $j > $y-4; $j--) {
			$product *= $this->grid[$j][$x]->value;
		}

		$cell->products['north'] = $product;
	}

	public function setSouthProduct(&$cell)
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x][$y+3])) {
			return false;
		}
		for ($j = $y; $j < $y+4; $j++) {
			$product *= $this->grid[$j][$x]->value;
		}

		$cell->products['south'] = $product;
	}

	public function setEastProduct(&$cell)
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x+3][$y])) {
			return false;
		}
		for ($i = $x; $i < $x+4; $i++) {
			$product *= $this->grid[$y][$i]->value;
		}

		$cell->products['east'] = $product;
	}

	public function setWestProduct(&$cell)
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x-3][$y])) {
			return false;
		}
		for ($i = $x; $i > $x-4; $i--) {
			$product *= $this->grid[$y][$i]->value;
		}

		$cell->products['west'] = $product;
	}

	public function setNorthEastProduct(&$cell)
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x+3][$y-3])) {
			return false;
		}
		for ($i = $x,$j = $y; $i < $x+4 && $j > $y-4; $i++,$j--) {
			$product *= $this->grid[$j][$i]->value;
		}

		$cell->products['northeast'] = $product;
	}
	
	public function setNorthWestProduct(&$cell) 
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x-3][$y-3])) {
			return false;
		}
		for ($i = $x,$j = $y; $i > $x-4 && $j > $y-4; $i--,$j--) {
			$product *= $this->grid[$j][$i]->value;
		}

		$cell->products['northwest'] = $product;
	}
	
	public function setSouthEastProduct(&$cell) 
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x+3][$y+3])) {
			return false;
		}
		for ($i = $x,$j = $y; $i < $x+4 && $j < $y+4; $i++,$j++) {
			$product *= $this->grid[$j][$i]->value;
		}

		$cell->products['southeast'] = $product;
	}


	public function setSouthWestProduct(&$cell) 
	{
		$x = $cell->x;
		$y = $cell->y;
		$product = 1;
		if (empty($this->grid[$x-3][$y+3])) {
			return false;
		}
		for ($i = $x,$j = $y; $i > $x-4 && $j < $y+4; $i--,$j++) {
			$product *= $this->grid[$j][$i]->value;
		}

		$cell->products['southwest'] = $product;
	}
}
