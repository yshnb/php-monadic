<?php
namespace Monadic;

use Monadic\ValueClass\Number;

class NumberTest extends \PHPUNit_Framework_TestCase
{
	public function testEquivalence()
	{
		$number = new Number(1);
		$this->assertTrue($number->equals(new Number(1)));
	}
}
