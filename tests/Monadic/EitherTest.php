<?php

namespace Monadic;

use Monadic\Type\Either;
use Monadic\Type\Either\Left;
use Monadic\Type\Either\Right;

class EitherTest extends \PHPUnit_Framework_TestCase
{
	public function testRight()
	{
		$either = Right::unit(1);
		$this->assertInstanceOf("Monadic\Type\Either", $either);
		$this->assertInstanceOf("Monadic\Type\Either\Right", $either);
		$this->assertEquals(1, $either->get());
	}

	public function testLeft()
	{
		$either = Left::unit(1);
		$this->assertInstanceOf("Monadic\Type\Either", $either);
		$this->assertInstanceOf("Monadic\Type\Either\Left", $either);
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
		$this->assertInstanceOf("Monadic\Type\Either", $right);
		$this->assertInstanceOf("Monadic\Type\Either\Right", $right);
		$this->assertEquals(3, $right->get());
	}

	public function testFmapRight()
	{
		$either = Right::unit(2);
		$either->fmapRight(function($val) {
			return $val * 2;
		})->fmapLeft(function($val) {
			$this->fail("this method must not be called.");
			return null;
		});
		$this->assertEquals(4, $either->get());
	}

	public function testFmapLeft()
	{
		$either = Left::unit(2);
		$either->fmapLeft(function($val) {
			return $val * 2;
		})->fmapRight(function($val) {
			$this->fail("this method must not be called.");
			return null;
		});
		$this->assertEquals(4, $either->get());
	}
}
