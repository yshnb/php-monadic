<?php

namespace Test\Monadic;

use Monadic\Maybe;
use Monadic\Maybe\Nothing;

class MaybeTest extends \PHPUnit_Framework_TestCase
{
	public function testUnit()
	{
		$maybe = Maybe::unit(1);
		$this->assertInstanceOf("Monadic\Maybe", $maybe);
		$this->assertInstanceOf("Monadic\Maybe\Just", $maybe);
		$this->assertEquals(1, $maybe->get());
	}

	public function testJustCase()
	{
		$maybe = Maybe::unit(1)->bind(function($val) {
			return Maybe::unit($val * 2);
		})->bind(function($val) {
			return Maybe::unit($val * 2);
		});
		$this->assertInstanceOf("Monadic\Maybe\Just", $maybe);
		$this->assertEquals(4, $maybe->get());
	}

	public function testNothingCase()
	{
		$maybe = Maybe::unit(1)->bind(function($val) {
			return Nothing::unit();
		})->bind(function($val) {
			$this->fail("this method must not be executed.");
			return Nothing::unit();
		});
		$this->assertInstanceOf("Monadic\Maybe\Nothing", $maybe);
		$this->assertNull($maybe->get());
	}

	public function testFmap()
	{
		$maybe = Maybe::unit(1)->fmap(function($val) {
			return null;
		})->fmap(function($val) {
			$this->fail("this method must not be executed.");
			return null;
		});
		$this->assertInstanceOf("Monadic\Maybe\Nothing", $maybe);
		$this->assertNull($maybe->get());
	}
}

