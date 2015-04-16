<?php

include __DIR__ . '/SortFactory.php';

class SorterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider getUnsortedArrays
	 */
	public function testSelectionSort($arr)
	{
		$this->assertSorted(SortFactory::selectionSort($arr), 'Array was not sorted correctly');
	}

	/**
	 * @dataProvider getUnsortedArrays
	 */
	public function testInsertionSort($arr)
	{
		$this->assertSorted(SortFactory::insertionSort($arr), 'Array was not sorted correctly');
	}

	/**
	 * @dataProvider getUnsortedArrays
	 */
	public function testBubbleSort($arr)
	{
		$this->assertSorted(SortFactory::bubbleSort($arr), 'Array was not sorted correctly');
	}

	/**
	 * todo: Only works for an array full of non-unique values
	 *
	 * @dataProvider getUnsortedArrays
	 */
	public function testQuickSort($arr)
	{
		if ($this->hasDupes($arr)) {
			$this->markTestSkipped(
				'This implementation of quick sort only works for arrays with unique values.'
			);
		}
		//date_default_timezone_set('America/Vancouver');
		//fwrite(fopen(__DIR__ . '/log','a'), print_r([date('r'),$arr], true));

		$this->assertSorted(SortFactory::quickSort($arr), 'Array was not sorted correctly');
	}

	/**
	 * @dataProvider getUnsortedArrays
	 */
	public function testHeapSort($arr)
	{
		$this->assertSorted(SortFactory::heapSort($arr), 'Array was not sorted correctly');
	}

	/**
	 * @dataProvider getUnsortedArrays
	 */
	public function testMergeSort($arr)
	{
		$this->assertSorted(SortFactory::mergeSort($arr), 'Array was not sorted correctly');
	}

	/**
	 * @dataProvider getUnsortedArrays
	 */
	public function testV2MergeSort($arr)
	{
		$this->assertSorted(SortFactory::v2MergeSort($arr, 0, count($arr)), 'Array was not sorted correctly');
	}

	public function assertSorted($sorted)
	{
		$this->assertNotEmpty($sorted);

		for ($i = 0; $i < count($sorted); $i++) {
			if (isset($sorted[$i+1])) {
				$this->assertTrue($sorted[$i] <= $sorted[$i+1]);
			}
		}	
	}

	public function getUnsortedArrays()
	{
		$randos = [];
		
		for ($i = 0; $i < 1; $i++) {
			for ($j = 0; $j < 1000; $j++) {
				$randos[$j] = mt_rand(0,1000);
			}
		}

		return [
			[[10,9,8,7,6,5,4,3,2,1]],
			[$randos],
			[[0,1,2,3,4,5,6,7,8,9,10]],
			[[0,0,0,]],
			[[0,1,1,0,]]
		];
	}

	public function hasDupes($arr)
	{
		for ($i = 0; $i < count($arr); $i++)
			for ($j = $i+1; $j < count($arr); $j++) {
				if ($arr[$i] == $arr[$j]) {
					//print_r([$i,$j]);
					//print_r([$arr[$i],$arr[$j]]);
					return true;
				}
			}
		return false;
	}
		
}
