<?php

namespace Test\Monadic;

use Monadic\ListLike;

class ListLikeTest extends \PHPUnit_Framework_TestCase
{
	public function testUnit()
	{
		$listLike = ListLike::unit(1,2,3);
		$this->assertInstanceOf("Monadic\ListLike", $listLike);
	}

	public function testBind()
	{
		$listLike = ListLike::unit(1,2,3);
		$this->assertInstanceOf("Monadic\ListLike", $listLike);
		$listLike = $listLike->bind(function($val) {
			return ListLike::unit($val,$val,$val);
		});
		$this->assertEquals(1, $listLike[0]);
		$this->assertEquals(2, $listLike[3]);
		$this->assertEquals(3, $listLike[6]);
	}

	public function testBind2()
	{
		$listLike = ListLike::unit(1,2,3);
		$this->assertInstanceOf("Monadic\ListLike", $listLike);
		$listLike = $listLike->bind(function($val) {
			return ListLike::unit($val * 2);
		});
		$this->assertEquals(2, $listLike[0]);
		$this->assertEquals(4, $listLike[1]);
		$this->assertEquals(6, $listLike[2]);
	}

	public function testFmap()
	{
		$listLike = ListLike::unit(1,2,3);
		$this->assertInstanceOf("Monadic\ListLike", $listLike);
		$listLike = $listLike->fmap(function($val) {
			return $val * 2;
		});
		$this->assertEquals(2, $listLike[0]);
		$this->assertEquals(4, $listLike[1]);
		$this->assertEquals(6, $listLike[2]);
	}
}
