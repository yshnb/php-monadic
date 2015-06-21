<?php
namespace Monadic;

use Monadic\ValueClass\String;

class StringTest extends \PHPUNit_Framework_TestCase
{
	public function testEquivalence()
	{
		$number = new String("hoge");
		$this->assertTrue($number->equals(new String("hoge")));
	}
}
