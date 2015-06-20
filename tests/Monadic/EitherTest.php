<?php

namespace Test\Monadic;

use Monadic\Either;
use Monadic\Either\Left;
use Monadic\Either\Right;

class EitherTest extends \PHPUnit_Framework_TestCase
{
	public function testRight()
	{
		$either = Right::unit(1);
		$this->assertInstanceOf("Monadic\Either", $either);
		$this->assertInstanceOf("Monadic\Either\Right", $either);
		$this->assertEquals(1, $either->get());
	}

	public function testLeft()
	{
		$either = Left::unit(1);
		$this->assertInstanceOf("Monadic\Either", $either);
		$this->assertInstanceOf("Monadic\Either\Left", $either);
		$this->assertEquals(1, $either->get());
	}

	public function testRightToLeftToRight()
	{
		$either = Right::unit(1);
		$right = $either->bind(function($val) {
			return Left::unit($val + 1);
		})->left(function($val) {
			return Right::unit($val + 1);
		})->left(function($val) {
			// not executed
			$this->fail("this method must not be executed.");
			return Right::unit($val + 1);
		});
		$this->assertInstanceOf("Monadic\Either", $right);
		$this->assertInstanceOf("Monadic\Either\Right", $right);
		$this->assertEquals(3, $right->get());
	}
}
