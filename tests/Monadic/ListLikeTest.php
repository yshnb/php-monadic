<?php

namespace Monadic;

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

	public function testMonoidClosedRule()
	{
		$a = ListLike::unit(1,2,3);
		$b = ListLike::unit(4,5,6);
		$result = ListLike::add($a, $b);

		$this->assertInstanceOf("Monadic\ListLike", $result);
	}

	public function testMonoidIdentityRule()
	{
		$element = ListLike::unit(1,2,3);
		$identity = ListLike::unit();

		$element_add = ListLike::add($element, $identity);
		$this->assertEquals($element_add, $element);

		$element_add = ListLike::add($identity, $element);
		$this->assertEquals($element_add, $element);
	}

	public function testMonoidAssociativeRule()
	{
		$a = ListLike::unit(1,2,3);
		$b = ListLike::unit(4,5,6);
		$c = ListLike::unit(7,8,9);

		$left_associative  = ListLike::add(ListLike::add($a, $b), $c);
		$right_associative = ListLike::add($a, ListLike::add($b, $c));

		$this->assertEquals($left_associative, $right_associative);
	}
}
