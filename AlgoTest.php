<?php

include __DIR__ . '/problem13.php';

class AlgoTest extends PHPUnit_Framework_Testcase
{
	public function testProblem13()
	{
		$list = new LinkedList(34);
		$this->assertEquals(34, $list->value);

		$list->add(100);
		$this->assertEquals(134, $list->value);
		
		$list->add(1100);
		$this->assertEquals(1234, $list->getNum());
		
		$list2 = new LinkedList(210481240);
		$list2->add(13142512100);
		$this->assertEquals(13352993340, $list2->getNum());

	}
}
