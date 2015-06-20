<?php

namespace Test\Monadic;

use Monadic\Identity;

class IdentityTest extends \PHPUNit_Framework_TestCase
{
	public function testUnit()
	{
		$identity = Identity::unit(1);
		$this->assertInstanceOf("Monadic\Identity", $identity);
		$this->assertEquals(1, $identity->get());
	}

	public function testBind()
	{
		$identity = Identity::unit(1)->bind(function($val) {
			return Identity::unit($val * 2);
		})->bind(function($val) {
			return Identity::unit($val * 2);
		});
		$this->assertInstanceOf("Monadic\Identity", $identity);
		$this->assertEquals(4, $identity->get());
	}

	public function testFmap()
	{
		$identity = Identity::unit(1)->fmap(function($val) {
			return $val * 2;
		})->fmap(function($val) {
			return $val * 2;
		});
		$this->assertInstanceOf("Monadic\Identity", $identity);
		$this->assertEquals(4, $identity->get());
	}
}

