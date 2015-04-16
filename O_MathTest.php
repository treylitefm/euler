<?php

include __DIR__ . '/O_Math.php';

class O_MathTest extends PHPUnit_Framework_TestCase
{
	public function testIsPrime()
	{
		$this->assertTrue(O_Math::is_prime(2));
		$this->assertTrue(O_Math::is_prime(97));
		$this->assertTrue(O_Math::is_prime(1));
		$this->assertTrue(O_Math::is_prime(7));

		$this->assertNotTrue(O_Math::is_prime(10));
		$this->assertNotTrue(O_Math::is_prime(4));
		$this->assertNotTrue(O_Math::is_prime(16));
	}

	public function testFactor()
	{
		$this->assertEquals([2,5],O_Math::factor(10));

		$this->assertEquals([2,2],O_Math::factor(4));

		$this->assertEquals([97],O_Math::factor(97));

		$this->assertEquals([2,2,2,2],O_Math::factor(16));

	}

	public function testIsSquare()
	{
		$this->assertTrue(O_Math::is_square(1));
		$this->assertTrue(O_Math::is_square(4));
		$this->assertTrue(O_Math::is_square(36));
		$this->assertTrue(O_Math::is_square(100));
		$this->assertTrue(O_Math::is_square(10000));
		$this->assertNotTrue(O_Math::is_square(3));
		$this->assertNotTrue(O_Math::is_square(8));
		$this->assertNotTrue(O_Math::is_square(20));
		$this->assertNotTrue(O_Math::is_square(1000));
		$this->assertNotTrue(O_Math::is_square(100000));
	}

	public function testDivisors()
	{
		$divisors = O_Math::divisors(10);
		print_r($divisors);
		$this->assertContains(1, $divisors);
		$this->assertContains(2, $divisors);
		$this->assertContains(5, $divisors);
		$this->assertContains(10, $divisors);
	}
}
