<?php
namespace Monadic;

use Monadic\ValueClass\Bool;

class BoolTest extends \PHPUNit_Framework_TestCase
{
	public function testEquivalence()
	{
		$number = new Bool(true);
		$this->assertTrue($number->equals(new Bool(true)));
	}
}
